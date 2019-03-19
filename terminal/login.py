#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

import mysql.connector

def checkinglogin(username, password):

	mydb = mysql.connector.connect(host="localhost", user="admin", passwd="passwort", database="")


	#checking the variable in the db 
	
	checking_login = mydb.cursor()
	checking_login.execute("SELECT username, password FROM login WHERE username = %s AND password = %s", username, password)
	resultofchecking = checking_login.fetchall()

	if resultofchecking == True:

		startloop = 1
		nameofuser = username

		return (startloop, nameofuser)

	else:
		mydb.connector.close()
		print("User was not found!")