<?php

	//Verbindung zur Datenbank

	require_once("connection.php");

	//Download der Header Informationen

	$User = $_GET["User"];

	//Download der Datenbank Tabelle des Chates

	$Ergebins_Notice = mysqli_query($verbindung, "SELECT ChatID, Notification FROM ChatConnection WHERE Ersteller = '$User' OR Empfaenger = '$User' ORDER BY Notification DESC");

	//Anzeigen des Inhaltes der Datenbank Tabelle

    while($row_Notice = mysqli_fetch_array($Ergebins_Notice)){

    	echo "Neue Nachricht im Chat:" .$row_Notice['ChatID'];

    	$Chat_ID = $row_Notice['ChatID'];

    	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

    	echo "<a href='../Chat/index.php?User=$User&ChatID=$Chat_ID' target='_blank'><button>Chat &Ouml;ffnen</button></a><br />";

    }

?>