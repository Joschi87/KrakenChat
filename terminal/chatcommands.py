#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3


class ChatCommands:

	def __init__(self):

		#login member variables

		self.username = "";
		self.passwd = "";

		#ready-made chat commands member variable

		self.selectDB = "ls -all:/"; #view of all chats 
		self.selectNotifications = "ls -note:/" #view all open notifications
		self.selectChat = "ls -chat:/"; # view single chat
		self.showUser = "ls -users:/"; #view all users with the status of ther(online or offline)
		self.selectProfil = "ls -profil:/"; #view profils of other user
		self.writeMessage = "echo -message:/"; #write a new message
		self.createChat = "echo -chat:/"; #create a new chat
		self.deleteChat = "remove -chat:/"; #delete a chat
		self.logout = "exit -logout:/"; #logout from the chat

	def needhelp(self):
		
		#create the function help with a dictionary of all chat commands and present as a for loop

		help_dictionary = {
			"view_all_chats" : self.selectDB + " View of all your Chats",
			"view_all_open_notifications" : self.selectNotifications + " View all open notifications in your profil",
			"view_single_chat" : self.selectChat + " View a single chat",
			"view_show_user" : self.showUser + " View the status of the users (Online or Offline)",
			"view_profil" : self.selectProfil + " View the profil of a other user",
			"view_write_message" : self.writeMessage + " write a new message into the chat",
			"view_create_chat" : self.createChat + " create a new chat with a user",
			"view_delete_chat" : self.deleteChat + " delete a chat",
			"view_logout" : self.logout + " logout from chat"
		}

		for x in help_dictionary:
			print(help_dictionary[x]);

	def checkingthecommand(self, userinput):

		mydb = mysql.connector.connect(host="localhost", user="admin", passwd="passwort", database="")	

		#Start checking the userinput

		if self.userinput == self.selectDB:

			#Select all chat ids from the database

			chatdb = mydb.cursor()
			chatdb.execute("SELECT ChatID, Ersteller, Empfaenger FROM ChatConnection WHERE Ersteller = %s OR Empfaenger = %s", self.username, self.username)
			showallchats = chatdb.fetchall()

			for allchats in showallchats:
				print(allchats)

		elif userinput == self.selectNotifications:

			#Select all notifications for your profi

			mynotifications = mydb.cursor()
			mynotifications.execute("SELECT ChatID, Ersteller, Empfaenger, Notification FROM ChatConnection WHERE Notification = 'Neue Mitteilung' AND Ersteller = %s OR Empfaenger = %s ORDER BY Notification DESC", self.username, self.username)
			showallnotes = mynotifications.fetchall()

			for allnotes in showallnotes:
				print(allnotes)


		elif userinput.startswith(self.selectChat):

			chatID = arg_splitter(userinput, self.selectChat, 1)
			mychat = mydb.cursor()
			mychat.execute("SELECT DatumUhrzeit, Sender, Nachricht FROM %s ORDER BY DESC", chatID)
			showsinglechat = mychat.fetchall()

			for singlechat in showsinglechat:
				print(singlechat)

			
		elif userinput == self.showUser:
			pass

		elif userinput == self.selectProfil:
			pass

		elif userinput.startswith(self.writeMessage):

			chatID, message = arg_splitter(userinput, self.writeMessage, 2)


		elif userinput == self.createChat:
			pass

		elif userinput == self.deleteChat:
			pass

		elif userinput == self.logout:

			return True

		else:
			print("Indefinable input. Please use the chat commands or use the help function")

		return False

	def arg_splitter(self, userinput, command, argnum):
		arg = userinput.replace(command, "").strip()
		if argnum == 1:
			return arg

		return arg.split("/", argnum)
			