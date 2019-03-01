<?php
    //require_once("function/report.php");
    header("refresh:60;url='index.php'");
?>
<!DOCTYPE html>
<html>
<head>
	<title>KrakenChat</title>
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
            </center>
        </div>
    </center>
</body>
</html>