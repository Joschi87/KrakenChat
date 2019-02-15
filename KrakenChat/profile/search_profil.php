<!DOCTYPE html>
<html>
<head>
	<title>Projekt 360&deg;</title>
	<meta charset="utf-8" /> 
	<link href="../style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<?php


		//Nutzer auslesen
    
        $User = $_GET["User"];

        //Gesuchtes Profil auslesen

        $Search_Profil = $_GET["Profil"];

		require_once("../function/connection.php");
		require_once("../function/kennung.php");
		require_once("../function/ZeitErkennung.php");
		require_once("../function/Control_Cookie.php");

		//Download des Programmes für die Auslesung des Profils der gesuchten Person

		require_once("../function/Profildaten_auslesen.php");

	?>
	<script type="text/javascript">
       $(document).ready(function (){
         $("#flip1").click(function (){
            $("#panel1").slideToggle("fast");});
         });
    </script>
</head>
<body>
    <header>
       <div id="top_bar" class="top_bar">
            <div class="menue">
            	<a href="../function/close.html"><div class="m_button" id="up"><p class="menue"><center>Schließen</center></p></div></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="menue" href="../function/close.html"><div class="m_button" id="up"><p class="menue"><center>Home</center></p></div></a>&nbsp;&nbsp;&nbsp;
                <a class="menue" href="../profile/profil_work.php?User=<?php echo $User; ?>"><div class="m_button" id="up"><p class="menue"><center><?php echo $User; ?></center></p></div></a>
            </div>
        </div> 
    </header>
    <div class="activ_User">
		&nbsp;&nbsp;&nbsp;&nbsp;<div id="flip1"><button class="m_activ_User_Button"><center><b>Aktive Nutzer</b></center></button></div>&nbsp;&nbsp;&nbsp;&nbsp;<br /><br />
        <div id="panel1" style="display: none; margin-left: 2%;">
        	<p>Vorname:&nbsp;&nbsp;&nbsp;&nbsp;Nachname:&nbsp;&nbsp;&nbsp;&nbsp;Username:&nbsp;&nbsp;</p>
			<?php
			
				$activ_User = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername, Aktiv FROM login ORDER BY Aktiv DESC");
		
				while ($row_activ_User = mysqli_fetch_assoc($activ_User)){
            		echo $row_activ_User['Vorname'] ."&nbsp;&nbsp;" .$row_activ_User['Nachname'] ."&nbsp;&nbsp;" .$row_activ_User['benutzername'] ."&nbsp;&nbsp;&nbsp;&nbsp;" .$row_activ_User['Aktiv'] ."<br />";
            	}
		
			?>
		</div>
	</div>
	<div class="Profil">
		<div class="Profilbild">

		</div>
		<div class="AllgemineInfos">
			<p class="Profil_Information"><b>Allgemeine Informationen:</b></p><br />
			<p class="Profil_Information">Vorname: <?php echo $Vorname_DB; ?></p>
			<p class="Profil_Information">Nachname: <?php echo $Nachname_DB; ?></p>
			<p class="Profil_Information">Benutzername: <?php echo $Benutzername_DB; ?></p>
		<br /><br /><br />
			<p class="Profil_Information"><b>Weitere Informationen:</b></p><br />
			<p class="Profil_Information">Geburtstag: <?php echo $Geburtstag_DB; ?></p>
			<p class="Profil_Information">Telefonnummer Gesch&aumlftlich: <?php echo $Telefonnummer_Beruflich_DB; ?></p>
			<p class="Profil_Information">Telefonnummer Mobil: <?php echo $Telefonnummer_Mobil_DB; ?></p>
		</div>
	</div>
</body>
</html>