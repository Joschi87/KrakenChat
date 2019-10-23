<!DOCTYPE html>
<html>
<head>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
       $(document).ready(function (){
         $("#flip1").click(function (){
            $("#panel1").slideToggle("fast");});
         });
    </script>

</head>
<body>
	<?php

		//Lade die Information aus dem Header

		$User = $_GET["User"];
		$Chat_ID = $_GET["GroupChatID"];

		//Verbindungsaufbau zur Datenbank

		require_once("../connection.php");


		// Download der Chat Partner

		$ChatInfo_ChatPartner = mysqli_query($verbindung, "SELECT * FROM GroupChatConnection WHERE GroupChatID = '$Chat_ID'");

		while($row_download_ChatInfo = mysqli_fetch_assoc($ChatInfo_ChatPartner)){

			//Die Information der Spalten werden bestimmten Varibale zugefuegt

			$GroupChat_GroupName = $row_download_ChatInfo['GroupName'];
			$GroupChat_Description= $row_download_ChatInfo['Description'];
			$GroupChat_GroupMember1 = $row_download_ChatInfo['GroupMember1'];
			$GroupChat_GroupMember2 = $row_download_ChatInfo['GroupMember2'];
			$GroupChat_GroupMember3 = $row_download_ChatInfo['GroupMember3'];
			$GroupChat_GroupMember4 = $row_download_ChatInfo['GroupMember4'];
			$GroupChat_GroupMember5 = $row_download_ChatInfo['GroupMember5'];
			$GroupChat_GroupMember6 = $row_download_ChatInfo['GroupMember6'];
			$GroupChat_GroupMember7 = $row_download_ChatInfo['GroupMember7'];
			$GroupChat_GroupMember8 = $row_download_ChatInfo['GroupMember8'];
			$GroupChat_GroupMember9 = $row_download_ChatInfo['GroupMember9'];
			$GroupChat_GroupMember10 = $row_download_ChatInfo['GroupMember10'];

		}

	?>

	<div class="ChatInfo">
		<p class="GroupChat_Info">
			Gruppen Name: <?php echo $GroupChat_GroupName; ?><br /><br />
			Gruppen Beschreibung: <?php echo $GroupChat_Description; ?><br /><br />
			Gruppen Mitglieder:<br />
			- <?php echo $GroupChat_GroupMember1; ?><br />
			- <?php echo $GroupChat_GroupMember2; ?><br />
			- <?php echo $GroupChat_GroupMember3; ?><br />
			- <?php echo $GroupChat_GroupMember4; ?><br />
			- <?php echo $GroupChat_GroupMember5; ?><br />
			- <?php echo $GroupChat_GroupMember6; ?><br />
			- <?php echo $GroupChat_GroupMember7; ?><br />
			- <?php echo $GroupChat_GroupMember8; ?><br />
			- <?php echo $GroupChat_GroupMember9; ?><br />
			- <?php echo $GroupChat_GroupMember10; ?><br />
		</p>
	</div>
</body>
</html>