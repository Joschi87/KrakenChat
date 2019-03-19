#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

import mysql.connector
from chatcommands import ChatCommands

chatcommand = ChatCommands()

def checkingthecommand(self, userinput):

		#Start checking the userinput

		if userinput == chatcommand.selectDB:


		elif userinput == chatcommand.selectNotifications:


		elif userinput == chatcommand.selectChat:

			
		elif userinput == chatcommand.showUser:


		elif userinput == chatcommand.selectProfil:


		elif userinput == chatcommand.backstep:


		elif userinput == chatcommand.forward:


		elif userinput == chatcommand.writeMessage:


		elif userinput == chatcommand.createChat:


		elif userinput == chatcommand.deleteChat:


		else:
			print("Indefinable input. Please use the chat commands or use the help function")
			