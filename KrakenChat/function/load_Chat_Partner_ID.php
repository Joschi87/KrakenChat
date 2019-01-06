<?php

	$sql_Chat_Partner_ID = mysqli_query($verbindung, "SELECT ID FROM Profil WHERE benutzername = '$Chat_Partner'");

	if( ! $sql_Chat_Partner_ID){die('Ungültige Abfrage: ' . mysqli_error());}

	while ($Zeile_Chat_Partner_ID = mysqli_fetch_array($sql_Chat_Partner_ID, MYSQLI_ASSOC)) {
		$Chat_Partner_ID_DB = $Zeile_Chat_Partner_ID["ID"];
	}
	
?>