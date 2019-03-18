<?php 
	//Loading DarkMode variabel

        $DarkMode = $_GET["DarkMode"];

	if ($DarkMode == "aktivate") {
			
			//Setzen der DarkMode Session zum starten des Darkmode
			setcookie("DarkMode", $DarkMode, 0, "/");

		}else{} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>KrakenChat</title>
	<meta charset="utf-8" /> 
	<link href="../style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<?php


		//Nutzer auslesen
    
        $User = $_GET["User"];

		require_once("../function/connection.php");
		require_once("../function/kennung.php");
		require_once("../function/ZeitErkennung.php");
		require_once("../function/Control_Cookie.php");

        //laedt die Chat ID aus dem Header um den Chat auf zubauen
        $Chat_ID = $_GET["ChatID"];
        $GroupChat_ID = $_GET["GroupChatID"];
        $KindofChat = $_GET["KindofChat"];

		//Auswertung ob eine Neue Benachrichtigung vorlag oder nicht

		$Notice = $_GET["Notice"];

		if($KindofChat == "P2P"){

			if($Notice == "Neue Mitteilung"){
				$Notification_Check = mysqli_query($verbindung, "UPDATE ChatConnection SET Notification = '' WHERE ChatID = '$Chat_ID'");
			}else{

			}
		}
		elseif($KindofChat == "GroupChat") {
			
			if($Notice == "Neue Mitteilung"){
				$Notification_Check_Group = mysqli_query($verbindung, "UPDATE GroupChatConnection SET notification = '' WHERE GroupChatID = '$GroupChat_ID'");
			}else{

			}

		}else{}

	?>
</head>
<body>
    <header>
       <div id="top_bar" class="top_bar">
            <div class="menue">
            	<a href="../function/close.html"><div class="m_button" id="up"><p class="menue"><center>Schließen</center></p></div></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="menue" href="../function/close.html"><div class="m_button" id="up"><p class="menue"><center>Home</center></p></div></a>&nbsp;&nbsp;&nbsp;
                <a class="menue" href="profil_work.php?User=<?php echo $User; ?>"><div class="m_button" id="up"><p class="menue"><center><?php echo $User; ?></center></p></div></a>
            </div>
        </div> 
    </header>
    <div class="Chat_Info">
    	<!--iFrame zum laden der Informationen die es ueber diesen Chat gibt z.B. Beim P2P Chat Kontakt Daten ueber den CHat Parnter und im GroupChat wer ist alles Mitglied, Regeln und andere-->
    	<?php
    	if ($KindofChat == "P2P"){
    		echo"<iframe src='../function/iFrames/Chat_InfoP2P.php?User=$User&ChatID=$Chat_ID' style='height: 250%;'></iframe>";
    	}elseif ($KindofChat == "GroupChat") {
    		echo"<iframe src='../function/iFrames/Chat_InfoGroup.php?User=$User&GroupChatID=$GroupChat_ID'  style='height: 250%;'></iframe>";
    	}else{
    		echo "Ein Fehler ist beim laden der Chat Informationen aufgetreten!";
    	}
    	?>
    </div>
	<div class="Messenger_For_Chat">
		<div class="Activ_Chat">
			<!--anzeigeflaeche der schon gesendeten Nachrichten-->
			<?php

				if($KindofChat == "P2P"){
					echo "<iframe src='../function/loadUserChat.php?User=$User&ChatID=$Chat_ID' id='Activ_Chat'></iframe>";
				}elseif ($KindofChat == "GroupChat") {
					echo "<iframe src='../function/loadGroup.php?User=$User&GroupChatID=$GroupChat_ID' id='Activ_Chat'></iframe>";
				}else{
					echo "Ein Fehler ist beim Laden des Chats aufgetreten!";
				}
			 ?>
		</div>
		<br /><br /><br />
		<div class="NewNachricht">
			<!--Baut die Eingabeflaeche fuer neue Nachrichten-->
			<?php
			if ($KindofChat == "P2P") {
				echo "<form action='../function/NewNachricht.php?User=$User&ChatID=$Chat_ID&KindofChat=$KindofChat' method='post'>";
			}elseif ($KindofChat == "GroupChat") {
				echo "<form action='../function/NewGroupNachricht.php?User=$User&GroupChatID=$GroupChat_ID&KindofChat=$KindofChat' method='post'>";
			}else{
				echo "Fehler beim laden der Funktion Neue Gruppen Nachricht";
			}
			
			?>
				<span style="margin: 2%;">Neue Nachricht:</span><br />
				<input type="text" name="NeueNachricht" id="NeueNachricht" /><br />
				<input type="submit" value="Absenden" id="NeueNachricht_Submit_Button">
			</form>
		</div>
	</div>
</body>
</html>