#!/usr/bin/python3
#/Library/Frameworks/Python.framework/Versions/3.7/bin/python3

import mysql.connector

verbindung = mysql.connector.connect(
	host="localhost",
	user="admin",
	passwd="passwort",
	database=""
	)