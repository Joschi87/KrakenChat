<?php

	//Verbindung zur Datenbank
	require_once("connection.php");

	//Download der Informationen des Headers
	$User = $_GET["User"];

	//Download der Informationen des Formulars
	$New_Vorname = ($_POST["profil_work_Vorname"]);
	$New_Nachname = ($_POST["profil_work_Nachname"]);
	$New_Geburtstag = ($_POST["profil_work_Geburtstag"]);
	$New_Telefonnummer_beruflich = ($_POST["profil_work_Telefonnummer_beruflich"]);
	$New_Telefonnummer_mobil = ($_POST["profil_work_Telefonnummer_mobil"]);

	//Einbindung der Sicherheitstools
	require_once("ZeitErkennung.php");
    require_once("Control_Cookie.php");

    if($New_Vorname == "" or $New_Nachname == "" or $New_Geburtstag == "" or $New_Telefonnummer_beruflich == "" or $New_Telefonnummer_mobil == ""){

    	//Rueckmeldung wenn eins der Felder leer ist, da dann das updaten der Informationen fehlschlagen soll
    	header("refresh:10;url=close.html");
    	echo "Das Formular wurde nicht vollst&auml;ndig ausgef&uuml;llt. Dadurch kann keine Aktuallisierung des Profil ausge&uuml;hrt werden!<br />Die Seite schließt sich in 10 Sekunden";

    }else{

    	$Contol_User = 0;
    	$Abfrage_User = mysqli_query($verbindung, "SELECT benutzername FROM Profil WHERE benutzername = '$User'");
    	while($row_Abfrage_User = mysqli_fetch_object($Abfrage_User)){$Control_User++;}

    	if ($Control_User == 0) {
    		
    		//Wenn der Benutzername nicht uebereinstimmt wird die Fehlermeldung und die Funktion wird geschlossen
    		header("refresh:10;url=close.html");
    		echo "Es ist ein Fehler beim erkennen des Benutzernamens aufgetretten. Bitte versuchen Sie es erneut.<br />Diese Meldung schließt sich in 10 Sekunden.";
    	}else{

    		$Update_Profil_Vorname = mysqli_query($verbindung, "UPDATE Profil SET Vorname = '$New_Vorname' WHERE benutzername = '$User'");
    		$Update_Profil_Nachname = mysqli_query($verbindung, "UPDATE Profil SET Nachname = '$New_Nachname' WHERE benutzername = '$User'");
    		$Update_Profil_Geburtstag = mysqli_query($verbindung, "UPDATE Profil SET Geburtstag = '$New_Geburtstag' WHERE benutzername = '$User'");
    		$Update_Profil_Telefonnummer_Beruflich = mysqli_query($verbindung, "UPDATE Profil SET Telefonnummer_Beruflich = '$New_Telefonnummer_beruflich' WHERE benutzername = '$User'");
    		$Update_Profil_Telefonnummer_Mobil = mysqli_query($verbindung, "UPDATE Profil SET Telefonnummer_Mobil = '$New_Telefonnummer_mobil' WHERE benutzername = '$User'");

    		if ($Update_Profil_Vorname == TRUE AND $Update_Profil_Nachname == TRUE AND $Update_Profil_Geburtstag == TRUE AND $Update_Profil_Telefonnummer_Beruflich == TRUE AND $Update_Profil_Telefonnummer_Mobil == TRUE) {
    			
    			//Ueberprueft ob die Akutallisierung des Profils erfolgreich war

    			header("refresh:5;url=close.html");
    			echo "Das Profil wurde erfolgreich aktuallisiert. Diese Nachricht schließt sich in 5 Sekunden!";

    		}else{

    			//Diese Meldung wird angezeigt wenn die Aktuallisierung fehlschlug

    			header("refresh:15;url=close.html");
    			echo "Es ist ein Fehler aufgetretten. Bitte versuchen Sie es erneut, oder eröffnen Sie ein Ticket.<br />Diese NAchricht schließt sich in 15 Sekunden!";

    		}

    	}

    }

?>