def complete_name_sampler(name_sampler, name_sender):
    return name_sampler if name_sampler != None else name_sender if name_sender != None else None

def complete_nb_vaccine_doses(nb_vaccine_doses, vaccine_name):
    if type(vaccine_name) == str:
        # Remove spaces and slashes
        vaccine_name = vaccine_name.strip().replace(' ', '').replace('/', '')
        # Get number of doses if given
        if vaccine_name.isnumeric() and int(vaccine_name) < 10:
            return int(vaccine_name)
        elif 'DOSE' in vaccine_name:
            return vaccine_name[0]
        return nb_vaccine_doses
    return nb_vaccine_doses

def complete_postal_code_sampler(postal_code_sampler, department_sender):
    return postal_code_sampler if postal_code_sampler != None else department_sender if department_sender != None else None

def complete_vaccinated(vaccinated, nb_vaccine_doses):
    # If vaccinated already filled, keep on
    if vaccinated is not None:
        # print(vaccinated)
        return vaccinated
    # # A vaccine failure imply that there was vaccine
    # elif vaccine_failure == 'YES':
    #     # print(vaccine_failure)
    #     return 'YES'
    # Doses imply that patient is vaccinated
    elif nb_vaccine_doses is not None and nb_vaccine_doses > 0:
        return 'YES'
    # 0 dose imply that patient is not vaccinated
    elif nb_vaccine_doses == 0:
        return 'NO'
    return None