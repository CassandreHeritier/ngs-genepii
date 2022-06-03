import os
import numpy as np
import pandas as pd
from pathlib import Path
from tools import colors
from database import dbClass
from datetime import datetime

current_dir = os.path.dirname(os.path.realpath(__file__))
path = Path(current_dir)
storage_dir = str(path.parents[2]) + '/storage/app/public/outputs'

class Tables():
    def __init__(self, dbcols, corres, export_inserted, export_updated):
        self.corres = corres
        self.patients = None
        self.medical_files = None
        self.sender_labos = None
        self.sampler_labos = None
        self.samples = None
        self.dbcols = dbcols
        self.export_inserted = export_inserted
        self.export_updated = export_updated

        # Store as keys the SQL table names, and as values the table column names
        self.cols_insert = {}
        self.primkeys = {}  # store primary keys by table
        self.insert_table = {}  # store boolean to know if each table as to be filled

        # Initialize primary keys and list of columns to insert
        for key, value in self.dbcols.items():
            self.primkeys[key] = value[0]
            self.cols_insert[key] = []

        # Store required columns to insert into table, initialised with primkeys
        self.obligcols_file = pd.read_csv(f'{self.corres}/REQUIRED-0.0.1.csv', sep=";", encoding='latin-1')
        if len(self.obligcols_file.columns) <= 1:
           raise Exception(colors.bcolors.FAIL + "Please check the separator given to the CSV file parser into the Python script." + colors.bcolors.ENDC)
        self.obligcols = self.obligcols_file.to_dict('list')

        # Remove NaN values
        for key, value in self.obligcols.items():
            new_val = [x for x in value if x == x]
            self.obligcols[key] = new_val
        
        # Initialize dictionaries : one to insert data into the databse, and another to update existent data
        self.data_insert = {}
        self.data_update = {}

    def set_columns(self, data):
        for column in data.columns:
            for index, list in self.dbcols.items():
                if column in list:
                    self.cols_insert[index].append(column)

        self.cols_insert = {key: value for key,
                            value in self.cols_insert.items() if value}

    def set_tables(self, data):
        # Create dict to know which table as to be filled according to presence of primary keys
        for table, primkey in self.primkeys.items():
            # If we have the primary key and a not empty column for primary key we insert data into this table
            if primkey in data.columns and not data[primkey].isnull().values.all():
                self.insert_table[table] = True
            else:
                self.insert_table[table] = False

        # Create dataframe of data to insert in each table, even if there is not primary key
        for table in self.cols_insert.keys():
            self.data_insert[table] = pd.DataFrame(
                data=data[self.cols_insert[table]],
                columns=self.cols_insert[table]
            )

            # if we have primary key, we get data to insert / update
            if self.insert_table[table]:
                self.data_update[table], self.data_insert[table] = self.update_insert_data(table)
        
        # Keep only dataframes not empty
        self.data_insert = {key: value for key, value in self.data_insert.items() if not value.empty}

        # Keep data if columns are necessary columns and where data exists (not null)
        for table, df in list(self.data_insert.items()):
            # if not all(x in list(df.columns) for x in self.obligcols[table]):
            for x in self.obligcols[table]:
                if not x in list(df.columns) or (x in list(df.columns) and df[x].isnull().values.any()):
                    self.data_insert.pop(table)
                    break

        # Drop duplicates of primary keys
        for table in self.data_insert.keys():
            id = self.primkeys[table]
            self.data_insert[table].drop_duplicates(id, inplace=True)

        # Keep only data with dataframes not empty
        self.data_insert = dict((k, v) for k, v in self.data_insert.items() if not v.empty)
        self.data_update = dict((k, v) for k, v in self.data_update.items() if not v.empty)

        # Keep data with columns not empty
        for key, df in self.data_insert.items():
            self.data_insert[key] = df.dropna(axis=1,how='all')
        for key, df in self.data_update.items():
            self.data_update[key] = df.dropna(axis=1,how='all')
        
        # Replace all NaN values with None
        for key in self.data_insert.keys():
            self.data_insert[key] = self.data_insert[key].fillna(
                np.nan).replace({np.nan: None})
        for key in self.data_update.keys():
            self.data_update[key] = self.data_update[key].fillna(
                np.nan).replace({np.nan: None})

        if self.export_inserted and self.data_insert:
            with pd.ExcelWriter(f'{storage_dir}/inserted_data.xlsx') as writer:
                for table_name, df in self.data_insert.items():
                    df.to_excel(writer, sheet_name=table_name, encoding = 'utf-8-sig')
        
        if self.export_updated and self.data_update:
            with pd.ExcelWriter(f'{storage_dir}/updated_data.xlsx') as writer:
                for table_name, df in self.data_update.items():
                    df.to_excel(writer, sheet_name=table_name, encoding = 'utf-8-sig')
                
    def update_insert_data(self, table):
        "Keep only new information and remove existing information in common with those from the database."
        id = self.primkeys[table]
        data = self.data_insert[table]

        db_data = dbClass.DB(self.corres, self.export_inserted, self.export_updated).get_table(table)

        # Replace nan by None
        db_data = db_data.fillna(np.nan).replace({np.nan: None})
        data = data[data[id].notnull()]

        common = pd.merge(db_data, data, how='inner', on=id).drop_duplicates()

        if not common.empty:
            for col in common.columns:
                if col.endswith('_x'):
                    name = col.replace('_x', '')
                    # Keep info from data and erase info from db (to change this, write _x instead of _y below)
                    common[name] = common[f'{name}_y'].fillna(common[f'{name}_x'])
                    # common[name] = common[f'{name}_y'].where(common[f'{name}_y'].notnull(), common[f'{name}_x'])
                    # TODO where condition to keep only different values between _x and _y, else not keep value
                    del common[f'{name}_x']
                    del common[f'{name}_y']

            common.drop_duplicates(inplace=True)

            diff = pd.merge(data, common, how='left', on=id, indicator=True)
            for col in diff.columns:
                if col.endswith('_x'):
                    name = col.replace('_x', '')
                    diff[name] = diff[f'{name}_y'].fillna(diff[f'{name}_x'])
                    # diff[name] = diff[f'{name}_y'].where(diff[f'{name}_y'].notnull(), diff[f'{name}_x'])
                    del diff[f'{name}_x']
                    del diff[f'{name}_y']

            diff = diff[diff['_merge'] == 'left_only']
            del diff['_merge']

            now = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
            common['updated_at'] = now
            diff['updated_at'] = now

            # Concerning the Samples table, we merge the data on both the id_sample and the id_medical_file
            # because we want to update the table whether there is one or the other key, so we merge a second
            # time on id_medical_file and we concatenate the two merge df.
            # TODO duplication of code here on common df
            if table == 'samples' and 'id_medical_file' in data.columns:
                id2 = 'id_medical_file'
                data2 = self.data_insert[table]
                data2 = data2[data2[id2].notnull()]
                common_files = pd.merge(db_data, data2, how='inner', on=id2).drop_duplicates()

                for col in common_files.columns:
                    if col.endswith('_x'):
                        name = col.replace('_x', '')
                        # Keep info from data and erase info from db (to change this, write _x instead of _y below)
                        common_files[name] = common_files[f'{name}_y'].fillna(common_files[f'{name}_x'])
                        # TODO where condition to keep only different values between _x and _y, else not keep value
                        del common_files[f'{name}_x']
                        del common_files[f'{name}_y']
                common_files.drop_duplicates(inplace=True)

                # Concatenate the two merge df
                new_common = pd.concat([common, common_files]).drop_duplicates()

                new_common['updated_at'] = now
                return new_common, diff

            # TODO verifier que common et diff ont le mêmes nb de colonnes et les mêmes noms, sinon update plante
            return common, diff
        else:
            # Returns an empty dataframe for update, and data for data to insert
            return pd.DataFrame(columns=data.columns), data