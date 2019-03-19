#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

import getpass
import mysql.connector
from chatcommands import ChatCommands
from login import checkinglogin
from checkinginput import checkingthecommand

chatcommands = ChatCommands()

username = input("Username: ")
password = getpass.getpass("Password: ")

#checking the both input 

if username == "" or password == "":
	print("You do not write a username or a password")
	break
	exit()

else:
	#open function checkinglogin

	login.checkinglogin()

	pointofexit = None

	if startloop == 1:

		#Start the while loop if the login successfully

		while pointofexit != True:
		
			chatcommands.userinput = input()

			checkinginput(chatcommands.userinput)


	else:
		print("Wrong Username or password")


		