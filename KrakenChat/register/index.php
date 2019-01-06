<!DOCTYPE html>
<html>
<head>
	<title>Projekt 360&deg;</title>
	<meta charset="utf-8" /> 
	<link href="../style.css" type="text/css" rel="stylesheet" />
	<?php require_once("../function/connection.php");?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
    <header>
       <div id="top_bar" class="top_bar">
            <div class="menue">
                <a class="menue" href="../index.php"><div class="m_button" id="up"><p class="menue"><center>Home</center></p></div></a>&nbsp;&nbsp;&nbsp;
                <a class="menue" href="../index.php"><div class="m_button" id="up"><p class="menue"><center>Login</center></p></div></a>&nbsp;&nbsp;&nbsp;
            </div>
        </div> 
    </header>
    <div class="register_ebene" style="margin-top: 10%;">
        <center><br />
            <form action="../function/register.php" method="post" class="register" target="_blank">
                Vorname:<br />
                <input type="text" style="width: 250px;"  name="Vorname" id="Register_Vorname"  />*<br /><br />
                Nachname:<br />
                <input type="text" style="width: 250px;" name="Nachname" id="Register_Nachname" />*<br /><br />
                Benutzername:<br />
                <input type="text" style="width: 250px;" name="Benutzername" id="Register_Benutzername" />*<br /><br />
                E-Mail Adresse:<br />
                <input type="text" style="width: 250px;" name="Mail" id="Register_Mail" />*<br /><br />
                Geburtstag:<br />
                <input type="date" name="Geburtstag"><br /><br />
                Telefonnummer (Geschäftlich):<br />
                <input type="text" style="width: 250px;" name="Telefonnummer_Beruflich" id="Register_Telefonnummer_Beruflich" /><br /><br />
                Telefonnummer (Mobil):<br />
                <input type="text" style="width: 250px;" name="Telefonnummer_Mobil" id="Register_Telefonnummer_Mobil" /><br /><br />
                Abteilung:<br />
                <input type="text" style="width: 250px;" name="Abteilung" /><br /><br />
                Standort:<br />
                <input type="text" style="width: 250px;" name="Standort" /><br /><br />
                <input type="submit" value="Regestieren" />
            </form>
			<br />
        </center>
    </div>
</body>
</html>