<?php
    $User = $_GET["User"];
    header("refresh:30;url=loadChats.php?User=$User");
?>
<!DOCTYPE html>
<html>
<body>
<?php

        $User = $_GET["User"];

		require_once("connection.php");
        require_once("ZeitErkennung.php");
        require_once("Control_Cookie.php");
        include_once("MainClasses.class.php");

        print "<link href='../style.css' type='text/css' rel='stylesheet' />";

		print "<div class='All_Chats'>";

        $loadChat = new Chat($User);
        
        $loadChat->LoadChats();

        print "</div>";
?>
</body>
</html>