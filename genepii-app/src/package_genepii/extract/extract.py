from tools import colors
import json
import pandas as pd

class Extract():
    "Class to extract data from table file."

    def __init__(self):
        self.file = None
        self.dataframe = None

    def set_file(self, corres:str, file: str, header: int):
        print(colors.bcolors.OKCYAN + "Extracting data from the imported file..." + colors.bcolors.ENDC)

        # Check file format and encoding
        try:
            if file.endswith('.xlsx') or file.endswith('.xls'):
                try:
                    self.file = pd.read_excel(file, header=header, dtype=str)
                except ValueError:
                    raise ValueError(colors.bcolors.FAIL + "A wrong value has been given to the -d option, the value is greater than the number of lines in the file." + colors.bcolors.ENDC)
            elif file.endswith('.csv'):
                self.file = pd.read_csv(file, header=header, dtype=str, encoding="latin-1")
            elif file.endswith('.tsv'):
                self.file = pd.read_csv(file, header=header, sep='\t', dtype=str, encoding="latin-1")
            elif file.endswith('.json'):
                with open(file, 'r') as f:
                    self.file = json.loads(f.read())
            else:
                raise Exception(colors.bcolors.FAIL + "Bad extension, give .csv, .tsv, .xlsx or .xls." + colors.bcolors.ENDC)
        except UnicodeDecodeError:
            raise Exception(colors.bcolors.FAIL + "Encoding problem of the file, check that it is encoded in UTF-8 for example, otherwise try to import in Excel format." + colors.bcolors.ENDC)
        
        # Get correspondance of file columns / db columns
        corres_col = pd.read_csv(f'{corres}/FILE_DF_COLUMNS-0.0.1.csv', sep=";", encoding="latin-1")
        dic = {}

        # For table files
        if type(self.file) == pd.DataFrame:
            # Get data from file with correspondant columns
            for row in corres_col.itertuples():
                if row[1] in self.file.columns:
                    dic[row[2]] = self.file[row[1]]
            
            # Turn into dataframe
            self.dataframe = pd.DataFrame.from_dict(dic).dropna(how='all', axis=1)
            if self.dataframe.empty:
                raise Exception(colors.bcolors.FAIL + "No data could be processed, check that the (good) position of the column headers has been set in the command (-d option, or enter --help)." + colors.bcolors.ENDC)
        
        # For JSOn file
        elif type(self.file) == dict:
            if not self.file:
                raise Exception(colors.bcolors.FAIL + "No data could be processed, the JSON file is empty." + colors.bcolors.ENDC)