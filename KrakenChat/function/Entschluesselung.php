<?php

	//Verbindung zur Datenbank

	require_once("connection.php");

	//Download von Blowfish Class

	include("blowfish.class.php");

	//Chat ID runterladen aus dem Header

	$Chat_ID = $_GET["ChatID"];

	//Key aus der ChatConnection runterladen

	$download_key = mysqli_query($verbindung, "SELECT VSK FROM ChatConnection WHERE ChatID = '$Chat_ID'");

	while($row = mysqli_fetch_assoc($download_key)){

		$key = $row['VSK'];

	}

	$download_text = mysqli_query($verbindung, "SELECT Nachricht FROM `$Chat_ID`")

	$blowfish = new Blowfish($key);
    $ausgabe_3 =$blowfish->Decrypt($text);

    $GLOBALS['ausgabe'] = $ausgabe_3;

?>