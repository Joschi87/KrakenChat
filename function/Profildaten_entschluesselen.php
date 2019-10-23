<?php

	//Laden des Allgemienen VSK

	require_once("VSK_Allgemein.php");

	//Entschlüsselen des Vornamen

	$blowfish = new Blowfish($key_Allgemein);
    $Vorname =$blowfish->Decrypt($Vorname_DB);

?>