<?php

	//Download der Informationen aus der Header


    $user = $_GET["User"];
	$chat_ID = $_GET["ChatID"];
    $kindOfChat = $_GET["KindofChat"];
    $text = $_POST["NeueNachricht"];

    include("MainClasses.class.php");
    require_once("Verschluesselung.php");

    $newObjectOfMessage = new Message($chat_ID, $user, $kindOfChat, $ausgabe, $text);

    if ($text == ""){
        print "<script text='text/javascript'>console.log('No Message in the input!')</script> ";
        print "<script text='text/javascript'>alert('You forgot to type a message. Please press okay for change this!')</script>";
        header("refresh:0.1;url=../Chat/index.php?User=$user&ChatID=$chat_ID&KindofChat=$kindOfChat&Notice=");
    }else{$newObjectOfMessage->CreateNewMessage();}
        
    
?>