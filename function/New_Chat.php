<?php

	$User = $_GET["User"];
	$Chat_Partner = $_GET["New_Chat_Partner"];

	require_once("connection.php");
	
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

    //Neuer Chat Funktion

	if($Chat_Partner == ""){
		print "<script text='text/javascript'>alert('Sie haben keinen Chat Partner eingetragen!<br />Dieses Fenster schließt sich in 10 Sekunden!')</script>";
		header("refresh:0.1;url=close.html");
	}else{

		//Ueberprueft ob der Benutzername im System existiert.

		$Control_Benutzername = 0;
		$Ergebnis_Control_Benutzername = mysqli_query($verbindung, "SELECT benutzername FROM Profil WHERE benutzername = '$Chat_Partner'");
		while ($row_Chat_Partner = mysqli_fetch_object($Ergebnis_Control_Benutzername)) {
				$Control_Benutzername++;
			}

		if ($Control_Benutzername != 0){

				$Control_Chat_Connection_Sender_Empfaenger = 0;
				$Ergebnis_Control_Chat_Connection_Sender_Empfaenger = mysqli_query($verbindung, "SELECT Ersteller, Empfaenger FROM ChatConnection WHERE Ersteller = '$User' AND Empfaenger = '$Chat_Partner'");
				while ($row_Chat_Connection_Sender_Empfaenger = mysqli_fetch_object($Ergebnis_Control_Chat_Connection_Sender_Empfaenger)) {
					$Control_Chat_Connection_Sender_Empfaenger++;
				}

				$Control_Chat_Connection_Empfaenger_Sender = 0;
				$Ergebnis_Control_Chat_Connection_Empfaenger_Sender = mysqli_query($verbindung, "SELECT Ersteller, Empfaenger FROM ChatConnection WHERE Ersteller = '$Chat_Partner' AND Empfaenger = '$User'");
				while ($row_Chat_Connection_Empfaenger_Sender = mysqli_fetch_object($Ergebnis_Control_Chat_Connection_Empfaenger_Sender)) {
					$Control_Chat_Connection_Empfaenger_Sender++;
				}

				if($Control_Chat_Connection_Sender_Empfaenger != 0 or $Control_Chat_Connection_Empfaenger_Sender != 0)
					{
						header("refresh:10;url=close.html");
						echo "Sie haben schon ein Chat mit der Person $Chat_Partner.<br />Die Seite schließt sich in 10 Sekunden!";

					}else{

							require_once("load_User_ID.php");
							require_once("load_Chat_Partner_ID.php");
							require_once("key_erstellen.php");

							$Random_Zahl = rand(10000000,99999999);

							$Chat_ID_Nummer = $Random_Zahl;

							$Datenbank = "KrakenChat";

							//Die Datenbank-Tabelle für den Chat wird mit der Chat ID erstellt

							$Chat_Erstellen = mysqli_query($verbindung, "CREATE TABLE `$Datenbank`.`$Chat_ID_Nummer` ( `ID` INT NOT NULL AUTO_INCREMENT ,  `Nachricht` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,  `Sender` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `DatumUhrzeit` DATETIME NOT NULL ,  PRIMARY KEY  (`ID`)) ENGINE = InnoDB");

							$Chat_Connection_Save = mysqli_query($verbindung, "INSERT INTO ChatConnection(ChatID, Ersteller, Empfaenger, VSK) VALUES ('$Chat_ID_Nummer', '$User', '$Chat_Partner', '$key')");

							$Control_Datenbank_Table = 0;
							$Ueberpruefung_Datenbank_Table = mysqli_query($verbindung, "SELECT * FROM ChatConnection WHERE Ersteller = '$User' AND Empfaenger = '$Chat_Partner'");
							while ($row_Ueberpruefung_Datenbank_Table = mysqli_fetch_object($Ueberpruefung_Datenbank_Table)){$Control_Datenbank_Table++;}

							if($Control_Datenbank_Table != 0){

								print "<script text='text/javascript'>alert('Der Chat mit $Chat_Partner wurde erfolgreich erstellt!<br />Die Seite schließt sich in 10 Sekunden!')</script>";
								header("refresh:0.1;url=close.html");

							}else{
								print "<script text='text/javascript'>alert('Ein Fehler ist beim einrichten des Chat aufgetretten!')</script>";
								header("refresh:0.1;url=close.html");
							}
						}

		}else{
			print "<script text='text/javascript'>alert('Der Benutzername existiert nicht im System. Bitte Kontrollieren Sie den Benutzernamen($Chat_Partner). Diese Seite schließt sich in 10 Sekunden!')</script>";
			header("refresh:0.1;url=close.html");
		}

	}

?>