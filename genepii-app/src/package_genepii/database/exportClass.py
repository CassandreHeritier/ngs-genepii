from tools import colors
from database import dbClass

class Export():
    def __init__(self, corres:str, ids:list, table:str, ):
        self.corres = corres
        self.ids = ids
        self.table = table
        self.db = dbClass.DB(self.corres, False, False)
    
    def get_data(self):
        print(colors.bcolors.OKCYAN + "Getting data from the SQL database..." + colors.bcolors.ENDC)
        try:
            if self.ids != None:
                output = self.db.query(self.ids, self.table)
            else:
                print(self.table)
                output = self.db.get_table(self.table)
            if self.table == 'patients':
                output.drop(['firstname', 'lastname', 'birth_date', 'birth_year'], axis=1, inplace=True)
            return output
        except:
            raise Exception(colors.bcolors.FAIL + "An error occurred while retrieving data from the database." + colors.bcolors.ENDC)