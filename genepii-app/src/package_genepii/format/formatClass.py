import pandas as pd
import re
from datetime import datetime
from format.datesClass import Dates

class Format():
    def __init__(self, corres:str):
        self.dates = Dates(corres)
        
        # Corresponding formats and keep only not null values
        self.formats = pd.read_csv(f'{corres}/FORMATS-0.0.1.csv', sep=";", encoding="latin-1").to_dict('list')
        for key, value in self.formats.items():
            self.formats[key] = [x for x in value if not pd.isnull(x)]

        self.senders = pd.read_csv(f'{corres}/SENDER_LABS-0.0.1.csv', sep=";", encoding='latin-1').to_dict('list')
        for key, value in self.senders.items():
            self.senders[key] = [x for x in value if not pd.isnull(x)]

    def check_bioinfo_project(self, bioinfo_project):
        # TODO
        return bioinfo_project

    def check_ct(self, ct):
        if type(ct) == float:
            return ct
        elif type(ct) == str:
            try:
                ct = ct.replace(',', '.')
                return float(ct)
            except ValueError:
                if 'ET' in ct or 'ORF' in ct:
                    return ct
                return None
        return None

    def check_date(self, date):
        return self.dates.get_format_date(date)

    def check_department(self, dpt):
        "Check a department: it should exist and have 2 digits, or None."
        return dpt if type(dpt) == str and dpt.isnumeric() and 1 <= int(dpt) <= 99 else self.check_department(str(dpt)) if type(dpt) == int else None

    def check_finess(self, finess):
        "Check a finess: it should be a string of length 9 or None."
        return finess if type(finess) == str and finess.isnumeric() and len(finess) == 9 else self.check_finess(str(finess)) if type(finess) == int else None
    
    def check_flash_study(self, flash_study):
        "Check a flash study: it should be a string containing 'FLASH' or None."
        if type(flash_study) == str and 'FLASH' in flash_study :
            return flash_study.split("N_VW_")[1] if flash_study.startswith("N_VW_") else flash_study
        return None

    def check_float(self, myfloat):
        "Check a float"
        return float(myfloat) if type(myfloat) == str or type(myfloat) == float else None

    def check_hasdp(self, hasdp):
        return int(hasdp) if type(hasdp) == str or type(hasdp) == int else None

    def check_hasposc(self, hasposc):
        # 'FAILED'
        return hasposc if type(hasposc) == str else None

    def check_id_bioinfo_run(self, id):
        # TODO
        return id

    def check_id_medical_file(self, id):
        "Check a medical file id: it should be a string of length 10, else returns None."
        return id if type(id) == str and len(id) == 10 else self.check_id_medical_file(str(id)) if type(id) == int else None

    def check_id_plate(self, id):
        id_plate = "^[0-9]+Pl[0-9]+$" # like 22Pl63
        id_plate2 = "Pl[0-9]+$"
        if bool(re.match(id_plate, id)) or bool(re.match(id_plate2, id)):
            return id
        elif bool(re.match(id_plate, id)) or bool(re.match(id_plate2, id)):
            return id
        return None

    def check_id_sample(self, id):
        "Check a sample id: it should be a string else returns None."
        return id if type(id) == str else self.check_id_sample(str(id)) if type(id) == int else None

    def check_id_seq_run(self, id_seq_run):
        return id_seq_run if type(id_seq_run) == str else None

    def check_index(self, index):
        "Check an Illumina index: it should be a string of 10 letters among A,C,T,G."
        return index if type(index) == str and bool(re.match(r"^[A|C|T|G]{10}$", index)) else None

    def check_infoscan(self, infoscan):
        "Check an infoscan : should be a string, else returns None."
        return infoscan if type(infoscan) == str else None

    def check_int(self, myint):
        "Check an integer, positive or negative"
        # it can be a float or an integer, it is converted into integer
        return int(float(myint)) if type(myint) == str or type(myint) == int else None

    def check_ipp(self, ipp):
        "Check an IPP : it should be a string, else returns None."
        return ipp if type(ipp) == str else self.check_ipp(str(ipp)) if type(ipp) == int else None

    def check_mnemoid_sender(self, mnemoid_sender):
        "Check if mnemoid from labo sender exists."
        return mnemoid_sender if type(mnemoid_sender) == str else None

    def check_name(self, name):
        "Check a name : allows only letters and dashes."
        if type(name) == str:
            if bool(re.match(r"^[A-Za-z-]*$", name)):
                return name.upper()
            else:
                return re.sub(r"[^A-Za-z-]+", '', name).upper()
        return None

    def check_name_sender(self, name_sender):
        "Check a name sender: format with file"
        if type(name_sender) == str:
            for key, value in self.senders.items():
                if name_sender in value:
                    return key
                else:
                    # If all formats were tried it returns the name
                    if key == list(self.formats.keys())[-1]:
                        return name_sender
                    pass
        return name_sender

    def check_name_sampler(self, name_sampler):
        "Check a name sender: allows only letters, digits and dashes"
        if type(name_sampler) == str:
            if bool(re.match(r"^[A-Za-z0-9-]+", name_sampler)):
                return name_sampler.upper()
            else:
                return re.sub(r"[^A-Za-z0-9-]+", ' ', name_sampler).upper()
        return None

    def check_posint(self, posint):
        "Check a positive integer"
        # it can be a float or an integer, it is converted into integer
        return int(float(posint)) if type(posint) == str or type(posint) == int and int(posint) >= 0 else None
    
    def check_perc_cov(self, perc_cov):
        return float(perc_cov) if type(perc_cov) == str or type(perc_cov) == float else None

    def check_phone(self, phone):
        "Check a phone number: it should be a string with 2 or 10 digits, or None."
        if type(phone) == str:
            # If there are commas it removes it
            L = phone.split(',')
            phone = ''.join(L)
            # If something is written but without digits, it returns None.
            if not any(map(str.isdigit, phone)):
                return None
            elif len(phone) == 10 or len(phone) == 2:
                return phone
            elif type(phone) == int:
                self.check_phone(str(phone))
            return None
        return None

    def check_platewell(self, platewell):
        "Check a platewell format like S23"
        return platewell if bool(re.match("S[0-9]+$", platewell)) else None

    def check_postal_code(self, code):
        "Check a postal code : it should be a string of length between 2 and 5 digits, else returns None."
        return code if type(code) == str and code.isnumeric() and (2 <= len(code) <= 5) else self.check_postal_code(str(code)) if type(code) == int else None

    def check_question_scaninfo(self, qscaninfo: str):
        return qscaninfo.strip().replace(' ', '') if type(qscaninfo) == str else None

    def check_reference(self, reference:str):
        # refs = ['MN908947']
        # if reference in refs:
        #     return reference
        # return None
        return reference

    def check_sample_project(self, sample_project):
        # TODO
        return sample_project

    def check_sampling_type(self, materiel):
        "Check a sampling materiel: should be a string."
        if type(materiel) == str:
            if bool(re.match(r"[a-zA-Z-]+", materiel)):
                return materiel.lower()
            else:
                return re.sub(r"^[A-Za-z-]+", ' ', materiel).lower()
        return None

    def check_sex(self, sex):
        "Format a sex value into 'male' or 'female'."
        M = re.compile('m|masculin|male', flags=re.IGNORECASE)
        F = re.compile('f|feminin|féminin|female', flags=re.IGNORECASE)
        return 'male' if type(sex) == str and bool(M.match(sex)) else 'female' if type(sex) == str and bool(F.match(sex)) else None

    def check_set_index(self, set_index):
        "Check an Illumina set index."
        return set_index if type(set_index) == str else None # and bool(re.match(r"^[A-Z]{1}$", set_index)) else None

    def check_primers(self, primers):
        # TODO
        return primers

    def check_protocol(self, protocol):
        # TODO
        return protocol

    def check_sequencer(self, sequencer):
        # TODO between nextseq and novaseq?
        return sequencer

    def check_town(self, township):
        if type(township) == str:
            if bool(re.match(r"^[A-Za-z0-9-]+", township)):
                return township.upper()
            else:
                return re.sub(r"[^A-Za-z0-9-]+", ' ', township).upper()
        return None

    def check_vaccine_name(self, vaccine):
        "Check and format a vaccine name to get it more understandable."
        if type(vaccine) == str:
            vaccine = vaccine.strip().replace(' ', '').replace('/', '')
            for key, value in self.formats.items():
                if key not in ['YES', 'NO', 'dates']:
                    pattern = re.compile("|".join(value), re.I)
                    if bool(re.match(pattern, vaccine)):
                        return key
                    elif 'dose' in vaccine or 'DOSE' in vaccine or vaccine == '?':
                        return None
                    else:
                        try:
                            # Excel dates turned to string (formatting by Excel)
                            time = datetime.strptime(vaccine, '%H:%M:%S')
                            return time.strftime('%-I%p')
                        except ValueError:
                            # If all formats were tried it returns None
                            # if key == list(self.formats.keys())[-1]: # TODO ameliorate ; not working because we remove YES, NO, dates from keys
                            # if key == 'NV': # last key
                            #     return vaccine
                            return 'Autre'
        return vaccine

    def check_vaccination(self, vaccination):
        if type(vaccination) == str:
            for key, value in self.formats.items():
                pattern = re.compile("|".join(value), re.I)
                if re.match(pattern, vaccination):
                    return key
                elif vaccination == '1':
                    return 'YES'
                elif vaccination == '0':
                    return 'NO'
                # If all formats were tried it returns None
                if key == list(self.formats.keys())[-1]:
                    return vaccination
                pass
        return vaccination

    def check_birth_year(self, birth_year):
        "Check a birth year: it should be an integer between 1900 and 2022, or None."
        return birth_year if type(birth_year) == int and 1902 <= birth_year <= 2022 else self.check_birth_year(int(birth_year)) if type(birth_year) == str else None

    def replace_choice(self, item):
        if type(item) == str:
            for key, value in self.formats.items():
                if key in ['NR', 'NO', 'YES']:
                    pattern = re.compile("|".join(value), re.I)
                    if re.match(pattern, item):
                        return key
                    # If all formats were tried it returns None
                    if key == list(self.formats.keys())[-1]:
                        return None
                    pass
        return None