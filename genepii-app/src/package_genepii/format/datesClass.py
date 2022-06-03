import pandas as pd
from datetime import datetime
import math

class Dates():
    def __init__(self, corres:str):
        self.dico = {}
        self.count = 0
        self.id = None
        corres_formats = pd.read_csv(f'{corres}/FORMATS-0.0.1.csv', sep=";", encoding='latin-1')
        self.formats = [x for x in corres_formats['dates'].to_list() if pd.isnull(x) == False]

    def get_format_date(self, date):
        self.count += 1
        for format in self.formats:
            # Convert integer date into string date
            if type(date) == int:
                date = str(date)
            if type(date) == str and len(date) > 2:
                # Remove leading spaces
                if ' ' in date:
                    date = date.strip().replace(' ', '/')
                # If the date lacks digits they are completed on a case by case basis
                elif date.isnumeric() and (3 <= len(date) <= 5):
                    # Complete the date according to the number of digits
                    if len(date) == 3:
                        # See if it's the year last or the month
                        if int(date[-2]) != 2:
                            date = '0' + date + '21'  # if no year: 2021 or 2022 by default?
                        else:
                            date = '01' + '0' + date  # if no day : first of the month by default
                    elif len(date) == 4:
                        date = date + \
                            '21' if not date.endswith(
                                '21') or not date.endswith('22') else '01' + date
                    elif len(date) == 5:
                        date = '0' + \
                            date if not date.endswith('2021') or not date.endswith(
                                '2022') else '01' + '0' + date
                        # We have either day, month, year (3102021) or month, year, in which case we add the day (72021)
                    # Convert to the right format
                    n = 2  # Takes two by two numbers
                    L = [date[i:i+n] for i in range(0, len(date), n)]
                    # Creates a string, which will pass into the 2nd loop
                    date = '/'.join(L)
                # Case where we have 15-06:
                elif '-' in date and len(date) == 5:
                    date = '/'.join(date.split('-'))
                    date = date + '/21'
                # All other string dates attempt to convert to string
                try:
                    date = datetime.strptime(date, format)
                    return date.strftime('%Y-%m-%d %H:%M:%S')
                # If the date is not formatted an exception is raised
                except ValueError:
                    # If it is the last format, the date has still not matched a format so it returns None
                    if format == '%m/%d/%Y':
                        self.dico[self.count] = date
                        return None
                    pass
            # If the date is empty (null float) it is replaced with an empty string
            elif type(date) == float and math.isnan(date):
                return None
            # If the date is already well formatted, it turns to string
            elif type(date) == datetime:
                return date.strftime('%Y-%m-%d %H:%M:%S')
            # If the date is None,it stays None
            elif date == None:
                return None
            # Treats all other cases
            else:
                # Try to convert at least to string
                try:
                    date = str(date)
                # If it is the last format, it returns None
                except ValueError:
                    if format == '%m/%d/%Y':
                        self.dico[self.count] = date
                        return None
                    pass