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
		require_once("../function/ZeitErkennung.php");
		require_once("../function/Control_Cookie.php");
	?>
    <script>
		$(document).ready(function(){
			$("#flip").click(function(){
				$("#panel").slideToggle("fast");
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("#flip2").click(function(){
				$("#panel2").slideToggle("fast");
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("#flip4").click(function(){
				$("#panel4").slideToggle("fast");
			});
		});
	</script>
    <?php
    
       $sql_Profilbild = "SELECT Profilbild FROM Profil WHERE benutzername = '$User'";
            $db_erg_Profilbild = mysqli_query($verbindung, $sql_Profilbild );
            if ( ! $db_erg_Profilbild )
            {
                die('Ungültige Abfrage: ' . mysqli_error());
            }
            while ($zeile_Profilbild = mysqli_fetch_array( $db_erg_Profilbild, MYSQLI_ASSOC)){

            $Profilbild_DB = $zeile_Profilbild["Profilbild"]; 
            }
		
    ?> 
</head>
<body>
    <header>
       <div id="top_bar" class="top_bar">
            <div class="menue">
            	<a class="menue" href="../function/logout.php?User=<?php echo $User;?>"><div class="m_button"><p class="menue"><center>Ausloggen</center></p></div></a>&nbsp;&nbsp;&nbsp;
                <a class="menue" href="../profile/index.php?User=<?php echo $User;?>"><div class="m_button" id="up"><p class="menue"><center>Home</center></p></div></a>&nbsp;&nbsp;&nbsp;
                <a class="menue" href="../profile/profil_work.php?User=<?php echo $User; ?>"><div class="m_button" id="up"><p class="menue"><center><?php echo $User; ?></center></p></div></a>
            </div>
            <div class="search">
            	<form action="../function/search.php?User=<?php echo $User;?>" target="_blank" method="post">
            		<input type="text" name="Search_User" value="Nutzer suchen(Nachname)" />&nbsp;&nbsp;&nbsp;&nbsp;
            		<input type="submit" value="Suchen">
            	</form>
            </div>
        </div> 
    </header>
    <div class="activ_User">
		<div id="flip4"><button class="m_activ_User_Button"><center><b>Aktive Nutzer</b></center></button></div>&nbsp;&nbsp;&nbsp;&nbsp;<br />
        <div id="panel4" style="margin-left: 2%; height: 200%; width: 110%; display: none;">
			<iframe src="../function/active_User.php?User=<?php echo $User;?>" id="activ_User" style="height: 50%;"></iframe>
		</div>
	</div>
	<div class="Messenger_Control_Panel">
		<div class="Messenger_Control_Panel_Button"><a href='../function/NewGroupChat.php?User=<?php echo $User;?>' target="_blank"><button class="m_Messenger_Control_Panel"><center><b>Gruppen erstellen</b></center></button></a></div>
	</div>
	<div class="Messenger">
		<p style="margin-left: 2%;">Einzel Chats:</p>
		<iframe src="../function/loadChats.php?User=<?php echo $User; ?>" id="Chats">
		</iframe>
    </div>
    <div class="Messenger_Group">
    	<p style="margin-left: 2%;">Gruppen Chats:</p>
		<iframe src="../function/loadGroupChat.php?User=<?php echo $User; ?>" id="Chats">
		</iframe>
    </div>
</body>
</html>