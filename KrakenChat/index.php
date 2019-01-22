<?php
    //require_once("function/report.php");
    header("refresh:60;url='index.php'");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projekt 360&deg;</title>
	<meta charset="utf-8" /> 
	<link href="style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <center>
        <div class="content">
            <div class="login">
                <form action="function/login.php" method="post" class="login">
                    User:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="user" value=""/><br /><br />
                    Passwort:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" value="" /><br /><br />
                    <input type="submit" value="Anmelden" />
                </form>
            </div>
            <br /><br />
            <center>
                <!--<div class="registrieren">
                    <a href="register/index.php"><p>Registrieren</p></a>
                </div>-->
            </center>
        </div>
    </center>
</body>
</html>