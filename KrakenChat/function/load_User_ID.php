<?php

	$sql_User_ID = mysqli_query($verbindung, "SELECT ID FROM Profil WHERE benutzername = '$User'");

	if( ! $sql_User_ID){die('Ungültige Abfrage: ' . mysqli_error());}

	while ($Zeile_User_ID = mysqli_fetch_array($sql_User_ID, MYSQLI_ASSOC)) {
		$User_ID_DB = $Zeile_User_ID["ID"];
	}
?>