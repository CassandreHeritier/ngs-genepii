import hashlib
import unidecode

def encrypt_birth_date(birth_date):
        "Encrypt in hash key the date of birth"
        if type(birth_date) == str: # et birth date entre 1902 et 2022
            encoded = birth_date.encode()
            result = hashlib.sha256(encoded)
            hexkey = result.hexdigest()
            return hexkey
        return None
    
def encrypt_birth_year(birth_year):
    "Encrypt in hash key the year of birth"
    if type(birth_year) == str:
        encoded = birth_year.encode()
        result = hashlib.sha256(encoded)
        hexkey = result.hexdigest()
        return hexkey
    elif type(birth_year) == int or type(birth_year) == float:
        return encrypt_birth_year(str(birth_year))
    return None

def encrypt_name(name):
    "Check that the firstname is a string and not null, and returns the crypted firstname."
    if type(name) == str:
        # normalize name : remove accents and make it lower case
        # name = unidecode.unidecode(name)
        # name = name.lower()
        encoded = name.encode()
        result = hashlib.sha256(encoded)
        hexkey = result.hexdigest()
        return hexkey
    return None