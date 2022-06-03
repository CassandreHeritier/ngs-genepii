#!/usr/bin/env python3
import os
import argparse
from pathlib import Path
from tools import colors
from commands.emergen import emergen
from commands.export import exportData
from commands.extract import extractData
from commands.format import formatData
from commands.insert import insertData
from commands.test import test

current_dir = os.path.dirname(os.path.realpath(__file__))
path = Path(current_dir)
storage_dir = str(path.parents[1]) + '/storage/app/public/outputs'

corres_path = str(path) + '/corres'
parser = argparse.ArgumentParser()

parser.add_argument('command', choices=['file', 'emergen', 'export', 'test'],
                    help="Manipulate data from file, get EMERGEN format, or export data from the database.", type=str)

# Import arguments
parser.add_argument('-i', '--input', help="<Required> Input file to be formatted", type=str) #  required=True
parser.add_argument('-d', '--header', help="Line number in the input file containing the column headers", type=int, default=1) # put 12 for glims file, 7 for samplesheet
parser.add_argument('--db', help="Insert the data from the input file into the database", default=False, action='store_true')
parser.add_argument('-n', '--no_table', help="SQL table to do not insert", type=str)
parser.add_argument('--get_inserted', help="get dataframe with data to insert into DB", default=False, action='store_true') # for debog
parser.add_argument('--get_updated', help="get dataframe with data to update into DB", default=False, action='store_true') # for debog

# Emergen arguments
parser.add_argument('-a', '--start_date', help="Validation start date", type=str, default='2021-01-01') # optional
parser.add_argument('-b', '--end_date', help="Validation end date", type=str, default='2023-01-01') # optional
parser.add_argument('-s', '--samples', help="File containing a list of sample numbers", type=str, default='') # optional
parser.add_argument('-o', '--output_emergen', help="Output folder for Emergen data", type=str, default=storage_dir) # optional

# Export arguments
parser.add_argument('-l','--ids', nargs='+', help='<Required> List of data ids to export')
parser.add_argument('-p', '--table', help="Table to export", type=str) # required=True
parser.add_argument('-e', '--output_export', help="Output folder for exported data", type=str, default=storage_dir) # optional

# Other arguments
parser.add_argument('--version', action='version', version='0.0.1')
parser.add_argument('--corres', help="Path to Corres folder", type=str, default=corres_path) # optional

args = parser.parse_args()

if __name__ == "__main__":
    try:
        if args.command == 'file':
            extrac = True
            file = args.input
            header = args.header
            db = args.db
            get_inserted = args.get_inserted
            get_updated = args.get_updated
            no_table = args.no_table
        elif args.command == 'emergen':               
            extrac = False
            # If a list of sample numbers is given, the extraction for Emergen will be done according
            # to this list in priority to the validation dates if they are given.
            if args.samples:
                print(colors.bcolors.HEADER + "\n #### GET EMERGEN DATA #### \n" + colors.bcolors.ENDC)
                emergen(args.corres, args.output_emergen, args.samples, args.start_date, args.end_date)
            else:
                print(colors.bcolors.HEADER + "\n #### GET EMERGEN DATA #### \n" + colors.bcolors.ENDC)
                emergen(args.corres, args.output_emergen, '', val_start=args.start_date, val_stop=args.end_date)
        elif args.command == 'export':
            extrac = False
            print(colors.bcolors.HEADER + "\n #### GET DATA FROM DB #### \n" + colors.bcolors.ENDC)
            exportData(args.corres, args.output_export, args.ids, args.table)
        elif args.command == 'test':
            extrac = False
            print(colors.bcolors.HEADER + "\n #### TESTS #### \n" + colors.bcolors.ENDC)
            test(args.corres)

    except:
        raise Exception(colors.bcolors.FAIL + "A problem occurred during the execution of a command: see the errors above. For more information, see https://github.com/CassandreHeritier/db-ngs/tree/master/bdd." + colors.bcolors.ENDC)
    else:
        if extrac:
            print(colors.bcolors.HEADER + "\n #### IMPORT FILE #### \n" + colors.bcolors.ENDC)
            data = extractData(args.corres, file, header)

            print(colors.bcolors.HEADER + "\n #### FORMAT DATA #### \n" + colors.bcolors.ENDC)
            formated_data = formatData(args.corres, data)
            
            # Insert into database
            if db:
                print(colors.bcolors.HEADER + "\n #### INSERT DATA TO DB #### \n" + colors.bcolors.ENDC)
                insertData(args.corres, formated_data, no_table, get_inserted, get_updated)
                #except:
                #    raise Exception(colors.bcolors.FAIL + "No SQL table has been filled in, please use the --table or -t option followed by the name of the table not to be inserted." + colors.bcolors.ENDC)
