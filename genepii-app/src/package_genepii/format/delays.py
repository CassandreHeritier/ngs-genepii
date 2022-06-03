from datetime import datetime

def check_delay_registration(date, registration_date):
    if date is not None and registration_date is not None:
        date1 = datetime.strptime(date, '%Y-%m-%d %H:%M:%S')
        date2 = datetime.strptime(registration_date, '%Y-%m-%d %H:%M:%S')
        if date1 < date2:
            return date
    # TODO get bad dates
    return None