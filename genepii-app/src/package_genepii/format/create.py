from datetime import datetime, date
import re
import pandas as pd
from database.dbClass import DB

class Create():
    def __init__(self, corres:str):
        self.db = DB(corres, False, False)

        # To create auto increment ids
        self.treated_bioinfo_results = {}
        self.treated_patients = {}
        self.treated_sampler_labos = {}
        self.treated_sender_labos = {}
        self.treated_samplesheets = {}

        self.ids = {}
        self.autoincremented = pd.read_csv(f'{corres}/AUTO_IDS-0.0.1.csv', sep=";", encoding="latin-1")

        # Initialize autoincremented ids with existant ids from database
        for table in self.autoincremented.columns:
            id = self.autoincremented[table].iloc[0]
            self.ids[id] = self.db.get_last_id(id, table)

        # Initialize autoincremented ids with 0 if no exist
        for key in self.ids:
            if self.ids[key] is None:
                self.ids[key] = 0

        # For serious case column
        corres_serious_cases = pd.read_csv(f'{corres}/SERIOUS_CASES-0.0.1.csv', sep=';', encoding="latin-1")
        self.UF_services = corres_serious_cases['NOM_UF'].to_list()
        self.mnemo_ids = corres_serious_cases['CORRES'].to_list()

    def create_ac_treatment_failure(self, ac_treatment):
        # TODO
        return ac_treatment

    def create_age(self, birth):
        "Creates the age as an integer from the date of birth in string datetime or integer."
        today = date.today()
        try:
            if type(birth) == int: # birth year
                return today.year - birth
            elif type(birth) == str: # birth date
                birth = datetime.strptime(birth, '%Y-%m-%d %H:%M:%S')
                return today.year - birth.year - ((today.month, today.day) < (birth.month, birth.day))
            return birth
        except:
            return None

    def create_bioinfo_run_date(self, id_bioinfo_run):
        date = "^[0-9]{6}" # like 220506
        parts = id_bioinfo_run.split('_')
        if len(parts) > 0 and bool(re.match(date, parts[0])):
            return parts[0]
        return None

    def create_birth_year(self, birth):
        "Create a 'birth year' value from the birth date in string datetime: returns the year from datetime."
        if type(birth) == str:
            birth_date = datetime.strptime(birth, '%Y-%m-%d %H:%M:%S')
            return birth_date.year if 1900 <= birth_date.year <= 2022 else None
        return None

    def create_complete_scheme(self, vaccine):
        if vaccine == 'INCOMPLET':
            return 'NO'
        elif vaccine == 'COMPLET':
            return 'YES'
        return None

    def create_id_extraction(self):
        "Create a unique id by extraction"
        self.ids['id_extraction'] += 1
        return self.ids['id_extraction']

    def create_id_medical_file(self, id_sample, scaninfo):
        # it is an id_sample intern to CHU
        if id_sample != None and (id_sample.startswith('02') or id_sample.startswith('12') or id_sample.startswith('72')):
            return id_sample[:10]
        elif scaninfo != None and scaninfo.startswith('?'):  # it is an id_medical_file into question infoscan
            id_medical_file = re.sub("[^0-9]", "", scaninfo)
            return id_medical_file
        elif scaninfo != None and len(scaninfo) >= 11:  # it is a infoscan
            return self.db.get_id_medical_file(scaninfo)
        return None

    def create_id_patient(self, firstname, lastname, birth_date, birth_year):
            "Create a unique id by unique patient based on his firtname, lastname and birth, or get from the database if exists."
            current_patient = None
            db_id = self.db.get_id_patient(firstname, lastname, birth_date, birth_year)
            if db_id != None:
                return db_id
            else:
                current_patient = [firstname, lastname, birth_date, birth_year]
                if current_patient not in self.treated_patients.values():
                    self.ids['id_patient'] += 1
                    self.treated_patients[self.ids['id_patient']] = current_patient
                else:
                    for id, patient in self.treated_patients.items():
                        if patient == current_patient:
                            return id
                return self.ids['id_patient']

    def create_id_plate(self, id):
        id_plate = "^[0-9]+Pl[0-9]+$" # like 22Pl63
        id_plate2 = "Pl[0-9]+$"
        parts = id.split('-')
        parts2 = id.split(' ')
        if len(parts) > 0 and bool(re.match(id_plate, parts[0])) or bool(re.match(id_plate2, parts[0])):
            return parts[0]
        elif len(parts2) > 0 and bool(re.match(id_plate, parts2[0])) or bool(re.match(id_plate2, parts2[0])):
            return parts2[0]
        return None

    def create_id_results(self, id, table, id_bioinfo_run):
        "Create a unique id by validation result"
        check = self.db.check_bioinfo_run(id, table, id_bioinfo_run)
        if check:
            return None
        else:
            self.ids[id] += 1
            return self.ids[id]

    def create_id_sample(self, sample_id):
        L = sample_id.split('-')
        M = sample_id.split(' ')
        return L[1] if len(L) == 2 else M[1] if len(M) == 2 else None

    def create_id_sampler_lab(self, name_sampler, postal_code_sampler):
        "Create a unique id by unique sampler laboratory based on the sampler information, or get from the database if exists."
        if name_sampler != None and postal_code_sampler != None:
            db_id = self.db.get_id_sampler_lab(name_sampler, postal_code_sampler)
            if db_id != None:
                return db_id
            else:
                current_labo = [name_sampler, postal_code_sampler]
                if current_labo not in self.treated_sampler_labos.values():
                    self.ids['id_sampler_lab'] += 1
                    self.treated_sampler_labos[self.ids['id_sampler_lab']] = current_labo
                else:
                    for id, labo in self.treated_sampler_labos.items():
                        if labo == current_labo:
                            return id
            return self.ids['id_sampler_lab']
        return None
    
    def create_id_samplesheet(self, id_seq_run, id_sample):
        "Create a unique id by sequencing info data based on id_seq_run and id_sample"
        db_id = self.db.get_id_samplesheet(id_seq_run, id_sample, None)
        if db_id != None:
            return db_id
        elif id_seq_run != None:
            current_samplesheet = [id_seq_run, id_sample]
            if current_samplesheet not in self.treated_samplesheets.values():
                self.ids['id_samplesheet'] += 1
                self.treated_samplesheets[self.ids['id_samplesheet']] = current_samplesheet
            else:
                for id, seqinfo in self.treated_samplesheets.items():
                    if seqinfo == current_samplesheet:
                        return id
            return self.ids['id_samplesheet']
        return None

    def create_id_sender_lab(self, name_sender, department_sender, town_sender, mnemoid_sender):
        "Create a unique id by unique sender laboratory based on the sender information, or get from the database if exists."
        current_labo = None
        db_id = self.db.get_id_sender_lab(name_sender, department_sender, town_sender, mnemoid_sender)

        if db_id != None:
            return db_id
        else:
            current_labo = [name_sender, department_sender, town_sender, mnemoid_sender]
            if current_labo not in self.treated_sender_labos.values():
                self.ids['id_sender_lab'] += 1
                self.treated_sender_labos[self.ids['id_sender_lab']] = current_labo
            else:
                for id, labo in self.treated_sender_labos.items():
                    if labo == current_labo:
                        return id
        return self.ids['id_sender_lab']

    def create_id_set(self, version:str):
        "Create a unique id by pipeline set of parameters"
        db_id = self.db.get_id_set(version)
        if db_id != None:
            return db_id
        else:
            self.ids['id_set'] += 1
            return self.ids['id_set']

    def create_serious_case(self, existant, sender):
        "Return YES for serious case value if the sender laboratory is a known service of serious cases."
        if sender in self.UF_services or sender in self.mnemo_ids:
            return 'YES'
        elif existant != None:
            return existant
        return None

    def create_platewell(self, id):
        platewell = "S[0-9]+$"
        parts = id.split('_')
        if len(parts) > 1 and bool(re.match(platewell, parts[1])):
            return parts[1]
        return None

    def create_nb_vaccine_doses(self, vaccination, vaccine_name):
        "Create number of vaccine doses from the vaccine name and vaccination info."
        # With vaccination (not None)
        if type(vaccination) == str:
            # Remove spaces and slashes
            vaccination = vaccination.strip().replace(' ', '').replace('/', '')
            # Get number of doses if given
            if vaccination.isnumeric() and int(vaccination) < 10:
                return int(vaccination)
            elif 'DOSE' in vaccination:
                return int(vaccination[0])
            # No vaccination means 0 dose
            elif vaccination == 'NO':
                return 0
            return None
            
        # With vaccine name (not None)
        elif type(vaccine_name) == str:
            # With number of doses already filled in string, we look at the first digit only
            # (sometimes the date follows)
            if re.findall(r'\d+', vaccine_name):
                # Allows up to 5 doses
                if int(re.findall(r'\d+', vaccine_name)[0]) <= 5:
                    return int(re.findall(r'\d+', vaccine_name)[0])
            # With vaccine initials, one per dose
            elif vaccine_name == 'NV':
                return 0
            elif len(vaccine_name) == 1 and bool(re.match('[AaPpMmJj]', vaccine_name)):
                return 1
            elif len(vaccine_name) == 2 and bool(re.match('[AaPpMmJj]{2}', vaccine_name)):
                return 2
            elif len(vaccine_name) == 3 and bool(re.match('[AaPpMmJj]{3}', vaccine_name)):
                return 3
            return None

        return None

    def create_type(self, finess, uf):
        "Returns the type of the sampler laboratory: external if there is a given finess, else internal into CHU if UF else None."
        return 'external' if finess is not None else 'internal' if uf is not None else None

    def create_vaccinated(self, vaccination, not_vaccinated, vaccine_failure, vaccine_name):
        "Create 'vaccinated' value according to 'not_vaccinated' or 'vaccination' column."
        if vaccination == 'NO' or not_vaccinated == 'YES' or vaccine_name == 'NV':
            return 'NO'
        elif vaccination == 'YES' or not_vaccinated == 'NO' or vaccine_failure == 'YES':
            return 'YES'
        elif vaccine_name in ['Pfizer', 'Moderna', 'Astrazeneca', 'Johnson&Johnson']:
            return 'YES'
        return None

    def create_vaccine_failure(self, vaccination):
        "Creates a 'vaccination failure' value: yes if the word 'échec' is found, NR if NR and otherwise None."
        if type(vaccination) == str:
            return 'YES' if 'échec' in vaccination else 'NR' if vaccination == 'NR' else None
        return None