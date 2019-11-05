<?php

//The MainClasses.php file is a file for all classes of the project KrakenChat

class Message{
    
    //Class variable 
    var $databaseName = "KrakenChat";
    var $chat_ID;
    var $user;
    var $kindOfChat;
    var $ausgabe;
    var $text;
    

    function __construct($chat_ID, $user, $kindOfChat, $ausgabe, $text){
        $this->chat_ID = $chat_ID;
        $this->user = $user;
        $this->kindOfChat = $kindOfChat;
        $this->ausgabe = $ausgabe;
        $this->text = $text;
    }

    function CreateNewMessage(){

        $loaclTime = date("Y.m.d H:i:s");

        $verbindung = mysqli_connect("localhost", "root", "", "KrakenChat") or die("Keine Verbindung zum Server");

        //Message insert into the database and creat a notification in the ChatConnection table

        $newNachricht = mysqli_query($verbindung, "INSERT INTO `$this->chat_ID`(Nachricht, Sender, DatumUhrzeit) VALUES ('$this->ausgabe', '$this->user', '$loaclTime')");
        $newNotification = mysqli_query($verbindung, "UPDATE ChatConnection SET Notification = 'Neue Mitteilung' WHERE ChatID = '$this->chat_ID'");
        
        if($newNachricht === TRUE AND $newNotification === TRUE ){
            print "<script text='text/javascript'>console.log('Write message successfuly')</script>";
            mysqli_close($verbindung);
            header("refresh:0.1;url=../Chat/index.php?User=$this->user&ChatID=$this->chat_ID&KindofChat=$this->kindOfChat&Notice=");
        }else{
            mysqli_close($verbindung);
            print "<script text='text/javascript'>alert('Wirte message unsuccessfuly. Please try it again')</script>";
            header("refresh:0.1;url=../Chat/index.php?User=$this->user&ChatID=$this->chat_ID&KindofChat=$this->kindOfChat&Notice=");
        }
    }
}

class Chat{

    var $username;

    function __construct($username){
        $this->username = $username;
    }

    function LoadChats(){
 
        $verbindung = mysqli_connect("localhost", "root", "", "KrakenChat") or die ("Keine Verbindung zur Datenbank!");
        print $this->username;
        $loadAllChats = mysqli_query($verbindung, "SELECT ChatID, Ersteller, Notification, Empfaenger FROM ChatConnection WHERE Ersteller = '$this->username' OR Empfaenger = '$this->username' ORDER BY Notification DESC");
        while ($row = mysqli_fetch_assoc($loadAllChats)) {
            $Ersteller = $row["Ersteller"];
            $Empfaenger = $row["Empfaenger"];
            if($Ersteller == $this->username){
                print "<script text='text/javascript'>console.log('Found Chat with the parameter ersteller is username')</script>";
                $nameOfTheChatPartner = mysqli_query($verbindung, "SELECT Vorname, Nachname FROM Profil WHERE benutzername = '$Empfaenger'");
                while ($rowNameEmpfaenger = mysqli_fetch_assoc($nameOfTheChatPartner)) {print "<span id='Chat_open'>".$rowNameEmpfaenger['Vorname'] ."&nbsp;&nbsp;&nbsp;" .$rowNameEmpfaenger['Nachname'] ."&nbsp;&nbsp;&nbsp;" .$row['Notification'];}
            }elseif ($Empfaenger == $this->username){
                $nameOfTheChatPartner = mysqli_query($verbindung, "SELECT Vorname , Nachname FROM Profil WHERE benutzername = '$Ersteller");
                while ($rowNameErsteller = mysqli_fetch_assoc($nameOfTheChatPartner)){print "<span id='Chat_open'>" .$rowNameErsteller['Vorname'] ."}&nbsp;&nbsp;&nbsp;" . $rowNameErsteller['Nachname'] ."&nbsp;&nbsp;&nbsp;" . $row['Notification'];}
            }else{print "<script text='text/javascript'>console.log('Something goes wrong!')</script>";print "<div class='alert alert-warning'><strong>Warning!</strong>Something goes worng!</div>";}
        $ChatID_DB = $row['ChatID'];$Notice = $row['Notification'];print"<a href='../Chat/index.php?User=$this->username&ChatID=$ChatID_DB&Notice=$Notice&KindofChat=P2P' target='_blank'><button id='Chat_Button_open'>&Ouml;ffnen</button></a><a href='../function/Delete_Chat.php?User=$this->username&Delete_Chat_ID_Nummer=$ChatID_DB' target='_blank'><button id='Chat_Button_delete'>Löschen</button></a></span><br />";
        }
        
    }
        
}

?>