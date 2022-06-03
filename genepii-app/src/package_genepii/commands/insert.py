import pandas as pd
from tools import colors
from database.dbClass import DB 

def insertData(corres:str, data:pd.DataFrame or dict, no_table:str='', get_inserted:bool=False, get_updated:bool=False):
    db = DB(corres, get_inserted, get_updated)
    try:
        db.insert_data(data, no_table)
        print(colors.bcolors.OKGREEN + "Success: data imported / updated into the SQL database!" + colors.bcolors.ENDC)
    except:
        raise Exception(colors.bcolors.FAIL + "An error occurred while inserting data into the database. Please refer to the log files for more information." + colors.bcolors.ENDC)