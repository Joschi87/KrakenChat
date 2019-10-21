<?php

	//Verbind ung zur Datenbank

	require_once("connection.php");

	//Username aus dem Header laden

	$Search_Profil = $_GET["User"];

	//Vorname aus der Datenbank lesen
			
	$sql_Vorname = "SELECT Vorname FROM Profil WHERE benutzername = '$Search_Profil'";
    $db_erg_Vorname = mysqli_query($verbindung, $sql_Vorname );
    if ( ! $db_erg_Vorname )
        {
            die('Ungültige Abfrage: ' . mysqli_error());
		}
    while ($zeile_Vorname = mysqli_fetch_array( $db_erg_Vorname, MYSQLI_ASSOC)){

    	$GLOBALS['Vorname_DB'] = $zeile_Vorname["Vorname"];

       }

	//Nachname aus der Datenbank lesen

	$sql_Nachname = "SELECT Nachname FROM Profil WHERE benutzername = '$Search_Profil'";
	$db_erg_Nachname = mysqli_query($verbindung, $sql_Nachname);
	if (!$db_erg_Nachname){
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	while ($zeile_Nachname = mysqli_fetch_array($db_erg_Nachname, MYSQLI_ASSOC)){

		$GLOBALS['Nachname_DB'] = $zeile_Nachname["Nachname"];

		}

	//Benutzername aus der Datenbank lesen
	
	$sql_Benutzername = "SELECT benutzername FROM Profil WHERE benutzername = '$Search_Profil'";
	$db_erg_Benutzername = mysqli_query($verbindung, $sql_Benutzername);
	if( !$db_erg_Benutzername){
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	while ($zeile_Benutzername = mysqli_fetch_array($db_erg_Benutzername, MYSQLI_ASSOC)){

		$GLOBALS['Benutzername_DB'] = $zeile_Benutzername["benutzername"];

	}

	//Geburtstag des Nutzers auslesen

	/*$sql_Geburtstag = "SELECT Geburtstag FROM Profil WHERE benutzername = '$Search_Profil'";
	$db_erg_Geburtstag = mysqli_query($verbindung, $sql_Geburtstag);
	if (!$db_erg_Geburtstag){
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	while ($zeile_Geburtstag = mysqli_fetch_array($db_erg_Geburtstag, MYSQLI_ASSOC)){

		$GLOBALS['Geburtstag_DB'] = $zeile_Geburtstag["Geburtstag"];

	}

	//Telefonnummer Geschaeftlich des Nutzers auslesen

	$sql_Telefonnummer_Beruflich = "SELECT Telefonnummer_Beruflich FROM Profil WHERE benutzername = '$Search_Profil'";
	$db_erg_Telefonnummer_Beruflich = mysqli_query($verbindung, $sql_Telefonnummer_Beruflich);
	if (!$db_erg_Telefonnummer_Beruflich){
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	while ($zeile_Telefonnummer_Beruflich = mysqli_fetch_array($db_erg_Telefonnummer_Beruflich, MYSQLI_ASSOC)){

		$GLOBALS['Telefonnummer_Beruflich_DB'] = $zeile_Telefonnummer_Beruflich["Telefonnummer_Beruflich"];

	}

	//Telefonnummer Mobil des Nutzers auslesen

	$sql_Telefonnummer_Mobil = "SELECT Telefonnummer_Mobil FROM Profil WHERE benutzername = '$Search_Profil'";
	$db_erg_Telefonnummer_Mobil = mysqli_query($verbindung, $sql_Telefonnummer_Mobil);
	if (!$db_erg_Telefonnummer_Mobil){
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	while ($zeile_Telefonnummer_Mobil = mysqli_fetch_array($db_erg_Telefonnummer_Mobil, MYSQLI_ASSOC)){

		$GLOBALS['Telefonnummer_Mobil_DB'] = $zeile_Telefonnummer_Mobil["Telefonnummer_Mobil"];

	}

	//Abteilung des Nutzers auslesen

	$sql_Abteilung = "SELECT Abteilung FROM Profil WHERE benutzername = '$Search_Profil'";
	$db_erg_Abteilung = mysqli_query($verbindung, $sql_Abteilung);
	if (!$db_erg_Abteilung){
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	while ($zeile_Abteilung = mysqli_fetch_array($db_erg_Abteilung, MYSQLI_ASSOC)){

		$GLOBALS['Abteilung_DB'] = $zeile_Abteilung["Abteilung"];

	}

	//Standort des Nutzers auslesen

	$sql_Standort = "SELECT Standort FROM Profil WHERE benutzername = '$Search_Profil'";
	$db_erg_Standort = mysqli_query($verbindung, $sql_Standort);
	if (!$db_erg_Standort){
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	while ($zeile_Standort = mysqli_fetch_array($db_erg_Standort, MYSQLI_ASSOC)){

		$GLOBALS['Standort_DB'] = $zeile_Standort["Standort"];

	}*/

	//Profilbild des Nutzer auslesen

	$sql_Profilbild = "SELECT Profilbild FROM Profil WHERE benutzername = '$Search_Profil'";
    $db_erg_Profilbild = mysqli_query($verbindung, $sql_Profilbild );
    if ( ! $db_erg_Profilbild ){
        die('Ungültige Abfrage: ' . mysqli_error());
    }
    while ($zeile_Profilbild = mysqli_fetch_array( $db_erg_Profilbild, MYSQLI_ASSOC)){

		$GLOBALS['Profilbild_DB'] = $zeile_Profilbild["Profilbild"];

    }
            
?>