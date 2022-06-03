from tools import colors
from database.exportClass import Export

def exportData(corres:str, output:str, ids: list, table:str):
    try:
        export = Export(corres, ids, table)
        data = export.get_data()
        data.to_excel(f'{output}/exported_data.xlsx', encoding = 'utf-8-sig')
        print(colors.bcolors.OKGREEN + f"Success: data extracted, please find data into {output} folder!" + colors.bcolors.ENDC)
    except:
        raise Exception(colors.bcolors.FAIL + "A problem occurred while getting data from database." + colors.bcolors.ENDC)