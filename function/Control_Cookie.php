<?php

	//Verbindung zur Datenbank

	require_once("connection.php");

	$User = $_GET["User"];

	$db_erg1 = mysqli_query($verbindung, "SELECT sessionnummer FROM login WHERE benutzername = '$User'");
        if ( ! $db_erg1 ){

            die('Ungültige Abfrage: ' . mysqli_error());

            }
            while ($zeile1 = mysqli_fetch_array( $db_erg1, MYSQLI_ASSOC)){

            $Sessionnummer_DB = $zeile1["sessionnummer"]; 
            }

    $Sessionnummer_Cookie = $_COOKIE["Sessionnummer"];

    if($Sessionnummer_DB != $Sessionnummer_Cookie){

    	echo "Sie sind nicht angemeldet. Bitte melden Sie sich an. <a href='../index.php'>Hier klicken</a>";
    	exit();

    }else{}

?>