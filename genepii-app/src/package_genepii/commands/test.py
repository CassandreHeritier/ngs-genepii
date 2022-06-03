from tools import colors
from database.dbClass import DB 
import threading

def test(corres:str):
    db = DB(corres)
    try:
        # Create threads to run multiple tests
        threads = [threading.Thread(target=db.test1()) for i in range(1, 1000)]

        # Start threads
        for thread in threads:
            thread.start()
            
        for thread in threads:
            thread.join()

        # Wait for the threads to finish
        # Thread1.join()
        # Thread2.join()
        
        print(colors.bcolors.OKGREEN + "Tests OK !" + colors.bcolors.ENDC)
    except:
        raise Exception(colors.bcolors.FAIL + "Error during tests" + colors.bcolors.ENDC)