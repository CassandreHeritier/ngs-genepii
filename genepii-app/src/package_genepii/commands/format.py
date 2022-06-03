import os
import pandas as pd
from pathlib import Path
from tools import colors
from format.format import format

current_dir = os.path.dirname(os.path.realpath(__file__))
path = Path(current_dir)
storage_dir = str(path.parents[2]) + '/storage/app/public/outputs'

def formatData(corres:str, data: pd.DataFrame or dict):
    try:
        formated = format(corres, data)
        print(colors.bcolors.OKGREEN + "Success: data formatted!" + colors.bcolors.ENDC)
        print(colors.bcolors.OKCYAN + "Exporting data to CSV..." + colors.bcolors.ENDC)
        formated.to_excel(f'{storage_dir}/formated_data.xlsx', encoding = 'utf-8-sig')
        print(colors.bcolors.OKGREEN + "Success: data exported to CSV file!" + colors.bcolors.ENDC)
    except:
        raise Exception(colors.bcolors.FAIL + "An error occurred while formatting data." + colors.bcolors.ENDC)
    else:
        return formated