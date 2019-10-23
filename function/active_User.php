<?php

	$User = $_GET['User'];

	require_once("../function/connection.php");
	require_once("../function/ZeitErkennung.php");
	require_once("../function/Control_Cookie.php");

	$activ_User = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername, Aktiv FROM login ORDER BY Aktiv DESC");

	while ($row_activ_User = mysqli_fetch_assoc($activ_User)){

		$Aktiv_User = $row_activ_User['benutzername'];

		echo "<link href='../style.css' type='text/css' rel='stylesheet' /><div id='activ_User'>" .$row_activ_User['Vorname'] ."&nbsp;&nbsp;" .$row_activ_User['Nachname'] "&nbsp;&nbsp;".$row_activ_User['Aktiv'] ."<a id='button_activ_User' href='../profile/search_profil.php?User=$User&Profil=$Aktiv_User' target='_blank'><button>Profil &Ouml;ffnen</button></a><a href='../function/New_Chat.php?User=$User&New_Chat_Partner=$Aktiv_User' target='_blank'><button>+</button></a></div><br />";
	}
		
?>