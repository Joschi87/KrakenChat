<?php

	//Verbindung zur Datenbank

	require_once("connection.php");

	//Sicherheitsprogramme laden

	require_once("connection.php");
    require_once("ZeitErkennung.php");
    require_once("Control_Cookie.php");

	//User aus dem Header auslesen

	$User = $_GET["User"];

	//Daten fuer die loesch-funktion laden

	$Chat_ID = $_GET["Delete_Chat_ID_Nummer"];
	$GroupChat_ID = $_GET["Delete_GroupChat_ID_Nummer"];
	$KindofDelete = $_GET["Kind"];

	if($KindofDelete != "Group"){

		//Wenn ein Chat geloescht werden soll der ein Person to Person Chat ist

		if($Chat_ID == ""){
		header("refresh:5;url=close.html");
		echo "Sie haben keine Chat ID Nummer eingegeben. Diese Mitteilung schließt sich in 5 Sekunden!";
		}else{

		//ChatConnection Tabelle controllieren ob der User dort eingetragen ist fuer den zuloeschenden Chat

		$Control_ChatConnection = mysqli_query($verbindung, "SELECT ID, Ersteller, Empfaenger FROM ChatConnection WHERE ChatID = '$Chat_ID'");

		while($row_Control_ChatConnection = mysqli_fetch_array($Control_ChatConnection)){

			$GLOBALS['Ersteller'] = $row_Control_ChatConnection['Ersteller'];
			$GLOBALS['Empfaenger'] = $row_Control_ChatConnection['Empfaenger'];
		}

		$Control_Delete_Function = 0;

		if($Ersteller == $User or $Empfaenger == $User){

			$Loeschen_Chat_ChatConnection = mysqli_query($verbindung, "DELETE FROM ChatConnection WHERE ChatID = '$Chat_ID'");
			//$Loeschen_Chat_Tabelle = mysqli_query($verbindung, "DROP TABLE '$Chat_ID'");

			$Control_Delete_Function++;

			if($Control_Delete_Function != 0){

				header("refresh:10;url=close.html");
				echo "Chat wurder erfolgreich gel&ouml;scht. Diese Mitteilung schließt sich in 10 Sekunden!";

			}else{

				header("refresh:10;url=close.html");
				echo "Es ist beim L&ouml;schen ein Fehler aufgetretten. Diese Mitteilung schließt sich in 10 Sekunden!";

			}

		}else{
			header("refresh:10;url=close.html");
			echo "Sie sind nicht berechtigt diesen Chat($Chat_ID) zu l&ouml;schen! Diese Mitteilung schließt sich in 10 Sekunden!";
		}

		}

	}else{

		//Wenn ein GroupChat gerloescht werden soll wird dieser pfad ausgeführt

		//ChatConnection Tabelle kontrollieren ob der User dort eingetragen ist fuer den zuloeschenden Chat

		$Control_GroupChatConnection = mysqli_query($verbindung, "SELECT ID, GroupMember1 FROM GroupChatConnection WHERE GroupChatID = '$GroupChat_ID'");

		while($row_Control_GroupChatConnection = mysqli_fetch_array($Control_GroupChatConnection)){

			$GLOBALS['GroupMember1'] = $row_Control_GroupChatConnection['GroupMember1'];
		
		}

		$Control_DeleteGroup_Function = 0;

		if($GroupMember1 == $User){

			$Loeschen_GroupChatConnection = mysqli_query($verbindung, "DELETE FROM GroupChatConnection WHERE GroupChatID = '$GroupChat_ID'");
			//$Loeschen_Chat_Tabelle = mysqli_query($verbindung, "DROP TABLE '$Chat_ID'");

			$Control_DeleteGroup_Function++;

			if($Control_DeleteGroup_Function != 0){

				header("refresh:10;url=close.html");
				echo "Chat wurder erfolgreich gel&ouml;scht. Diese Mitteilung schließt sich in 10 Sekunden!";

			}else{

				header("refresh:10;url=close.html");
				echo "Es ist beim L&ouml;schen ein Fehler aufgetretten. Diese Mitteilung schließt sich in 10 Sekunden!";

			}

		}else{
			header("refresh:10;url=close.html");
			echo "Sie sind nicht berechtigt diesen Chat($GroupChat_ID) zu l&ouml;schen! Nur der Admin der Gruppe kann diese Gruppe l&ouml;schen! Diese Mitteilung schließt sich in 10 Sekunden!";
		}

	}

	
?>