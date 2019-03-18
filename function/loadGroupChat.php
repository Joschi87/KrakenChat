<?php
    $User = $_GET["User"];
    header("refresh:30;url=loadGroupChat.php?User=$User");
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

		$review_Group_Chat = mysqli_query($verbindung, "SELECT GroupChatID, GroupName, Notification FROM GroupChatConnection WHERE GroupMember1 = '$User' OR GroupMember2 = '$User' OR GroupMember3 = '$User' OR GroupMember4 = '$User' OR GroupMember5 = '$User' OR GroupMember6 = '$User' OR GroupMember7 = '$User' OR GroupMember8 = '$User' OR GroupMember9 = '$User' OR GroupMember10 = '$User' ORDER BY Notification DESC");

    	while ($row_group_chat = mysqli_fetch_assoc($review_Group_Chat)){

    	   echo "<span id='Chat_open'>" .$row_group_chat['GroupName'] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .$row_group_chat['Notification'];

    	   $Group_ChatID_DB = $row_group_chat['GroupChatID'];
           $Group_Notice = $row_group_chat['Notification']; 

    	   echo "<a href='../Chat/index.php?User=$User&GroupChatID=$Group_ChatID_DB&KindofChat=GroupChat&Notice=$Group_Notice' target='_blank'><button id='Chat_Button_open'>&Ouml;ffnen</button></a><a href='../function/Delete_Chat.php?User=$User&Delete_GroupChat_ID_Nummer=$Group_ChatID_DB&Kind=Group' target='_blank'><button id='Chat_Button_delete'>Löschen</button></a></span><br />";
          
          }

        echo "</div>";
?>
</body>
</html>