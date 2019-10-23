<?php

    /* Variable die aus dem Formular geladen werden */

    $Vorname = ($_POST["Vorname"]);
    $Nachname = ($_POST["Nachname"]);
    $Benutzername = ($_POST["Benutzername"]);
    $Mail = ($_POST["Mail"]);
    $Geburtstag = ($_POST["Geburtstag"]);
    $Telefonnummer_Beruflich = ($_POST["Telefonnummer_Beruflich"]);
    $Telefonnummer_Mobil = ($_POST["Telefonnummer_Mobil"]);
    $Standort = ($_POST["Standort"]);
    $Abteilung = ($_POST["Abteilung"]);
	$Profilbild = "Leer";
    
    $aktuelle_zeit = date("Y.m.d H:i:s");

    require_once("connection.php");
    require_once("password_genartor.php");
    
    if($Vorname == "" or $Nachname == "" or $Benutzername == "" or $Mail == ""){
        
        header("refresh:5;url=close.html");
        echo "Sie haben das Formular nicht vollst&auml;ndig ausgef&uuml;llt. Diese Meldung schließt sich in 5 Sekunden.";
        exit();
        
    }else{
            
            //Die Funktion überprüft die Datenbanken Login und Profil nach den zu registierenden Benutzername
            
            $control_login_DB = 0;
            $abfrage_login_DB = "SELECT benutzername FROM login WHERE benutzername = '$Benutzername'";
            $ergebnis_login_DB = mysqli_query($verbindung, $abfrage_login_DB);
            while ($row_login_DB = mysqli_fetch_object($ergebnis_login_DB)){$control_login_DB++;}
            
            $control_Profil_DB = 0;
            $abfrage_Profil_DB = "SELECT benutzername FROM Profil WHERE benutzername = '$Benutzername'";
            $ergebnis_Profil_DB = mysqli_query($verbindung, $abfrage_Profil_DB);
            while ($row_Profil_DB = mysqli_fetch_object($ergebnis_Profil_DB)){$control_Profil_DB++;}
            
            if($control_login_DB != 0 or $control_Profil_DB != 0){
                
                header("refresh:5;url=close.html");
                echo "Der von Ihnen ausgew&auml;hlten Benutzername wird leider schon von einer anderen Person genutzt. Diese Meldung schließt sich in 5 Sekunden.";
                exit();
                
            }else{

                //Passwort für den neuen Nutzer generieren

                $passwort = generatePassword ( 10, 2, 2, true);
                
                //Speichert den Benutzernamen, Passwort und die Firma in die Login Datenbank.
                
                $Neuer_Benutzer = mysqli_query($verbindung, "INSERT INTO login(Vorname, Nachname, benutzername, passwort, Mail) VALUES ('$Vorname','$Nachname','$Benutzername', '$passwort', '$Mail')");
                
                if($Neuer_Benutzer == TRUE){
                    
                    //Setzt die Globale Variable bestaetigung_login auf eins um später die vollständige überprüfung durch zuführen.
                    
                    $GLOBALS['bestaetigung_login'] = 1;
                    
                }else{
                    
                    //Text wird angezeigt wenn das Speichern des neuen Benutzers nicht funktioniert.
                    
                    header("refresh:5;url=close.html");
                    echo "Fehler beim Speichern des neuen Profils. Diese Meldung schließt sich in 5 Sekunden.";
                    exit();
                    
                }
                
                //Speichert das Profil des neuen Benutzers in der Datenbank Profil.
                
                $Neues_Profil = mysqli_query($verbindung, "INSERT INTO Profil(Vorname, Nachname, benutzername, Mail, Geburtstag,Telefonnummer_Beruflich, Telefonnummer_Mobil, Standort, Abteilung, Profilbild) VALUES ('$Vorname', '$Nachname', '$Benutzername', '$Mail', '$Geburtstag', '$Telefonnummer_Beruflich', '$Telefonnummer_Mobil', '$Standort', '$Abteilung', '$Profilbild')");
                
                if($Neues_Profil == TRUE){
                    
                    //Setzt die Globale Variable bestaetigung_profil auf eins um später die vollständige überprüfung durch zuführen.
                    
                    $GLOBALS['bestaetigung_profil'] = 1;
                    
                }else{
                    
                    //Text wird angezeigt wenn das Speichern des neuen Benutzers nicht funktioniert.
                    
                    header("refresh:5;url=close.html");
                    echo "1. Fehler beim Speichern des neuen Profils. Diese Meldung schließt sich in 5 Sekunden.";
                    exit();
                    
                }
                
                $Profil_gespeichert = $bestaetigung_login + $bestaetigung_profil ;
                
                if($Profil_gespeichert != 2){
                    
                    //Wenn das Ergebnis nicht zwei ergibt wird eine Fehlermeldung rausgegeben.
                    
                    header("refresh:5;url=close.html");
                    echo"2. Fehler beim Speichern des neuen Profils. Diese Meldung schließt sich in 5 Sekunden.";
                    exit();
                    
                }else{
                    
                    //Schließte die Regiestrierungsfunktion
                    
                    header("refresh:5;url=close.html");
                    
                    //Diese Meldung wird rausgegeben wenn das speichern des Profils erfolgreich war.
                    
                    echo "Speichern des neuen Profils war erfolgreich. Diese Meldung schließt sich in 5 Sekunden.";
                    exit();
                    
                }
                
            }
            
        }
?>