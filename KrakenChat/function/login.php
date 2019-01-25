<?php
    
    $loginTime = date("Y.m.d H:i:s");
    $Time = date("H:i:s");
    $datum = date("Y.m.d");
    $user = ($_POST["user"]);
    $passwort = ($_POST["password"]);

    //IP-Adresse wird ermittelt vom Client der sich grade am anmelden ist

    if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $client_ip = $_SERVER['REMOTE_ADDR'];}

    else {$client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];}

    require_once("connection.php");

        if($user == "" or $passwort == ""){
            
            echo "Sie haben vergessen Ihre Logindaten einzugeben.";
            exit();
            
        }else{

            if (!preg_match("#^[a-zA-Z0-9]$#", $user) or (!preg_match("#^[a-zA-Z0-9]$#", $passwort))) {
                print("Sie haben nicht erlaubte Zeichen genutzt");
                exit();
            }else{
            
            //Anmeldeinformationen werden in der Login Datenbank gesucht
            
            $control_Benutzername = 0;
            $abfrage_Benutzername = "SELECT benutzername, passwort FROM login WHERE benutzername = '$user' AND passwort = '$passwort'";
            $ergebnis_Benutzername = mysqli_query($verbindung, $abfrage_Benutzername);
            while ($row_Benutzername = mysqli_fetch_object($ergebnis_Benutzername)){$control_Benutzername++;}
            
            $control_Mail = 0;
            $abfrage_Mail = "SELECT Mail, passwort FROM login WHERE Mail = '$user' AND passwort = '$passwort'";
            $ergebnis_Mail = mysqli_query($verbindung, $abfrage_Mail);
            while ($row_Mail = mysqli_fetch_object($ergebnis_Mail)){$control_Mail++;}
        
            $sql = "SELECT ID FROM login WHERE benutzername = '$user'";
            $db_erg = mysqli_query( $verbindung, $sql );
            if ( ! $db_erg )
            {
                die('Ungültige Abfrage: ' . mysqli_error());
            }
            while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC)){

            $ID = $zeile["ID"]; 
            }
            
            if($control_Benutzername != 0 or $control_Mail != 0){
                
                    $sql_Aktiv = "SELECT Aktiv FROM login WHERE benutzername = '$user'";
                    $db_erg_Aktiv = mysqli_query( $verbindung, $sql_Aktiv );
                    if ( ! $db_erg_Aktiv )
                    {
                        die('Ungültige Abfrage: ' . mysqli_error());
                    }
                    while ($zeile_Aktiv = mysqli_fetch_array( $db_erg_Aktiv, MYSQLI_ASSOC)){

                    $Aktiv = $zeile_Aktiv["Aktiv"]; 
                    }
            
                    if($Aktiv == "online"){

                        //Wird Aktiv bei neuer Anmeldung während aktiver Sitzung. Sendet der hinterlegten Mail-Adresse eine Sicherheitshinweis.

                        $sql_Mail = "SELECT Mail FROM login WHERE benutzername = '$user'";
                        $db_erg_Mail = mysqli_query( $verbindung, $sql_Mail );
                        if ( ! $db_erg_Mail )
                        {
                            die('Ungültige Abfrage: ' . mysqli_error());
                        }
                        while ($zeile_Mail = mysqli_fetch_array( $db_erg_Mail, MYSQLI_ASSOC)){

                        $Mail = $zeile_Mail["Mail"]; 
                        }

                        require_once("../Inhalt_mail.php");
                        

                        //mail($Mail, $Betreff, $Nachricht, $from);
                        
                        //Speichert die IP-Adresse, wenn die Mail gesendet
                        
                        if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                            $client_ip = $_SERVER['REMOTE_ADDR'];}

                        else {$client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];}
                        
                        $IP_Adresse = mysqli_query($verbindung, "INSERT INTO Log(IP, Aktion, Zeit) VALUES ('$client_ip', 'Anmeldung waehrend aktiver Sitzung bei $user', '$loginTime')");
                        
                    }
                
                    //Sessionnummer wird aus der Datenbank an Hand des Benutzernames gesucht. Um bestehende Sitzungen weiterzuführen.
                
                    $sql_Sessionnummer = "SELECT sessionnummer FROM login WHERE benutzername = '$user'";
                    $db_erg_Sessionnummer = mysqli_query( $verbindung, $sql_Sessionnummer );
                    if ( ! $db_erg_Sessionnummer )
                    {
                        die('Ungültige Abfrage: ' . mysqli_error());
                    }
                    while ($zeile_Sessionnummer = mysqli_fetch_array( $db_erg_Sessionnummer, MYSQLI_ASSOC)){

                    $Sessionnummer_Datenbank = $zeile_Sessionnummer["sessionnummer"]; 
                    }
                
                    $Session_Cookie = $_COOKIE["Sessionnummer"];
                
                        if($Sessionnummer_Datenbank == $Session_Cookie){
                        
                            //Kennung, Login Zeit, 
                        
                            $update_Sessionnummer_u24std = mysqli_query($verbindung, "UPDATE login SET kennung = '1' WHERE benutzername = '$user'");
                            $update2_Sessionnummer_u24std = mysqli_query($verbindung, "UPDATE login SET zeit = '$loginTime' WHERE benutzername = '$user'");
                            $update3_Sessionnummer_u24std = mysqli_query($verbindung, "UPDATE login SET Aktiv = 'online' WHERE benutzername = '$user'");
                            
                            header("refresh:0.1;url=../profile/index.php?User=$user");
                            
                            //Setzt ein Cookie mit dem Benutzernamen als Inhalt
                            
                            setcookie("Nutzer", $user, 0, "/");
                        
                        }else{
                            
                            //Setzt den Cookie mit der Seesionnummer der aktuellen Sitzung
                        
                            $Sessionnummer_for_Cookie = rand(10000000,99999999);
                        
                            setcookie("Sessionnummer", $Sessionnummer_for_Cookie, 0, '/');
                        
                            $update_Sessionnummer_Neu = mysqli_query($verbindung, "UPDATE login SET kennung = '1' WHERE benutzername = '$user'");
                            $update2_Sessionnummer_Neu = mysqli_query($verbindung, "UPDATE login SET zeit = '$loginTime' WHERE benutzername = '$user'");
                            $update3_Sessionnummer_Neu = mysqli_query($verbindung, "UPDATE login SET sessionnummer = '$Sessionnummer_for_Cookie' WHERE benutzername = '$user'");
                            $update4_Sessionnummer_Neu = mysqli_query($verbindung, "UPDATE login SET Aktiv = 'online' WHERE benutzername = '$user'");
                            
                            header("refresh:0.1;url=../profile/index.php?User=$user");
                            
                            //Kontrolliert ob der Cookie Nutzer der Zeit aktiv ist und löscht diesen, um diesen neuen zu installieren mit dem neuen Nutzernamen
                            
                            $Cookie_Check = $_COOKIE["Nutzer"];
                            
                            if($Cookie_Check == TRUE){
                                
                                //Löschen des Cookies Nutzer
                                
                                setcookie("Nutzer","",time() - 3600);
                                
                            }else{
                            
                                //Cookie Nutzer mit neuen Inhalt installieren
                                
                                setcookie("Nutzer", $user, 0, "/");
                                
                            }
                        }
                            
                    
                    
            }else{
                    echo "<!DOCTYPE html>";
                    echo "<center>";
                    echo "Dieser Administrator '<b>$user</b>' exestiert bei uns im System nicht. Oder Sie haben das Falsche Passwort eingeben. <a href='../index.php'>Versuchen Sie es erneut</a>";
                    echo "Falls Sie sich noch nicht bei uns registriert haben können Sie <a href='../register/index.php'>hier klicken</a> um sich zu registrieren.";
                    echo "</center>";
                    echo "</html>";
                }
            }
        }
            
              
        
    mysqli_close($verbindung);
?>