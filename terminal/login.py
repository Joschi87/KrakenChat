#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

import mysql.connector

def checkinglogin():

	mydb = mysql.connector.connect(host="localhost", user="admin", passwd="passwort", database="")


	#checking the variable in the db 
	
	checking_login = mydb.cursor()
	checking_login.execute("SELECT username, password FROM login WHERE username = %s AND password = %s", username, password)
	resultofchecking = checking_login.fetchall()

	if resultofchecking == True:
		global startloop
		startloop = 1
		global nameofuser
		nameofuser = username

	else:
		mydb.close()
		print("User was not found!")
		break