<?php
	$User = $_GET["User"];
	$Chat_ID = $_GET["ChatID"];
	header("refresh:5;url=loadUserChat.php?User=$User&ChatID=$Chat_ID");
?>
<!DOCTYPE html>
<html>
<body>
	<?php

	require_once("connection.php");

	//Download der Informationen (User und Chat ID) aus dem Header
	
	$User = $_GET["User"];
	$Chat_ID = $_GET["ChatID"];

	//Sicherheitsprogramme laden

    require_once("ZeitErkennung.php");
    require_once("Control_Cookie.php");
    include("blowfish.class.php");

	    //Key aus der ChatConnection runterladen

		$download_key = mysqli_query($verbindung, "SELECT VSK FROM ChatConnection WHERE ChatID = '$Chat_ID'");

		while($row = mysqli_fetch_assoc($download_key)){

			$key = $row['VSK'];

		}

		//Download der Datenbank Tabelle des Chates

		$DB_Inhalt = "SELECT * FROM `$Chat_ID` ORDER BY ID DESC";

		$Ergebins = mysqli_query($verbindung, $DB_Inhalt);

		//Anzeigen des Inhaltes der Datenbank Tabelle

	    while($row_2 = mysqli_fetch_array($Ergebins)){

	    	//Entschluesselung der Nachricht

	    	$blowfish = new Blowfish($key);
	    	$ausgabe_3 =$blowfish->Decrypt($row_2['Nachricht']);

	    	$GLOBALS['ausgabe'] = $ausgabe_3;

	    	echo $row_2['Sender'] .":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class='Nachricht'>" .$ausgabe ."</div><p style='font-size: 8pt;'>" .$row_2['DatumUhrzeit'] ."</p><br />";

	    }

?>
</body>
</html>