import pandas as pd
import numpy as np
from tools import colors
from format.formatClass import Format
from format.merge import *
from format.complete import *
from format.encrypt import *
from format.delays import *
from format.create import Create
from database.dbClass import DB

def format(corres:str, data:pd.DataFrame) -> pd.DataFrame:
    corres = corres
    data = data
    db = DB(corres, False, False)
    create = Create(corres)

    # Corresponding columns DB / file
    corres_col = pd.read_csv(f'{corres}/FILE_DF_COLUMNS-0.0.1.csv', sep=";", encoding="latin-1")
    db_columns = corres_col['db_columns'].to_list()
    db_columns = [x for x in db_columns if not pd.isnull(x)]

    print(colors.bcolors.OKCYAN + "Formatting data..." + colors.bcolors.ENDC)

    # Create dataframe from JSON file
    if type(data) == dict:
        version = data['version']
        dic = { 'id_set' : create.create_id_set(version), 'version': version }
        data = pd.DataFrame.from_dict(dic, orient='index')
        # Transpose index into columns
        return data.T

    # Fill dashes with None
    data.replace('-', None, inplace=True)
    data.replace('----------', None, inplace=True)
    
    corres_col = corres_col.where(pd.notnull(corres_col), None)
    toapply = dict(zip(corres_col['db_columns'], corres_col['method']))

    # Check columns formats
    for col in data.columns:
        check = Format(corres)
        try:
            # If a method is mentioned, use it
            if toapply[col] is not None:
                method = toapply[col]
            # Else check if the method exists with the name of column
            else:
                method = f'check_{col}'
            # Apply format method
            data[col] = data[col].apply(
                lambda x: getattr(check, method)(x))
        except:
            pass

    # Reset index
    data.reset_index()

    # Merge nexclade_glims_ng columns
    if 'nextclade_glims_ng' in data.columns and 'nextclade_glims_ng2' in data.columns:
        data['nextclade_glims_ng'] = data.apply(
            lambda x: merge_ng(x.nextclade_glims_ng, x.nextclade_glims_ng2), axis=1)

    # Merge flash_study columns if there are both
    if 'flash_study1' in data.columns and 'flash_study2' in data.columns:
        data['flash_study'] = data.apply(
            lambda x: merge_flash_study(x.flash_study1, x.flash_study2), axis=1)
    # Else rename without number
    elif 'flash_study1' in data.columns:
        data.rename(columns={'flash_study1': 'flash_study'}, inplace=True)
    elif 'flash_study2' in data.columns:
        data.rename(columns={'flash_study2': 'flash_study'}, inplace=True)

    # Create vaccine failure, nb_vaccine_doses and vaccinated columns
    if 'vaccination' in data.columns:
        data['nb_vaccine_doses'] = data.apply(
            lambda x: create.create_nb_vaccine_doses(x.vaccination, None), axis=1)
        data['vaccine_failure'] = data.apply(
            lambda x: create.create_vaccine_failure(x.vaccination), axis=1)

        # With not vaccinated
        if 'not_vaccinated' in data.columns:
            if 'vaccine_name' in data.columns:
                # With vaccine name
                data['vaccinated'] = data.apply(
                    lambda x: create.create_vaccinated(x.vaccination, x.not_vaccinated, x.vaccine_failure, x.vaccine_name), axis=1)
            else:
                # Without vaccine name
                data['vaccinated'] = data.apply(
                    lambda x: create.create_vaccinated(x.vaccination, x.not_vaccinated, x.vaccine_failure, None), axis=1)     
        # Without not vaccinated
        else:
            data['vaccinated'] = data.apply(
                    lambda x: create.create_vaccinated(x.vaccination, None, x.vaccine_failure, None), axis=1)    

    # Complete or create nb vaccine doses and complete_scheme
    if 'vaccine_name' in data.columns:
        if 'nb_vaccine_doses' in data.columns:
            data['nb_vaccine_doses'] = data.apply(
                lambda x: complete_nb_vaccine_doses(x.nb_vaccine_doses, x.vaccine_name), axis=1)
        else:
            data['nb_vaccine_doses'] = data.apply(
                lambda x: create.create_nb_vaccine_doses(None, x.vaccine_name), axis=1)
        data['complete_scheme'] = data.apply(
            lambda x: create.create_complete_scheme(x.vaccine_name), axis=1)

    # Complete vaccinated with nb_vaccine_doses and vaccine_failure
    if 'vaccinated' in data.columns and 'nb_vaccine_doses' in data.columns:
        data['vaccinated'] = data.apply(
            lambda x: complete_vaccinated(x.vaccinated, x.nb_vaccine_doses), axis=1)

    # Create id_sample foreign key if id_medical_file known and unique
    if 'id_sample' not in data.columns and 'id_medical_file' in data.columns:
        data['id_sample'] = data.apply(
            lambda x: db.get_id_sample(x.id_medical_file), axis=1)

    # Create ac_treatment_failure
    if 'ac_treatment' in data.columns:
        data['ac_treatment_failure'] = data.apply(
            lambda x: create.create_ac_treatment_failure(x.ac_treatment), axis=1)

    # Create birth_year column from birth_date
    if 'birth_date' in data.columns:
        # Create age column from birth year or birth date
        if 'bith_year' in data.columns:
            data['age'] = data.apply(
                lambda x: create.create_age(x.birth_year), axis=1)
        else:
            data['age'] = data.apply(
                lambda x: create.create_age(x.birth_date), axis=1)
            data['birth_year'] = data.apply(
                lambda x: create.create_birth_year(x.birth_date), axis=1)

        # Crypte birth date and birth year
        data['birth_date'] = data.apply(
            lambda x: encrypt_birth_date(x.birth_date), axis=1)
        data['birth_year'] = data.apply(
            lambda x: encrypt_birth_year(x.birth_year), axis=1)

    # Create id_patient if firstname, lastname, birth known and unique
    if 'firstname' in data.columns and 'lastname' in data.columns:
        data['firstname'] = data.apply(
            lambda x: encrypt_name(x.firstname), axis=1)
        data['lastname'] = data.apply(
            lambda x: encrypt_name(x.lastname), axis=1)

        if 'birth_date' in data.columns:
            data['id_patient'] = data.apply(
                lambda x: create.create_id_patient(x.firstname, x.lastname, x.birth_date, None), axis=1)
        elif 'birth_year' in data.columns:
            data['id_patient'] = data.apply(
                lambda x: create.create_id_patient(x.firstname, x.lastname, None, x.birth_year), axis=1)
    
    # Create type columns
    if 'finess' in data.columns:
        data['type'] = data.apply(
            lambda x: create.create_type(x.finess, None), axis=1)

    # Check delay between vaccine doses and registration date
    if 'date_first_dose' in data.columns and 'registration_date' in data.columns:
        data['date_first_dose'] = data.apply(
            lambda x: check_delay_registration(x.date_first_dose, x.registration_date), axis=1)
    
    if 'date_second_dose' in data.columns and 'registration_date' in data.columns:
        data['date_second_dose'] = data.apply(
            lambda x: check_delay_registration(x.date_second_dose, x.registration_date), axis=1)

    if 'date_last_dose' in data.columns and 'registration_date' in data.columns:
        data['date_last_dose'] = data.apply(
            lambda x: check_delay_registration(x.date_last_dose, x.registration_date), axis=1)

    if 'sampling_date' in data.columns and 'registration_date' in data.columns:
        data['sampling_date'] = data.apply(
            lambda x: check_delay_registration(x.sampling_date, x.registration_date), axis=1)

    # Create id_sender_lab
    if 'name_sender' in data.columns and 'department_sender' in data.columns and 'town_sender' in data.columns:
        if 'mnemoid_sender' in data.columns:
            data['id_sender_lab'] = data.apply(
                lambda x: create.create_id_sender_lab(x.name_sender, x.department_sender, x.town_sender, x.mnemoid_sender), axis=1)
        else:
            data['id_sender_lab'] = data.apply(
                lambda x: create.create_id_sender_lab(x.name_sender, x.department_sender, x.town_sender, None), axis=1)
        
        # Create sampler lab if does not exist with sender lab by default
        if 'name_sampler' not in data.columns and 'postal_code_sampler' not in data.columns:
            data['name_sampler'] = data.apply(
                lambda x: x.name_sender, axis=1)
            data['postal_code_sampler'] = data.apply(
                lambda x: x.department_sender, axis=1)

    # Create id_sampler_lab
    if 'name_sampler' in data.columns and 'postal_code_sampler' in data.columns:
        data['id_sampler_lab'] = data.apply(
            lambda x: create.create_id_sampler_lab(x.name_sampler, x.postal_code_sampler), axis=1)

    # Create serious case column
    if 'serious_case' not in data.columns:
        if 'name_sender' in data.columns:
            data['serious_case'] = data.apply(
                lambda x: create.create_serious_case(None, x.name_sender), axis=1)
        elif 'mnemoid_sender' in data.columns:
            data['serious_case'] = data.apply(
                lambda x: create.create_serious_case(None, x.mnemoid_sender), axis=1)
    else:
        if 'name_sender' in data.columns:
            data['serious_case'] = data.apply(
                lambda x: create.create_serious_case(x.serious_case, x.name_sender), axis=1)
        elif 'mnemoid_sender' in data.columns:
            data['serious_case'] = data.apply(
                lambda x: create.create_serious_case(x.serious_case, x.mnemoid_sender), axis=1)

    # Create foreign key id_medical_file
    if 'question_scaninfo' in data.columns and 'id_sample' in data.columns and 'id_medical_file' not in data.columns:
        data['id_medical_file'] = data.apply(
            lambda x: create.create_id_medical_file(x.id_sample, x.question_scaninfo), axis=1)

    # Create id_extraction when we see a column from extraction file
    if 'record_id' in data.columns:
        data['id_extraction'] = data.apply(
            lambda x: create.create_id_extraction(), axis=1)

    # Create id_plate from trackbc
    if 'track_bc' in data.columns:
        data['id_plate'] = data.apply(
            lambda x: create.create_id_plate(x.track_bc), axis=1)

    # Create id_plate, id_sample and id_medical_file from sample_id_ss
    if 'sample_id_ss' in data.columns:
        data['id_plate'] = data.apply(
            lambda x: create.create_id_plate(x.sample_id_ss), axis=1)
        if 'id_sample' not in data.columns:
            data['id_sample'] = data.apply(
                lambda x: create.create_id_sample(x.sample_id_ss), axis=1)
                # Create id_medifcal_file foreign key if id_sample known and unique
            data['id_medical_file'] = data.apply(
                lambda x: create.create_id_medical_file(x.id_sample, None), axis=1)

    # Create id_plate, plateweel, id_sample and id_medical_file from sample_id_summary
    if 'sample_id_summary' in data.columns:
        data['id_plate'] = data.apply(
            lambda x: create.create_id_plate(x.sample_id_summary), axis=1)
        data['platewell'] = data.apply(
            lambda x: create.create_platewell(x.sample_id_summary), axis=1)
        if 'id_sample' not in data.columns:
            data['id_sample'] = data.apply(
                lambda x: create.create_id_sample(x.sample_id_summary), axis=1)
                # Create id_medifcal_file foreign key if id_sample known and unique
            data['id_medical_file'] = data.apply(
                lambda x: create.create_id_medical_file(x.id_sample, None), axis=1)

    # Create id_samplesheet
    if 'id_seq_run' in data.columns and 'id_sample' in data.columns:
        data['id_samplesheet'] = data.apply(
            lambda x: create.create_id_samplesheet(x.id_seq_run, x.id_sample), axis=1)

    # Get id_seq_run if exists from one sample, one plate, one platewell
    if 'id_bioinfo_run' in data.columns and 'id_plate' in data.columns and 'id_sample' in data.columns:
        data['id_seq_run'] = data.apply(
            lambda x: db.get_id_seq_run(x.id_sample, x.id_plate), axis=1)
        # Get id samplesheet to insert platewell into samplesheets table, because it requires the primary key
        data['id_samplesheet'] = data.apply(
            lambda x: db.get_id_samplesheet(x.id_seq_run, x.id_sample, x.id_plate), axis=1)
    
    # Create id of results
    if 'id_bioinfo_run' in data.columns:
        data['id_summary'] = data.apply(
            lambda x: create.create_id_results('id_summary', 'summary_results', x.id_bioinfo_run), axis=1)
        data['id_nextclade'] = data.apply(
            lambda x: create.create_id_results('id_nextclade', 'nextclade_results', x.id_bioinfo_run), axis=1)
        data['id_pangolin'] = data.apply(
            lambda x: create.create_id_results('id_pangolin', 'pangolin_results', x.id_bioinfo_run), axis=1)
        data['id_validation'] = data.apply(
            lambda x: create.create_id_results('id_validation', 'validation_results', x.id_bioinfo_run), axis=1)
        data['bioinfo_run_date'] = data.apply(
            lambda x: create.create_bioinfo_run_date(x.id_bioinfo_run), axis=1)

    # Remove empty rows
    data.dropna(how='all', inplace=True)
    data = data.fillna(np.nan).replace({np.nan: None})

    # Replace all null values (NaN, NaT) by None
    data = data.where(pd.notnull(data), None)
    return data