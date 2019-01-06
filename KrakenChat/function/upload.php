<?php

$user = $_COOKIE["Nutzer"];
$Ort = "Profilbilder";
$zusatz = "/";
$Ordnerstrucktur = "User_Daten";
$erkennung_for_Direction = $Ordnerstrucktur . $zusatz . $user . $zusatz .$Ort .$zusatz;

//Speicherort in Datenbank eintragen
//Verbindung zur Datenbank
require_once("connection.php");

if($user == ""){
    
    echo "Fehlermeldung!";
    
}else{

	//Altes Profilbild laden
	$sql_Profilbild_upload = "SELECT Profilbild FROM Profil WHERE benutzername = '$user'";
    $db_erg_Profilbild_upload = mysqli_query($verbindung, $sql_Profilbild_upload);
    if ( ! $db_erg_Profilbild_upload )
    {
        die('Ungültige Abfrage: ' . mysqli_error());
    }
    while ($zeile_Profilbild_upload = mysqli_fetch_array( $db_erg_Profilbild_upload, MYSQLI_ASSOC)){

    $Profilbild_DB_upload = $zeile_Profilbild_upload["Profilbild"]; 
    }

    if ($Profilbild_DB_upload != "") {
    	unlink($Profilbild_DB_upload);
    }else{
    	echo "Ein Fehler ist beim Aktuallisieren des Profilbilds aufgetretten.";
    	exit();
    }

    $uploadDirection = "../$erkennung_for_Direction";
    $fileDirection = $uploadDirection . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $fileDirection)){

        $Upadte_Profilbild_Pfad = mysqli_query($verbindung, "UPDATE Profil SET Profilbild = '$fileDirection' WHERE benutzername = '$user'");

        //Ueberpruefen ob der upload erfolgreich war
        if($Upadte_Profilbild_Pfad === TRUE){

        	//Wenn der Upload erfolgreich war wird diese Nachricht angezeigt
        	echo("Profilbild wurde hochgeladen: <a href='" . $fileDirection . "'>File</a> <a href='" . $fileDirection . "' download='" . $fileDirection . "'>download</a>");

        }else{
        	echo("Es ist ein Fehler aufgetreten beim Upload auf dem Server.");
        }

    }
    else {
        echo("Es ist ein Fehler aufgetreten im uploaden auf dem Server.");
    }
}
?>