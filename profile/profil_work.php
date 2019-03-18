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
        require_once("../function/Profildaten_auslesen.php");
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
	<script>
		$(document).ready(function(){
			$("#upload").click(function(){
				$("#Upload-Form").slideToggle("fast");
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
	<div class="profil_work">
		<div class="Profilbild">
			<img src="<?php echo $Profilbild_DB; ?>" style="height: 200px; width: 150px;" alt="Leider ist keine Bild als Profilbild hinterlegt." /><br /><br />
			<button id="upload">Neues Profilbild hochladen</button><br />
			<form action="../function/upload.php" method="post" enctype="multipart/form-data" target="_blank" id="Upload-Form" style="display: none;">
                <input type="file" name="file" id='file' required /><br /><br />
                <div id="upload" onclick="startUpload()" style="border: 1px solid black; width: 100px; background: lightgray;">
                    <center><input type="submit" value="Hochladen" /></center>
                </div>
            </form>
		</div>
		<div class="Information">
			<form action="../function/Change_Profil_Information.php?User=<?php echo $User; ?>" method="post" target="_blank" id="Change_Profil_Information">
				<p class="Profil_Information"><b>Allgemeine Informationen:</b></p><br />
				Vorname:<br />
				<input type="text" name="profil_work_Vorname" class="Profil_Information" value="<?php echo $Vorname_DB; ?> " /><br />
				Nachname:<br />
				<input type="text" name="profil_work_Nachname" class="Profil_Information" value="<?php echo $Nachname_DB; ?>" /><br />
				<br /><br /><br />
				<p class="Profil_Information"><b>Weitere Informationen:</b></p><br />
				Geburtstag:<br />
				<input type="text" name="profil_work_Geburtstag" class="Profil_Information" value="<?php echo $Geburtstag_DB; ?>" /><br />
				Telefonnummer Gesch&auml;ftlich:<br />
				<input type="text" name="profil_work_Telefonnummer_beruflich" class="Profil_Information" value="<?php echo $Telefonnummer_Beruflich_DB; ?>" /><br />
				Telefonnummer Mobil:<br />
				<input type="text" name="profil_work_Telefonnummer_mobil" class="Profil_Information" value="<?php echo $Telefonnummer_Mobil_DB; ?>" /><br />
				<input type="submit" value="&Auml;nderungen speichern" />
			</form>
		</div>
	</div>
</body>
</html>