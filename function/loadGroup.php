<?php
	$User = $_GET["User"];
	$GroupChat_ID = $_GET["GroupChatID"];
	header("refresh:5;url=loadGroup.php?User=$User&GroupChatID=$GroupChat_ID");
?>
<!DOCTYPE html>
<html>
<body>
	<?php

	require_once("connection.php");

	//Download der Informationen (User und Chat ID) aus dem Header
	
	$User = $_GET["User"];
	$GroupChat_ID = $_GET["GroupChatID"];

	//Sicherheitsprogramme laden

    require_once("ZeitErkennung.php");
    require_once("Control_Cookie.php");
    include("blowfish.class.php");

	    //Key aus der ChatConnection runterladen

		$download_key_Group = mysqli_query($verbindung, "SELECT VSK FROM GroupChatConnection WHERE GroupChatID = '$GroupChat_ID'");

		while($row_Group = mysqli_fetch_assoc($download_key_Group)){

			$key_Group = $row_Group['VSK'];

		}

		//Download der Datenbank Tabelle des Chates

		$DB_Inhalt_Group = "SELECT * FROM `$GroupChat_ID` ORDER BY ID DESC";

		$Ergebins_Group = mysqli_query($verbindung, $DB_Inhalt_Group);

		//Anzeigen des Inhaltes der Datenbank Tabelle

	    while($row_2_Group = mysqli_fetch_array($Ergebins_Group)){

	    	//Entschluesselung der Nachricht

	    	$blowfish = new Blowfish($key_Group);
	    	$ausgabe_3_Group =$blowfish->Decrypt($row_2_Group['Nachricht']);

	    	$GLOBALS['ausgabe_Group'] = $ausgabe_3_Group;

	    	echo $row_2_Group['Sender'] .":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class='Nachricht'>" .$ausgabe_Group ."</div><p style='font-size: 8pt;'>" .$row_2_Group['DatumUhrzeit'] ."</p><br />";

	    }

?>
</body>
</html>