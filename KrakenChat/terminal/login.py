#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

def checkinglogin():

	#checking the variable in the db 
	
	checking_login = mydb.cursor()
	checking_login.execute("SELECT username, password FROM login WHERE username = %s AND password = %s", username, password)
	resultofchecking = checking_login.fetchall()

	print(resultofchecking)
	break
