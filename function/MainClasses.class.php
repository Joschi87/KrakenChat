<?php

//The MainClasses.php file is a file for all classes of the project KrakenChat

class Message{
    
    //Class variable 
    public $databaseName = "KrakenChat";
    public $user = NULL;
    public $chat_ID = NULL;
    public $kindOfChat = NULL;
    public $text = NULL;

    function CheckingMessage($text) {
        //If the message empty or not

        $text = trim($_POST["NeueNachricht"]);
        if ($text = ""){
            print "<script text='text/javascript'>alert('You forgot to type a message. Please press okay for change this!')";
            header("refresh:0,1");
        }else{$statmantOfCheckingMessage= TRUE;}
    }

    function CreateNewMessage($chat_ID, $user, $kindOfChat){

        require_once("connection.php");

        $text = trim($_POST["NeueNachricht"]);
        require_once("Verschluesselung.php");

        //Message insert into the database and creat a notification in the ChatConnection table

        $newNachricht = $mysqli->query($verbindung, "INSERT INTO `$Chat_ID`(Nachricht, Sender, DatumUhrzeit) VALUES ('$ausgabe', '$User', '$LoaclTime')");
        $newNotification = $mysqli->query($verbindung, "UPDATE ChatConnection SET Notification = 'Neue Mitteilung' WHERE ChatID = '$Chat_ID'");
        
        if(is_bool($newNachricht) === TRUE AND is_bool($newNotification) === TRUE ){
            print "<script text='text/javascript'>console.log('Write message successfuly')";
            $mysqli->close();
        }else{
            $mysqli->close();
            print "<script text='text/javascript'>alert('Wirte message unsuccessfuly. Please try it again')";
            header("refresh:0,1;url=/Chat/index.php?User=$User&ChatID=$Chat_ID&KindofChat=$KindOfChat");
        }
    }
}

class Chat{
        
}

?>