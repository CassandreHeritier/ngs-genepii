import os
import sys
import pandas as pd
import mysql.connector
from pathlib import Path
from tools import colors
from database import tablesClass

current_dir = os.path.dirname(os.path.realpath(__file__))
path = Path(current_dir)
log_dir = str(path.parents[0]) + '/log'

class DB():
    def __init__(self, corres:str, export_inserted:bool=False, export_updated:bool=False):
        self.corres = corres
        self.hostname = 'localhost'
        self.username = 'root'
        self.password = 'root'
        self.database = 'ngs'
        self.dbcols_file = pd.read_csv(f'{self.corres}/DB_COLUMNS-0.0.1.csv', sep=";", encoding='latin-1')

        if len(self.dbcols_file.columns) <= 1:
            raise Exception(colors.bcolors.FAIL + "Please check the separator given to the CSV file parser into the Python script." + colors.bcolors.ENDC)
        # TODO check if unique columns names
        self.dbcols = self.dbcols_file.to_dict('list')

        # Remove NaN values from lists
        for key, value in self.dbcols.items():
            self.dbcols[key] = [x for x in value if not pd.isnull(x)]

        # Remove NaN values
        for key, value in self.dbcols.items():
            new_val = [x for x in value if x == x]
            self.dbcols[key] = new_val
        self.tables = tablesClass.Tables(self.dbcols, self.corres, export_inserted, export_updated)

        # Store primary keys by table into a dict
        self.primkeys = self.tables.primkeys

    def check_bioinfo_run(self, id:str, table:str, id_bioinfo_run):
        conn = self.db()
        cur = conn.cursor()
        sql = f"""SELECT {id} FROM {table} WHERE id_bioinfo_run = "{id_bioinfo_run}" """
        cur.execute(sql)
        result = cur.fetchone()
        conn.close()
        return True if result is not None else False

    def db(self):
        connection = mysql.connector.connect(
            host=self.hostname,
            user=self.username,
            passwd=self.password,
            db=self.database,
            auth_plugin='mysql_native_password')
        return connection

    def get_id_medical_file(self, q_scaninfo):
        conn = self.db()
        cur = conn.cursor()
        sql = f"""SELECT id_medical_file FROM medical_files WHERE infoscan
                  IN (SELECT infoscan FROM medical_files GROUP BY infoscan HAVING COUNT(*) = 1)
                  AND infoscan = "{q_scaninfo}" """
        cur.execute(sql)
        result = cur.fetchone()
        conn.close()
        return result[0] if result != None else None

    def get_id_patient(self, firstname, lastname, birth_date, birth_year):
        conn = self.db()
        cur = conn.cursor()

        if birth_date != None:
            sql = f"""SELECT id_patient FROM patients WHERE firstname = "{firstname}" AND lastname = "{lastname}"
                   AND birth_date = "{birth_date}" """
        elif birth_year != None:
            sql = f"""SELECT id_patient FROM patients WHERE firstname = "{firstname}" AND lastname = "{lastname}"
                    AND birth_year = "{birth_year}" """
        else:
            sql = f"""SELECT id_patient FROM patients WHERE firstname = "{firstname}" AND lastname = "{lastname}" """
        cur.execute(sql)
        # TODO ici prend le premier si il y a plusieurs résultats, rendre unique !!! (ce qui arrive quand deux patients ont les mêmes infos)
        result = cur.fetchone()
        conn.close()
        return result[0] if result != None else None

    def get_id_sample(self, id_medical_file):
        conn = self.db()
        cur = conn.cursor()
        # return un id sample qui correspond au fichier s'il est unique, sinon rien
        # là ça renvoie le premier qui matche au bon dossier
        # sql = f"""SELECT id_sample FROM samples
        #         WHERE id_medical_file IN
        #         (SELECT id_medical_file FROM samples GROUP BY id_medical_file HAVING COUNT(*) = 1)
        #         AND id_medical_file = "{id_medical_file}" """
        sql = f"""SELECT id_sample FROM samples WHERE id_medical_file = "{id_medical_file}" """
        cur.execute(sql)
        result = cur.fetchone()
        conn.close()
        # si il y a plusieurs résultats, comme plusieurs id pour un même dossier, il faudrait créer une nouvelle ligne dans le DF
        # avec l'id suivant, le même id dossier, et le même id sampler lab
        return result[0] if result != None else None
    
    def get_id_sampler_lab(self, name_sampler, postal_code_sampler):
        conn = self.db()
        cur = conn.cursor()
        sql = f"""SELECT id_sampler_lab FROM sampler_laboratories
                    WHERE name_sampler = "{name_sampler}"
                    AND postal_code_sampler = "{postal_code_sampler}" """
        cur.execute(sql)
        # TODO ici prend le premier si il y a plusieurs résultats, rendre unique !!!
        result = cur.fetchone()
        conn.close()
        return result[0] if result != None else None

    def get_id_sender_lab(self, name_sender, department_sender, town_sender, mnemoid_sender):
        conn = self.db()
        cur = conn.cursor()
        sql = f"""SELECT id_sender_lab FROM sender_laboratories
                    WHERE name_sender = "{name_sender}"
                    AND department_sender = "{department_sender}" 
                    AND town_sender = "{town_sender}"
                    AND mnemoid_sender = "{mnemoid_sender}" """
        cur.execute(sql)
        # TODO ici prend le premier si il y a plusieurs résultats, rendre unique !!!
        result = cur.fetchone()
        conn.close()
        return result[0] if result != None else None

    def get_id_set(self, version:str):
        conn = self.db()
        cur = conn.cursor()
        sql = f"""SELECT id_set FROM pipeline_sets WHERE version = "{version}" """
        cur.execute(sql)
        result = cur.fetchone()
        conn.close()
        return result[0] if result != None else None

    def get_id_samplesheet(self, id_seq_run, id_sample, id_plate):
        conn = self.db()
        cur = conn.cursor()
        if id_seq_run != None and id_sample != None:
            sql = f"""SELECT id_samplesheet FROM samplesheets
                    WHERE id_seq_run = "{id_seq_run}" AND id_sample = "{id_sample}" """
        elif id_sample != None and id_plate != None:
            sql = f"""SELECT id_samplesheet FROM samplesheets
                    WHERE id_sample = "{id_sample}" AND id_plate = "{id_plate}" """
        else:
            return None

        cur.execute(sql)
        result = cur.fetchone()
        conn.close()
        return result[0] if result != None else None

    def get_id_seq_run(self, id_sample, id_plate):
        conn = self.db()
        cur = conn.cursor()
        sql = f"""SELECT id_seq_run FROM samplesheets
                WHERE id_sample = "{id_sample}"
                AND  id_plate = "{id_plate}" """
        cur.execute(sql)
        result = cur.fetchone()
        conn.close()
        return result[0] if result != None else None

    def get_id_summary(self, id_bioinfo_run):
        conn = self.db()
        cur = conn.cursor()
        sql = f"""SELECT id_summary FROM bioinfo_runs WHERE id_bioinfo_run = "{id_bioinfo_run}" """
        cur.execute(sql)
        result = cur.fetchone()
        conn.close()
        return result[0] if result != None else None

    def get_table(self, table:str, id_samples=None, val_start=None, val_stop=None):
        columns = self.dbcols[table]
        columns.pop() # remove last column 'updated_at'
        conn = self.db()
        cur = conn.cursor()

        # Get table with samples numbers
        if id_samples != None:
            if table == 'samples':
                sql = f"""SELECT * FROM samples WHERE id_sample IN {id_samples};"""
            elif table == 'medical_files':
                sql = f"""SELECT * FROM medical_files WHERE id_medical_file IN
                          (SELECT id_medical_file FROM samples WHERE id_sample IN {id_samples});"""
            elif table == 'patients':
                sql = f"""SELECT * FROM patients WHERE id_patient IN 
                          (SELECT id_patient FROM medical_files WHERE id_medical_file IN
                          (SELECT id_medical_file FROM samples WHERE id_sample IN {id_samples}));"""
            elif table == 'sampler_laboratories':
                sql = f"""SELECT * FROM sampler_laboratories WHERE id_sampler_lab IN
                          (SELECT id_sampler_lab FROM samples WHERE id_sample IN {id_samples});"""
            elif table == 'sender_laboratories':
                sql = f"""SELECT * FROM sender_laboratories WHERE id_sender_lab IN
                          (SELECT id_sender_lab FROM samples WHERE id_sample IN {id_samples});"""

        # Validation date only in Samples table
        elif val_start != None and val_stop != None:
            if table == 'samples':
                sql = f"""SELECT * FROM samples WHERE validation_date
                          BETWEEN "{val_start}" AND "{val_stop}";"""
            elif table == 'medical_files':
                sql = f"""SELECT * FROM medical_files WHERE id_medical_file IN
                          (SELECT id_medical_file FROM samples WHERE validation_date
                          BETWEEN "{val_start}" AND "{val_stop}");"""
            elif table == 'patients':
                sql = f"""SELECT * FROM patients WHERE id_patient IN 
                          (SELECT id_patient FROM medical_files WHERE id_medical_file IN
                          (SELECT id_medical_file FROM samples WHERE validation_date
                          BETWEEN "{val_start}" AND "{val_stop}"));"""
            elif table == 'sampler_laboratories':
                sql = f"""SELECT * FROM sampler_laboratories WHERE id_sampler_lab IN
                          (SELECT id_sampler_lab FROM samples WHERE validation_date
                          BETWEEN "{val_start}" AND "{val_stop}");"""
            elif table == 'sender_laboratories':
                sql = f"""SELECT * FROM sender_laboratories WHERE id_sender_lab IN
                          (SELECT id_sender_lab FROM samples WHERE validation_date
                          BETWEEN "{val_start}" AND "{val_stop}");"""
        else:
            sql = f"""SELECT * FROM {table}"""
        try:
            cur.execute(sql)
        except ValueError:
            print(colors.bcolors.WARNING + "Error during execution of SQL query. Check the database." + colors.bcolors.ENDC)
        else:
            result = cur.fetchall()
            # TODO ameliorer: supprime le dernier element de chaque tuple pour retirer les dates
            # ce serait mieux en requete SQL
            # Remove created_at and updated_at information from result
            data = [el[:-2] for el in result]

        # TODO get les colonnes de la base pour matcher avec les données qqsoit l'ordre
        # Pour avoir les noms de colonnes depuis la base (mais pas dans l'ordre):
        # cur.execute(f"""SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
        #             WHERE TABLE_NAME = N'{table}' AND TABLE_SCHEMA = N'ngs'""")
        # cols2 = []
        # for tup in cur.fetchall():
        #     cols2.append(tup[0])
        conn.close()
        try:
            db_table = pd.DataFrame(data, columns=columns)
        except:
            raise Exception(colors.bcolors.FAIL + f"Incorrect number of column names compared to the number of columns for table '{table}': please check the DB_COLUMNS.csv file for this SQL table (check in migrations)." + colors.bcolors.ENDC)
        return db_table


    def get_last_id(self, id, table):
        conn = self.db()
        cur = conn.cursor()
        cur.execute(f'SELECT MAX({id}) FROM {table}')
        result = cur.fetchone()
        conn.close()
        return result[0]  # if result != None else 0

    def insert_data(self, data:pd.DataFrame, no_table:str=''):
        print(colors.bcolors.OKCYAN + "Importing or updating data into the SQL database..." + colors.bcolors.ENDC)
        # Open connection with db
        conn = self.db()

        # Table not to be filled
        self.no_table = no_table

        # Preparation for insertion into tables
        self.tables.set_columns(data)
        self.tables.set_tables(data)

        # Insertion requests
        for key, value in self.tables.data_insert.items():
            self.insert_table(conn, key, value)
        for key, value in self.tables.data_update.items():
            self.update_table(conn, key, value)

        # Close connection with db
        conn.close()

    def insert_table(self, conn, table, df):
        cur = conn.cursor()
        cols = "`,`".join([str(i) for i in df.columns.tolist()])

        # If this table is not to be filled (option in command), do nothing
        if self.no_table == table:
            return
        
        # TODO refaire l'insertion avec df.to_sql(table, con=engine)
        for i, row in df.iterrows():
            sql = "INSERT INTO " + table + " (`" + cols + "`) VALUES (" + "%s,"*(len(row)-1) + "%s)"
            try:
                try:
                    cur.execute(sql, tuple(row))
                    # with open(f"{log_dir}/sql_statements.log", "a") as f:
                    #     f.write(cur.statement + '\n')
                except (mysql.connector.Error, mysql.connector.Warning) as e:
                    with open(f"{log_dir}/errors.log", "a") as f:
                        f.write(str(e) + '\n')
                    raise e
                conn.commit()
            except Exception as e:
                exc_type, exc_obj, exc_tb = sys.exc_info()
                fname = os.path.split(exc_tb.tb_frame.f_code.co_filename)[1]
                print(exc_type, fname, exc_tb.tb_lineno)
                raise e

    def update_table(self, conn, table, df):
        cur = conn.cursor()
        for i, row in df.iterrows():
            values = tuple(row)
            # TODO make sql statement in one line
            for i in range(len(df.columns)):
                # No update on primary key
                if df.columns[i] != df.columns[0]:
                    sql = "UPDATE " + table + " SET " + \
                        df.columns[i] + "=%s" + " WHERE " + df.columns[0] + "=%s"
                    cur.execute(sql, (values[i], values[0]))
                    with open(f"{log_dir}/sql_statements.log", "a") as f:
                        f.write(cur.statement + '\n')
                    conn.commit()

    def query(self, ids, table):
        """Get data from table with given ids."""
        columns = self.dbcols[table]
        columns.pop() # remove last column 'updated_at'

        conn = self.db()
        cur = conn.cursor()
        big_data = []
        
        for id in ids:
            if table == 'patients':
                primkey = 'id_patient'    
            elif table == 'samples':
                primkey = 'id_sample'
            elif table == 'sampler_laboratories':
                primkey = 'id_sampler_lab'
            elif table == 'sender_laboratories':
                primkey = 'id_sender_lab'
            elif table == 'extractions':
                primkey = 'id_extraction'
            elif table == 'medical_files':
                primkey = 'id_medical_file'

            sql = f"SELECT * FROM {table} WHERE {primkey} = '{id}' "

            try:
                cur.execute(sql)
            except ValueError:
                print(colors.bcolors.WARNING + "Error during execution of SQL query. Check the database." + colors.bcolors.ENDC)
            else:
                result = cur.fetchall()
                # TODO ameliorer: supprime le dernier element de chaque tuple pour retirer les dates
                # ce serait mieux en requete SQL
                # Remove created_at and updated_at information from result
                data = [el[:-2] for el in result]

                try:
                    big_data = big_data + data
                    output = pd.DataFrame(big_data, columns=columns)
                except:
                    raise Exception(colors.bcolors.FAIL + f"Incorrect number of column names compared to the number of columns for table '{table}': please check the DB_COLUMNS.csv file for this SQL table (check in migrations)." + colors.bcolors.ENDC)
        conn.close()
        return output
    
    ####TESTS#####
    def test1(self):
        conn = self.db()
        cur = conn.cursor()
        sql = f"""SELECT * FROM samples"""
        cur.execute(sql)
        result = cur.fetchall()
        conn.close()