<?php

    require_once("connection.php");

    $Admin = $_GET["Admin"];

    $sqlStatus = "SELECT Status FROM login WHERE benutzer = '$Admin'";
                $db_ergStatus = mysqli_query( $verbindung, $sqlStatus );
                if ( ! $db_ergStatus )
                {
                    die('Ungültige Abfrage: ' . mysqli_error());
                }
                while ($zeileStatus = mysqli_fetch_array( $db_ergStatus, MYSQLI_ASSOC)){

                $Status = $zeileStatus["Status"]; 
                }
?>