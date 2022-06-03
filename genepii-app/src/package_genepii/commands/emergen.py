from tools import colors
from emergen.emergenClass import Emergen

def emergen(corres:str, output:str, samples: str, val_start: str, val_stop: str):
    emergen = Emergen(corres, samples, val_start, val_stop)
    emergen.get_emergen_data()
    merge_data = emergen.merge()
    clean_data = emergen.clean(merge_data)
    clean_data.to_excel(f'{output}/emergen.xlsx', encoding = 'utf-8-sig')
    # clean_data.to_csv(f'{output}/emergen.csv', encoding = 'utf-8-sig')
    print(colors.bcolors.OKGREEN + f"Success: data extracted, please find EMERGEN data into {output} folder!" + colors.bcolors.ENDC)