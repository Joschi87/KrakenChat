<?php

	//Verbindung zur Datenbank

	require_once("connection.php");

	//Chat ID runterladen aus dem Header

	$Chat_ID = $_GET["ChatID"];

	//Key aus der ChatConnection runterladen

	$download_key = mysqli_query($verbindung, "SELECT VSK FROM ChatConnection WHERE ChatID = '$Chat_ID'");

	while($row = mysqli_fetch_assoc($download_key)){

		$key = $row['VSK'];

	}

	//Blowfish Class runterladen

	include("blowfish.class.php");

	//Nachricht wird verschluesselt

	$blowfish = new Blowfish($key);
    $ausgabe_2 = $blowfish->Encrypt($text);

    $GLOBALS['ausgabe'] = $ausgabe_2;

?>