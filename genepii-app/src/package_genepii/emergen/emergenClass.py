import pandas as pd
from tools import colors
from database import dbClass

class Emergen():
    def __init__(self, corres:str, samples_list: str, val_start: str, val_stop: str):
        self.corres = corres
        self.id_samples = []
        
        if samples_list != '':
            if samples_list.endswith('.txt'): # if path of list file is given we extract data
                with open(samples_list) as f:
                    for line in f.readlines():
                        line = line.strip()
                        self.id_samples.append(line)
            else:
                raise Exception(colors.bcolors.FAIL + "Bad extension was given: supported files are .txt" + colors.bcolors.ENDC)
        
        # Convert id samples into tuple, with at least two elements
        if len(self.id_samples) == 1:
            self.id_samples.append('')
            self.id_samples = tuple(self.id_samples)
        else:
            self.id_samples = tuple(self.id_samples)
        
        self.val_start = val_start
        self.val_stop = val_stop
           
        # Columns with YES/NO/NR/None
        cols_choice = pd.read_csv(f'{corres}/CHOICE_COLUMNS-0.0.1.csv', sep=";", encoding='latin-1')['cols_choice'].tolist()
        self.cols_choice = [x for x in cols_choice if not pd.isnull(x)]

        self.csv = pd.read_csv(f'{corres}/EMERGEN-0.0.1.csv', sep=";", encoding="latin-1")
        self.columns = [x for x in self.csv['db_cols'].to_list() if not pd.isnull(x)]
        
    def check_samples(self):
        if self.id_samples:
            # for id in self.id_samples:
            #     print(self.check_id_sample(id))
            # check format of id samples
            return True
        return False
    
    def get_emergen_data(self):
        db = dbClass.DB(self.corres, False, False)
        print(colors.bcolors.OKCYAN + "Getting data from the SQL database for EMERGEN format..." + colors.bcolors.ENDC)
        try:
            # if there is list of samples, get emergen with list
            if self.check_samples():
                self.samples = db.get_table(
                    'samples', id_samples=self.id_samples)
                self.medical_files = db.get_table(
                    'medical_files', id_samples=self.id_samples)
                self.patients = db.get_table(
                    'patients', id_samples=self.id_samples)
                self.sampler_labos = db.get_table(
                    'sampler_laboratories', val_start=self.val_start, val_stop=self.val_stop)
                self.sender_labos = db.get_table(
                    'sender_laboratories', val_start=self.val_start, val_stop=self.val_stop)
                
            # else, get with dates
            else:
                self.samples = db.get_table(
                    'samples', val_start=self.val_start, val_stop=self.val_stop)
                self.medical_files = db.get_table(
                    'medical_files', val_start=self.val_start, val_stop=self.val_stop)
                self.patients = db.get_table(
                    'patients', val_start=self.val_start, val_stop=self.val_stop)
                self.sampler_labos = db.get_table(
                    'sampler_laboratories', val_start=self.val_start, val_stop=self.val_stop)
                self.sender_labos = db.get_table(
                    'sender_laboratories', val_start=self.val_start, val_stop=self.val_stop)
            
                # No samples table = no extraction
                if self.samples.empty:
                    raise Exception(colors.bcolors.FAIL + "No samples in database for this period. Please change validation dates, or check that there is data in the database (samples and validation dates)." + colors.bcolors.ENDC)

            # TODO relever les tables vides pour mettre en erreur quelles tables sont vides
            if self.samples.empty or self.medical_files.empty or self.patients.empty or self.sender_labos.empty: #or self.sampler_labos.empty:
                raise Exception(colors.bcolors.FAIL + "One or more SQL tables have no data for the desired samples. Check that all the files concerned have been imported into the database, or that the samples to be submitted exist in the database and try again." + colors.bcolors.ENDC)

        except:
            raise Exception(colors.bcolors.FAIL + "An error occurred while retrieving data from the database." + colors.bcolors.ENDC)
        
    def merge(self):
        no_id_medical_file = self.samples['id_medical_file'].isnull().values.all()
        
        if no_id_medical_file:
            raise Exception("No medical files ids found into the database for these samples, please check the database.")
        merge1 = pd.merge(self.samples, self.medical_files, on='id_medical_file', how='outer')
        
        no_id_patient = merge1['id_patient'].isnull().values.all()
        if no_id_patient:
            raise Exception("No patients ids found into the database for these samples, please check the database.")
        merge2 = pd.merge(merge1, self.patients, on='id_patient', how='outer')
        
        no_id_sampler_lab = merge2['id_sampler_lab'].isnull().values.all()
        if no_id_sampler_lab:
            raise Exception("No sampler laboratories ids found into the database for these samples, please check the database.")
        merge3 = pd.merge(merge2, self.sampler_labos, on='id_sampler_lab', how='outer')
        
        no_id_sender_lab = merge3['id_sender_lab'].isnull().values.all()
        if no_id_sender_lab:
            raise Exception("No sender laboratories ids found into the database for these samples, please check the database.")
        merge4 = pd.merge(merge3, self.sender_labos, on='id_sender_lab', how='outer')
        
        return merge4

    def clean(self, data):
        "Keep only EMERGEN necessary data and format or add columns."
        # data['department_patient'] = data.apply(
        #     lambda x: self.get_department(x.postal_code_patient), axis=1)
        data['department_sampler'] = data.apply(
            lambda x: self.get_department(x.postal_code_sampler), axis=1)

        for col in self.cols_choice:
            if col in data.columns:
                data[col] = data[col].apply(lambda x: self.replace_bool_YN(x))

        # TODO ameliorer (pas de nom direct colonne)
        data['flash_study'] = data['flash_study'].apply(lambda x: self.replace_bool(x))

        # Keep only EMERGEN columns
        data = data[self.columns]
        return data

    def get_department(self, postal_code):
        if type(postal_code) == str and len(postal_code) >= 2:
            return postal_code[:2]
        elif type(postal_code) == int:
            return str(postal_code)[:2]
        return None

    def replace_bool(self, value):
        return 1 if value != None else 0

    def replace_bool_YN(self, value):
        return 1 if value == 'YES' else 0