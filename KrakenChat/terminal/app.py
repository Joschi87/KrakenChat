#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

import getpass
import mysql.connector
from chatcommands import ChatCommands

#chatcommands = ChatCommands()

username = input("Username: ")
password = getpass.getpass("Password: ")

mydb = mysql.connector.connect(host="localhost", user="admin", passwd="passwort", database="")