<?php

    $User = $_GET["User"];
    
    $sql2 = "SELECT zeit FROM login WHERE benutzername = '$User'";
    $db_erg2 = mysqli_query( $verbindung, $sql2 );
    if ( ! $db_erg2 ){
        
        die('Ungültige Abfrage: ' . mysqli_error());
        
        }
        while ($zeile2 = mysqli_fetch_array( $db_erg2, MYSQLI_ASSOC)){

        $LoginZeit = $zeile2["zeit"]; 
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
        echo "Sie wurden automatisch aus dem System ausgelogt, da Sie sich nicht Ordnungsgemäß ausgeloggt hatten. <a href='../index.php'>Hier klicken um sich erneut anzumelden</a>";
        echo "</center>";
        echo "</html>";
        exit();
    }
?>