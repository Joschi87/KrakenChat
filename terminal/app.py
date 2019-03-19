#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

import getpass
from chatcommands import ChatCommands
from login import checkinglogin

chatcommands = ChatCommands()

chatcommands.username = input("Username: ")
chatcommands.passwd = getpass.getpass("Password: ")

#checking the both input 

if username == "" or password == "":
	print("You do not write a username or a password")
	exit()

else:
	#open function checkinglogin

	startloop, nameofuser = login.checkinglogin(username, password)

	pointofexit = False

	if startloop == 1:

		#Start the while loop if the login successfully

		while pointofexit is False:
		
			userinput = input()

			pointofexit = chatcommands.checkingthecommand(userinput)


	else:
		print("Wrong Username or password")


		