<?php

	//Information aus dem Header laden

	$User = $_GET['User'];

	//Informationen aus dem Formular laden

	$Groupname = $_POST['Groupname'];
	$Groupdescription = $_POST['Groupdescription'];
	$GroupMember1 = $_POST['GroupMember1'];
	$GroupMember2 = $_POST['GroupMember2'];
	$GroupMember3 = $_POST['GroupMember3'];
	$GroupMember4 = $_POST['GroupMember4'];
	$GroupMember5 = $_POST['GroupMember5'];
	$GroupMember6 = $_POST['GroupMember6'];
	$GroupMember7 = $_POST['GroupMember7'];
	$GroupMember8 = $_POST['GroupMember8'];
	$GroupMember9 = $_POST['GroupMember9'];
	$GroupMember10 = $_POST['GroupMember10'];

	//Zusatz Datein laden

	require_once("connection.php");
	require_once("ZeitErkennung.php");
	require_once("Control_Cookie.php");

	//Ueberpruefen ob die Felder Mitglieder 1 bis 3 ausgefuellt sind und ob es einen Gruppennamen gibt

	if($GroupMember1 == "" or $GroupMember2 == "" or $GroupMember3 == "" or $Groupname == ""){

		//Automatische Rueckleitung zunm Formular

		header("refresh:5;url=NewGroupChat.php?User=$User");
		echo "Sie haben leider was vergessen einzutragen versuchen Sie es erneut. Sie werden automatisch zur&uuml;ckgeleitet!";
		exit();

	}else{

			//Ueberpruefen ob der User mit dem eingetragenen User uebereinstimmt

			if($User == $GroupMember1){

				//Key erstellen

				require_once("key_erstellen.php");

				//Group Chat ID erstellen

				$Zahl1 = rand(1000, 9999);

				$Zahl2 = rand(10000000,99999999);

				$Random_Zahl = $Zahl2 . $Zahl1;

				//Datenbank

				$Datenbank = "k72459_Projekt360";

				//Gruppen Chat Tabelle erstellen

				$Group_Chat_Tabelle_erstellen = mysqli_query($verbindung, "CREATE TABLE `$Datenbank`.`$Random_Zahl` ( `ID` INT NOT NULL AUTO_INCREMENT ,  `Nachricht` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,  `Sender` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `DatumUhrzeit` DATETIME NOT NULL ,  PRIMARY KEY  (`ID`)) ENGINE = InnoDB");

				$Insert_into_GroupChatConnection = mysqli_query($verbindung, "INSERT INTO GroupChatConnection(GroupChatID, GroupName, Description, VSK, GroupMember1, GroupMember2, GroupMember3, GroupMember4, GroupMember5, GroupMember6, GroupMember7, GroupMember8, GroupMember9, GroupMember10) VALUES ('$Random_Zahl','$Groupname', '$Groupdescription', '$key', '$GroupMember1', '$GroupMember2', '$GroupMember3', '$GroupMember4', '$GroupMember5', '$GroupMember6', '$GroupMember7', '$GroupMember8', '$GroupMember9', '$GroupMember10')");

				//ueberpruefen ob die Gruppe erstellt wurde

				$Control_NewGroupChat = 0;
				$Load_GroupChatConnection = mysqli_query($verbindung, "SELECT GroupChatID, GroupMember1 FROM GroupChatConnection WHERE GroupChatID = '$Random_Zahl' AND GroupMember1 = '$User'");
				while($row_Load_GroupChatConnection = mysqli_fetch_object($Load_GroupChatConnection)){
					$Control_NewGroupChat++;
				}

				//Ergebnis der Ueberpreufung verarbeiten

				if($Control_NewGroupChat != 0){

					header("refresh:5;url=close.html");
					echo "Die Gruppe wurde erfolgreich erstellt!";

				}
				else{

					echo "Ein Fehler ist beim erstellen der Gruppe aufgetretten!<br />Bitte versuchen Sie es erneut, falls es wieder zu einem Fehler kommt, er&ouml;ffnen Sie ein Ticket.";

				}
			}else{

				//Falls der User und der eingetragene ersteller nicht uebereinstimmt wird die Funktion sofort beendet und zurueckgeleitet

				header("refresh:10;url=NewGroupChat.php?User=$User");
				echo "Sie haben nicht ihren eigenen Benutzername im Feld Gruppen Mitglied 1 eingetragen. Beim neuladen des Formulars wird ihr Benutzername eingetragen.<br />Sie werden automatisch Zur&uuml;ckgeleitet!";
				exit();

			}       

	}
?>