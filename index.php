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
    <!-- Start list of links for Bootstrap4 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- End list -->
    <!--Settings for Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
        <div class="container">
            <div class="login">
                <form action="function/login.php" method="post">
                        <div class="form-qroup"><label for="user">User:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="form-control" name="user" value=""/></label></div>
                        <div class="form-group"><label for="password">Passwort:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" class="form-control" name="password" value="" /></label></div>
                        <button type="submit" class="btn btn-primary">Anmelden</button>
                </form>
            </div>
        </div>
</body>
</html>