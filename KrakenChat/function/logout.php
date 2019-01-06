<?php
    $User = $_GET["User"];

    $logouttime = date("Y.m.d H:i:s");
    $logoutUhrzeit = date("H:i:s");

    require_once("connection.php");

    $sql1 = "SELECT kennung FROM login WHERE benutzername = '$User'";
    $db_erg1 = mysqli_query( $verbindung, $sql1 );
    if ( ! $db_erg1 ){
        
        die('Ungültige Abfrage: ' . mysqli_error());
        
        }
        while ($zeile1 = mysqli_fetch_array( $db_erg1, MYSQLI_ASSOC)){

        $Kennung = $zeile1["kennung"]; 
        }

    if($Kennung == 1){
        header("refresh:0.1;url='../index.php'");
        $update = mysqli_query($verbindung, "UPDATE login SET kennung = '0' WHERE benutzername = '$User'");
        $update2 = mysqli_query($verbindung, "UPDATE login SET Zeit = '0000-00-00 00:00:00' WHERE benutzername = '$User'");
        $Aktiv = mysqli_query($verbindung, "UPDATE login SET Aktiv = 'offline' WHERE benutzername = '$User'");
        $Sessionnummer = mysqli_query($verbindung, "UPDATE login SET sessionnummer = '0' WHERE benutzername = '$User'");
        
        //Eintrag in die Log File Datei
        
        //$LogFIle = mysqli_query($verbindung, "INSERT INTO Logging(Benutzer, Freigabe, Zeit, Uhrzeit, Taetigkeit) VALUES('$Admin', '$Status', '$logouttime', '$logoutUhrzeit', 'Logout')");
        exit();
        
        
    }else{
        echo "<center>";
        echo "Felher beim auslogen!";
        echo "</center>";
        exit();
    }
?>