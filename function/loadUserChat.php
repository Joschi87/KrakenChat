<?php
	$User = $_GET["User"];
	$Chat_ID = $_GET["ChatID"];
	header("refresh:5;url=loadUserChat.php?User=$User&ChatID=$Chat_ID");
	error_reporting (0);
?>
<!DOCTYPE html>
<html>
<body>
	<?php

	require_once("connection.php");

	//Download der Informationen (User und Chat ID) aus dem Header
	
	$User = $_GET["User"];
	$Chat_ID = $_GET["ChatID"];


	//Loding of the DarkMode Cookie if he is activ
	$DarkMode_Cookie = $_COOKIE["DarkMode"];

	if ($DarkMode_Cookie == "aktivate"){

		//loading of the DarkMode.css file

		print("<link href='DarkMode.css' type='text/css' rel='stylesheet' />");

	}else{}

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

		$Ergebins = mysqli_query($verbindung, "SELECT * FROM `$Chat_ID` ORDER BY ID DESC");
		
		print "<!-- Start list of links for Bootstrap4 --><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script><!-- End list --><!--Settings for Bootstrap --><meta name='viewport' content='width=device-width, initial-scale=1'>";
		print "<div class='container'>";

		//Anzeigen des Inhaltes der Datenbank Tabelle

	    while($row_2 = mysqli_fetch_array($Ergebins)){

	    	//Entschluesselung der Nachricht

	    	$blowfish = new Blowfish($key);
	    	$ausgabe_3 =$blowfish->Decrypt($row_2['Nachricht']);

	    	$GLOBALS['ausgabe'] = $ausgabe_3;

	    	echo "" .$row_2['Sender'] .":</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class='Nachricht' id='message'>" .$ausgabe ."</div><p style='font-size: 8pt;' id='DateTime'>" .$row_2['DatumUhrzeit'] ."</p><br />";

	    }

	    echo "</div>";

?>
</body>
</html>