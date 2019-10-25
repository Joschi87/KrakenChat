<?php

	//Aufbau der Datenbank Verbindung

	require_once("connection.php");
	
	//Download der Informationen aus der Header

	$User = $_GET["User"];
	$Chat_ID = $_GET["ChatID"];
    $KindOfChat = $_GET["KindofChat"];

	//Funktion kennung

    $sql1 = "SELECT kennung FROM login WHERE benutzername = '$User'";
        $db_erg1 = mysqli_query($verbindung, $sql1 );
        if ( ! $db_erg1 ){

            die('Ungültige Abfrage: ' . mysqli_error());

            }
            while ($zeile1 = mysqli_fetch_array( $db_erg1, MYSQLI_ASSOC)){

            $Kennung = $zeile1["kennung"]; 
            }
    if($Kennung != 1){
        echo "<!DOCTYPE html>";
        echo "<center>";
        echo "Sie sind nicht angemeldet! Wollen Sie sich anmelden? <a href='../index.php'>Hier klicken</a>";
        echo "</center>";
        echo "</html>";
        exit();
    }

    //Zeit Erkennungsfunktion

    $sql2 = "SELECT Zeit FROM login WHERE benutzername = '$User'";
    $db_erg2 = mysqli_query( $verbindung, $sql2 );
    if ( ! $db_erg2 ){
        
        die('Ungültige Abfrage: ' . mysqli_error());
        
        }
        while ($zeile2 = mysqli_fetch_array( $db_erg2, MYSQLI_ASSOC)){

        $LoginZeit = $zeile2["Zeit"]; 
        }

    $LocalTime = date("Y-m-d H:i:s");
    $LocalTime2 = strtotime($LocalTime);
    $LoginTime = strtotime($LoginZeit);
    $Test = date ("i:s", $LocalTime2 - $LoginTime);
    $zeit = "5:00";
    
    $LocalTime3 = strtotime($LocalTime);
    $LoginTime2 = strtotime($LoginZeit);
    $test = date ("Y.m.d", $LocalTime3 - $LoginTime2);
    $jahr = "1970.01.01";

    if($Test >= $zeit or $test > $jahr or $test < $jahr){
        echo "<!DOCTYPE html>";
        echo "<center>";
        echo $User;
        echo "<br />";
        echo "Sie wurden automatisch aus dem System ausgelogt, da Sie sich nicht Ordnungsgemäß ausgeloggt hatten. <a href='../index.php'>Hier klicken um sich erneut anzumelden</a>";
        echo "</center>";
        echo "</html>";
        exit();
    }

	//Download der Informationen aus dem Formular

	$text =trim($_POST["NeueNachricht"]);

    //Der Text wird mit dem gespeicherten Schliessel verschluesselt

    require_once("Verschluesselung.php");

	//Bestimmung der Aktuellen Zeit

	$LoaclTime = date("Y.m.d H:i:s");

	//Ueberpruefen ob die Varaible Nachricht ein Wert hat oder ob diese leer ist

	if($text == ""){
		header("refresh:5;url=../Chat/index.php?User=$User&ChatID=$Chat_ID&KindofChat=$KindOfChat");
		echo "<script text='text/javascript'>alert('Sie haben keine Nachricht eingegeben!<br />Diese Meldung schließt sich nach 5 Sekunden!')</script>";
	}else{

		$NewNachricht = mysqli_query($verbindung, "INSERT INTO `$Chat_ID`(Nachricht, Sender, DatumUhrzeit) VALUES ('$ausgabe', '$User', '$LoaclTime')");

		$NewNotification = mysqli_query($verbindung, "UPDATE ChatConnection SET Notification = 'Neue Mitteilung' WHERE ChatID = '$Chat_ID'");

		if($NewNachricht === true AND $NewNotification === true){

			//Weiterleitung zurueck zur Chat Index

			header("refresh:0.1;url=../Chat/index.php?User=$User&ChatID=$Chat_ID&KindofChat=$KindOfChat&Notice=");

		}else{
			header("refresh:5;url=../Chat/index.php?User=$User&ChatID=$Chat_ID&KindofChat=$KindOfChat");
			echo "Ein Fehler ist beim versenden aufgetretten!<br />Diese Meldung schließt sich nach 5 Sekunden!";
		}

	}

?>