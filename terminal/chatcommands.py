#!/Library/Frameworks/Python.framework/Versions/3.7/bin/python3
#/usr/bin/python3

#this import is for the command create chats
from random import randint

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
		self.help = "--help:/"; #help

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
			print(help_dictionary[x])

	def checkingthecommand(self, userinput, datetime):

		try:

			#try to connection to the mysql server with database

			mydb = mysql.connector.connect(host="localhost", user="admin", passwd="passwort", database="")

		except:

			print("Connection failed to the MYSQL server")

		finally:

			pass

		#Start checking the userinput

		if self.userinput == self.selectDB:

			try:

				#Select all chat ids from the database

				chatdb = mydb.cursor()
				chatdb.execute("SELECT ChatID, Ersteller, Empfaenger FROM ChatConnection WHERE Ersteller = %s OR Empfaenger = %s", self.username, self.username)
				showallchats = chatdb.fetchall()

				#for loop for print the result of the mysql select command

				for allchats in showallchats:
					print(allchats)

			except:

				print("something went wrong!")

			finally:

				if mydb.is_connect():

					#close the chatdb.cursor and close the mysql connection

					chatdb.close()
					mydb.close()


		elif userinput == self.selectNotifications:

			try:

				#Select all notifications for your profi

				mynotifications = mydb.cursor()
				mynotifications.execute("SELECT ChatID, Ersteller, Empfaenger, Notification FROM ChatConnection WHERE Notification = 'Neue Mitteilung' AND Ersteller = %s OR Empfaenger = %s", self.username, self.username)
				showallnotes = mynotifications.fetchall()

				#for loop for print the result of the mysql select command

				for allnotes in showallnotes:
					print(allnotes)

			except:
				print("something went wrong!")

			finally:

				if mydb.is_connect():
				
					#close the mynotifications.cursor and close the mysql connection

					mynotifications.close()
					mydb.close()


		elif userinput.startswith(self.selectChat):

			try:

				#loading of a single chat

				chatID = arg_splitter(userinput, self.selectChat, 1)

				mychat = mydb.cursor()
				mychat.execute("SELECT DatumUhrzeit, Sender, Nachricht FROM %s", chatID)
				showsinglechat = mychat.fetchall()

				#for loop for print the result of the mysql select command

				for singlechat in showsinglechat:
				print(singlechat)

			except:
				print("something went wrong!")

			finally:

				if mydb.is_connect():
					
					#close the mychat.cursor and close the mysql connection

					mychat.close()
					mydb.close()

			
		elif userinput.startswith(self.showUser):

			#loading the list pf member in the chat programm and order that the member ther are online 

			searchinguser = arg_splitter(userinput, self.showUser, 1)

			allusers = mydb.cursor()
			allusers.execute("SELECT Vorname, Nachname, benutzername, Aktiv FROM login")
			showingusers = allusers.fetchall()

			#for loop for print the result of the mysql select command

			for chatmembers in showingusers:
				print(chatmembers)

			#close the allusers.cursor and close the mysql connection
			
			allusers.close()
			mydb.close()

		elif userinput.startswith(self.selectProfil):
			
			#loading the single profil which the users put in the userinput

			openprofil = arg_splitter(userinput, self.selectProfil, 1)

			showProfil = mydb.cursor()
			showProfil.execute("SELECT * FROM Profil WHERE benutzername = %s", openprofil)
			loadProfil = showProfil.fetchall()

			#for loop for print the result of the mysql select command

			for printProfil in loadProfil:
				print(printProfil)

			#close the showProfil.cursor and close the mysql connection

			showProfil.close()
			mydb.close()

		elif userinput.startswith(self.writeMessage):

			try:
			
				#split the userinput in chatID and the message 

				chatID, message = arg_splitter(userinput, self.writeMessage, 2)

				#SQL insert into function

				writeNewMessage = mydb.cursor()
				writeNewMessage.execute("INSERT INTO %s (Nachricht, Sender, DatumUhrzeit) VALUES (%s, %s, %s)", chatID, message, self.username, datetime)

				writeNewMessage.commit()

			except mysql.connector.Error as error :
				print("Failed to insert the meassage: {}".format(error))

			finally:

				if mydb.is_connect():

					#clsoe the writeNewMessage.cursor and close the mysql connection

					writeNewMessage.close()
					mydb.close()


		elif userinput.startswith(self.createChat):
			
			try:
				
				#split the userinput in receiver name

				chatname, empfaenger = arg_splitter(userinput, self.createChat, 2)

				#create a random number for the chat id

				newChatIdNumber = randint(10000000, 99999999)

				#sql code for createing the new table and write into the chatconnection

				creatingchat = mydb.cursor()
				creatingchat.execute("CREATE TABLE "datenbank" + "newChatIdNumber" ( ID INT NOT NULL AUTO_INCREMENT ,  Nachricht TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,  Sender TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , DatumUhrzeit DATETIME NOT NULL ,  PRIMARY KEY  (ID)) ENGINE = InnoDB")
				creatingchat.execute("INSERT INTO ChatConnection (ChatID, Ersteller, Empfaenger) VALUES (%s, %s,%s)", newChatIdNumber, self.username, empfaenger)

				creatingchat.commit()

			except mysql.connector.Error as error:
				print("Something went wrong: {}".format(error))

			finally:

				if mydb.is_connect():

					#close the createchat.cursor and close the mysql connection

					createchat.close()
					mydb.close()


		elif userinput.startswith(self.deleteChat):
			
			try:
				
				#split the userinput in chat id which want to  delete

				deletechatid = arg_splitter(userinput, self.deleteChat, 1)

				#sql code for deleting the chat

				deletingchat = mydb.cursor()
				deletingchat.execute("DROP TABLE IF EXISTS %s", deletechatid)

			except mysql.connector.Error as error:
				print("something went wrong: {}".format(error))

			finally:

				if mydb.is_connect():

					#close the createchat.cursor and close the mysql connection

					deletingchat.close()
					mydb.close()

		elif userinput == self.help:

			needhelp()

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
			