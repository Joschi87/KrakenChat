#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

import getpass
import datetime
from chatcommands import ChatCommands
from login import checkinglogin

chatcommands = ChatCommands()

chatcommands.username = input("Username: ")
chatcommands.passwd = getpass.getpass("Password: ")

#checking the both input 

if chatcommands.username == "" or chatcommands.passwd == "":
	
	print("You do not write a username or a password")
	exit()

else:
	#open function checkinglogin

	startloop, nameofuser = checkinglogin(chatcommands.username, chatcommands.passwd)

	pointofexit = False

	if startloop == 1:

		#Start the while loop if the login successfully

		while pointofexit is False:

			currenttime = datetime.datetime.now()

			print("Please write a command:")
		
			userinput = input()

			pointofexit = chatcommands.checkingthecommand(userinput, datetime)

			print(pointofexit)


	else:
		print("Wrong Username or password")


		