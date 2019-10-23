<!DOCTYPE html>
<html>
<body>
	<?php

		//Lade die Information aus dem Header

		$User = $_GET["User"];
		$Chat_ID = $_GET["ChatID"];

		//Verbindungsaufbau zur Datenbank

		require_once("../connection.php");


		// Download der Chat Partner

		$ChatInfo_ChatPartner = mysqli_query($verbindung, "SELECT * FROM ChatConnection WHERE ChatID = '$Chat_ID'");

		while($row_download_ChatInfo = mysqli_fetch_assoc($ChatInfo_ChatPartner)){

			//Die Information der Spalten werden bestimmten Varibale zugefuegt

			$Chat_Partner_1 = $row_download_ChatInfo['Ersteller'];
			$Chat_Partner_2 = $row_download_ChatInfo['Empfaenger'];

		}

		//Vergleicht in welcher Spalte der aktive User eingetragen ist

		if($User == $Chat_Partner_1){

			//Wenn der User in der ChatConnetion als Ersteller eingetragen ist werden nur die Informationen vom Empfaenger geladen

			$AccountInfo_Empfaenger = mysqli_query($verbindung, "SELECT * FROM Profil WHERE benutzername = '$Chat_Partner_2'");
			while($row_AccountInfo_download_Empfaenger = mysqli_fetch_assoc($AccountInfo_Empfaenger)){

				//Es werden die einzelnen Informationen aus der Profil Tabelle geladen ueber den Chat Partner

				$Empfaenger_AccountInfo_Vorname = $row_AccountInfo_download_Empfaenger['Vorname'];
				$Empfaenger_AccountInfo_Nachname = $row_AccountInfo_download_Empfaenger['Nachname'];

			}

		}elseif($User == $Chat_Partner_2) {
				
				//Wenn der User in der ChatConnetion als Ersteller eingetragen ist werden nur die Informationen vom Empfaenger geladen

			$AccountInfo_Ersteller = mysqli_query($verbindung, "SELECT * FROM Profil WHERE benutzername = '$Chat_Partner_1'");
			while($row_AccountInfo_download_Ersteller = mysqli_fetch_assoc($AccountInfo_Ersteller)){

				//Es werden die einzelnen Informationen aus der Profil Tabelle geladen ueber den Chat Partner

				$Ersteller_AccountInfo_Vorname = $row_AccountInfo_download_Ersteller['Vorname'];
				$Ersteller_AccountInfo_Nachname = $row_AccountInfo_download_Ersteller['Nachname'];
				$Ersteller_AccountInfo_Mail = $row_AccountInfo_download_Ersteller['Mail'];

			}
		}else{
			echo "Beim laden der Informationen zum Chat Partner ist ein Fehler aufgetretten!";
		}
	?>

	<div class="ChatInfo">
		<p class="ChatInfo" id="AllgemeineInfo">
			Vorname: <?php echo $Empfaenger_AccountInfo_Vorname;echo $Ersteller_AccountInfo_Vorname; ?><br />
			Nachname: <?php echo $Empfaenger_AccountInfo_Nachname;echo $Ersteller_AccountInfo_Nachname; ?><br />
		</p>
		<p class="ChatInfo" id="BeruflicheInfo">
			E-Mail Adresse: <?php echo $Empfaenger_AccountInfo_Mail;echo $Ersteller_AccountInfo_Mail; ?><br />
		</p>
	</div>
</body>
</html>