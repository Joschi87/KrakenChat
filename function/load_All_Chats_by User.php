<?php

	$User_for_Chats = $_GET["User_for_Chats"];

    $review_for_User_are_Ersteller = mysqli_query($verbindung, "SELECT ChatID, Ersteller, Empfaenger FROM ChatConnection WHERE Ersteller = '$User_for_Chats' or Empfaenger = '$User_for_Chats'");

    while ($row_for_User_are_Ersteller = mysqli_fetch_assoc($review_for_User_are_Ersteller)){
       echo "<a href='../Chat/index.php?User=<?php echo $User_for_Chats; ?>&ChatID=<?php echo $row_for_User_are_Ersteller['ChatID']; ?>'><button>" .$row_for_User_are_Ersteller['ChatID'] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .$row_for_User_are_Ersteller['Ersteller'] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .$row_for_User_are_Ersteller['Empfaenger'] ."</button></a><br />";
                }

?>