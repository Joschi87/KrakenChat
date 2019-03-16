#!/usr/bin/python3
#/Library/Frameworks/Python.framework/Versions/3.7/bin/python3

class ChatCommands():

	def __init__(self):

		#login member variables

		self.username = "";
		self.passwd = "";

		#ready-made chat commands member variable

		self.selectDB = "ls -all:/";
		self.selectChat = "ls -chat:/";
		self.showUser = "ls -users:/";
		self.backstep = "cd -back:/";
		self.forward = "cd -forward:/";
		self.writeMessage = "echo -message:/";