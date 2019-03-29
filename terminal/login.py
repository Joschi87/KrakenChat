#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

import mysql.connector

def checkinglogin(username, password):

	startloop = 0
	nameofuser = None

	print(username)
	print(password)

	mydb = mysql.connector.connect(host="127.0.0.1", user="root", passwd="", database="TerminalTestDB")


	#checking the variable in the db 
	
	checking_login = mydb.cursor()
	checking_login.execute("SELECT Username, Passwd FROM login WHERE Username = %s AND Passwd = %s", (username, password))
	resultofchecking = checking_login.fetchall()

	print(resultofchecking)

	if resultofchecking:

		startloop = 1
		
		nameofuser = username

	else:
		mydb.close()

	return (startloop, nameofuser)