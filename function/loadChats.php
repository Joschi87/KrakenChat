<?php
    $User = $_GET["User"];
    header("refresh:30;url=loadChats.php?User=$User");
?>
<!DOCTYPE html>
<html>
<body>
<?php

        $User = $_GET["User"];

		require_once("connection.php");
        require_once("ZeitErkennung.php");
        require_once("Control_Cookie.php");

        echo "<link href='../style.css' type='text/css' rel='stylesheet' />";

		echo "<div class='All_Chats'>";

		$review_for_User_are_Ersteller = mysqli_query($verbindung, "SELECT ChatID, Ersteller, Empfaenger, Notification FROM ChatConnection WHERE Ersteller = '$User' OR Empfaenger = '$User' ORDER BY Notification DESC");

    	while ($row = mysqli_fetch_assoc($review_for_User_are_Ersteller)){

            $Ersteller = $row['Ersteller'];
            $Empfaenger = $row['Empfaenger'];

            if ($Ersteller == $User) {

                $FullName_from_Empfaenger = mysqli_query($verbindung, "SELECT Vorname, Nachname FROM Profil WHERE benutzername = '$Empfaenger'");

                while ($row_FullName_Empfaenger = mysqli_fetch_assoc($FullName_from_Empfaenger)){

                        echo "<span id='Chat_open'>".$row_FullName_Empfaenger['Vorname'] ."&nbsp;&nbsp;&nbsp;" .$row_FullName_Empfaenger['Nachname'] ."&nbsp;&nbsp;&nbsp;" .$row['Notification'];

                    }
            }elseif ($Empfaenger == $User) {

                $FullName_from_Ersteller = mysqli_query($verbindung, "SELECT Vorname, Nachname FROM Profil WHERE benutzername = '$Ersteller'");

                while ($row_FullName_Ersteller = mysqli_fetch_assoc($FullName_from_Ersteller)){

                        echo "<span id='Chat_open'>".$row_FullName_Ersteller['Vorname'] ."&nbsp;&nbsp;&nbsp;" .$row_FullName_Ersteller['Nachname'] ."&nbsp;&nbsp;&nbsp;" .$row['Notification'];
                    }
            }else{
                echo "Ein Fehler ist aufgetretten!";
            }

    	   

    	   $ChatID_DB = $row['ChatID'];
           $Notice = $row['Notification']; 

    	   echo "<a href='../Chat/index.php?User=$User&ChatID=$ChatID_DB&Notice=$Notice&KindofChat=P2P' target='_blank'><button id='Chat_Button_open'>&Ouml;ffnen</button></a><a href='../function/Delete_Chat.php?User=$User&Delete_Chat_ID_Nummer=$ChatID_DB' target='_blank'><button id='Chat_Button_delete'>Löschen</button></a></span><br />";
          
          }

        echo "</div>";
?>
</body>
</html>