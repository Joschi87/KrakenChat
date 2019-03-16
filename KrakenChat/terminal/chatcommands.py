#!/usr/bin/python3
#/Library/Frameworks/Python.framework/Versions/3.7/bin/python3


class ChatCommands:

	def __init__(self):

		#login member variables

		self.username = "";
		self.passwd = "";

		#ready-made chat commands member variable

		self.selectDB = "ls -all:/"; #view of all chats 
		self.selectNotifications = "ls -note" #view all open notifications
		self.selectChat = "ls -chat:/"; # view single chat
		self.showUser = "ls -users:/"; #view all users with the status of ther(online or offline)
		self.selectProfil = "ls -profil"; #view profils of other user
		self.backstep = "cd -back:/"; #go a level back
		self.forward = "cd -forward:/"; #go a level forward
		self.writeMessage = "echo -message:/"; #write a new message
		self.createChat = "echo -chat:/"; #create a new chat
		self.deleteChat = "remove -chat:/"; #delete a chat


		#variable for the users chat commands inputs
		#the varaiable are almost the same like the ready-made chat commands only that is a user after the self  

		self.userselectDB = "";
		self.userselectNotifications = "";
		self.userselectChat = "";
		self.usershowUser = "";
		self.userselectProfil = "";
		self.userbackstep = "";
		self.userforward = "";
		self.userwirteMessage = "";
		self.usercreateChat = "";
		self.userdeleteChat = "";

	def needhelp(self):
		
		#create the function help with a dictionary of all chat commands and present as a for loop

		help_dictionary = {
			"view_all_chats" : self.selectDB + " View of all your Chats",
			"view_all_open_notifications" : self.selectNotifications + " View all open notifications in your profil",
			"view_single_chat" : self.selectChat + " View a single chat",
			"view_show_user" : self.showUser + " View the status of the users (Online or Offline)",
			"view_profil" : self.selectProfil + " View the profil of a other user",
			"view_backstep" : self.backstep + " Go a level back",
			"view_forward" : self.forward + " Go a level forward",
			"view_write_message" : self.writeMessage + " write a new message into the chat",
			"view_create_chat" : self.createChat + " create a new chat with a user",
			"view_delete_chat" : self.deleteChat + " delete a chat"
		}

		for x in help_dictionary:
			print(help_dictionary[x]);
