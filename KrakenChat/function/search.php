<?php
	
	//Verbindung zur Datenbank

	require_once("connection.php");

	//Sicherheitsprogramme laden

	require_once("connection.php");
    require_once("ZeitErkennung.php");
    require_once("Control_Cookie.php");

	//Download der Header Information

	$User = $_GET["User"];

	//Download der Such Information

	$Search_User = $_POST["Search_User"];

	if($Search_User == "" or $Search_User == "Nutzer suchen(Nachname)"){

		header("refresh:10;url=close.html");
		echo "Sie haben das Feld leer gelassen. Versuchen Sie es erneut. Diese Mitteilung schließt sich in 10 Sekunden!";

	}else{

		$Control_Search_User = 0;
		$Control_Search_User_DB = "SELECT Vorname, Nachname, Benutzername FROM Profil WHERE Nachname = '$Search_User'";
        $ergebnis_Search_User = mysqli_query($verbindung, $Control_Search_User_DB);
            while ($row_Search_User = mysqli_fetch_assoc($ergebnis_Search_User)){$Control_Search_User++;}

        if($Control_Search_User != 0){

        	$Search_User_DB = mysqli_query($verbindung, "SELECT Vorname, Nachname, Benutzername FROM Profil WHERE Nachname = '$Search_User'");

        	echo "Gefundene Personen mit dem Nachnamen ($Search_User)";

        	echo "<br /><br /><br />";

        	while($row_Search_User_DB = mysqli_fetch_array($Search_User_DB)){

        		$Search_Profil = $row_Search_User_DB['Benutzername'];

        		echo $row_Search_User_DB['Vorname'] ."&nbsp;&nbsp;&nbsp;&nbsp;". $row_Search_User_DB['Nachname'] ."&nbsp;&nbsp;&nbsp;&nbsp;". $row_Search_User_DB['Benutzername'] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='../profile/search_profil.php?User=$User&Profil=$Search_Profil'><button>Profil &Ouml;ffnen</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='../function/New_Chat.php?User=$User&New_Chat_Partner=$Search_Profil'><button>Chat erstellen</button></a><br />";

        	}

        }else{

        	header("refresh:10;url=close.html");
        	echo "Im System ist kein Benutzer mit dem Nachnamen ($Search_User) hinterlegt! Versuchen Sie es erneut. Diese Mitteilung schließt sich in 10 Sekunden!";

        }

	}

?>