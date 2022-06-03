import os
from pathlib import Path
from tools import colors
from extract.extract import Extract

current_dir = os.path.dirname(os.path.realpath(__file__))
path = Path(current_dir)
storage_dir = str(path.parents[2]) + '/storage/app/public/outputs'

def extractData(corres:str, file: str, header: int):
    try:
        data = Extract()
        data.set_file(corres, file, header-1) # -1 because python begins at 0, Excel lines at 1
        print(colors.bcolors.OKGREEN + "Success: data extracted!" + colors.bcolors.ENDC)

        if file.endswith('.json'):
            return data.file
        else:
            print(colors.bcolors.OKCYAN + "Exporting data to CSV..." + colors.bcolors.ENDC)
            data.dataframe.to_excel(f'{storage_dir}/data.xlsx', encoding = 'utf-8-sig')
            print(colors.bcolors.OKGREEN + "Success: data exported to CSV file!" + colors.bcolors.ENDC)
            return data.dataframe
    except:
        raise Exception(colors.bcolors.FAIL + "A problem occurred while retrieving data from the file or creating a spreadsheet." + colors.bcolors.ENDC)
