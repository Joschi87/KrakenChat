<!DOCTYPE html>
<html>
<head>
	<title>Projekt 360&deg;</title>
	<meta charset="utf-8" /> 
	<link href="../style.css" type="text/css" rel="stylesheet" />
	<?php require_once("connection.php");?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <?php

        $User = $_GET["User"];

        require_once("ZeitErkennung.php");
        require_once("Control_Cookie.php");

    ?>
</head>
<body>
    <header>
       <div id="top_bar" class="top_bar">
            <div class="menue">
                <a class="menue" href="../function/close.html"><div class="m_button"><p class="menue"><center>Schließen</center></p></div></a>&nbsp;&nbsp;&nbsp;
                <a class="menue" href="../profile/index.php?User=<?php echo $User;?>"><div class="m_button" id="up"><p class="menue"><center>Home</center></p></div></a>&nbsp;&nbsp;&nbsp;
                <a class="menue" href="../profile/profil_work.php?User=<?php echo $User; ?>"><div class="m_button" id="up"><p class="menue"><center><?php echo $User; ?></center></p></div></a>
            </div>
        </div> 
    </header>
    <div class="New_Group">
        <form action="Create_New_Group.php?User=<?php echo $User;?>" method="post" id="New_Group">
            <p><b>In einer Gruppe m&uuml;ssen mindestens 3 Person (dazu z&auml;hlt auch der Ersteller) sein!</b></p>
            <div class="Allgemeine_Group_Infos">
                Gruppen Name:
                <input type="text" name="Groupname" id="Groupname" class="New_Group" /><br /><br />
                Gruppen Beschreibung:
                <input type="text" name="Groupdescription" id="Groupdescription" class="New_Group" /><br /><br />
            </div>
            <div class="GroupMember">
                Gruppen Mitglied 1:
                <input type="text" name="GroupMember1" value="<?php echo $User;?>" style="width: 300px;" class="New_Group" /><br /><br />
                Gruppen Mitglied 2:
                <select name="GroupMember2" id="User">
                    <?php

                        $Member = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername FROM Profil");

                        while ($row_Group_Member = mysqli_fetch_assoc($Member)){

                            $Group_Member_benutzername = $row_Group_Member['benutzername'];
                            $Group_Member_Vorname = $row_Group_Member['Vorname'];
                            $Group_Member_Nachnme = $row_Group_Member['Nachname'];
                            
                            echo "<option value='$Group_Member_benutzername'>$Group_Member_Vorname $Group_Member_Nachnme</option>";

                        }

                    ?>
                </select><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="AdminGroupMember2" />-->
                <br /><br />
                Gruppen Mitglied 3:
                <select name="GroupMember3" id="User">
                    <?php

                        $Member = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername FROM Profil");

                        while ($row_Group_Member = mysqli_fetch_assoc($Member)){

                            $Group_Member_benutzername = $row_Group_Member['benutzername'];
                            $Group_Member_Vorname = $row_Group_Member['Vorname'];
                            $Group_Member_Nachnme = $row_Group_Member['Nachname'];
                            
                            echo "<option value='$Group_Member_benutzername'>$Group_Member_Vorname $Group_Member_Nachnme</option>";

                        }

                    ?>
                </select><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="AdminGroupMember3" />-->
                <br /><br />
                Gruppen Mitglied 4:
                <select name="GroupMember4" id="User">
                    <?php

                        $Member = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername FROM Profil");

                        while ($row_Group_Member = mysqli_fetch_assoc($Member)){

                            $Group_Member_benutzername = $row_Group_Member['benutzername'];
                            $Group_Member_Vorname = $row_Group_Member['Vorname'];
                            $Group_Member_Nachnme = $row_Group_Member['Nachname'];
                            
                            echo "<option value='$Group_Member_benutzername'>$Group_Member_Vorname $Group_Member_Nachnme</option>";

                        }

                    ?>
                </select><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="AdminGroupMember4" />-->
                <br /><br />
                Gruppen Mitglied 5:
                <select name="GroupMember5" id="User">
                    <?php

                        $Member = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername FROM Profil");

                        while ($row_Group_Member = mysqli_fetch_assoc($Member)){

                            $Group_Member_benutzername = $row_Group_Member['benutzername'];
                            $Group_Member_Vorname = $row_Group_Member['Vorname'];
                            $Group_Member_Nachnme = $row_Group_Member['Nachname'];
                            
                            echo "<option value='$Group_Member_benutzername'>$Group_Member_Vorname $Group_Member_Nachnme</option>";

                        }

                    ?>
                </select><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="AdminGroupMember5" />-->
                <br /><br />
                Gruppen Mitglied 6:
                <select name="GroupMember6" id="User">
                    <?php

                        $Member = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername FROM Profil");

                        while ($row_Group_Member = mysqli_fetch_assoc($Member)){

                            $Group_Member_benutzername = $row_Group_Member['benutzername'];
                            $Group_Member_Vorname = $row_Group_Member['Vorname'];
                            $Group_Member_Nachnme = $row_Group_Member['Nachname'];
                            
                            echo "<option value='$Group_Member_benutzername'>$Group_Member_Vorname $Group_Member_Nachnme</option>";

                        }

                    ?>
                </select><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="AdminGroupMember6" />-->
                <br /><br />
                Gruppen Mitglied 7:
                <select name="GroupMember7" id="User">
                    <?php

                        $Member = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername FROM Profil");

                        while ($row_Group_Member = mysqli_fetch_assoc($Member)){

                            $Group_Member_benutzername = $row_Group_Member['benutzername'];
                            $Group_Member_Vorname = $row_Group_Member['Vorname'];
                            $Group_Member_Nachnme = $row_Group_Member['Nachname'];
                            
                            echo "<option value='$Group_Member_benutzername'>$Group_Member_Vorname $Group_Member_Nachnme</option>";

                        }

                    ?>
                </select><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="AdminGroupMember7" />-->
                <br /><br />
                Gruppen Mitglied 8:
                <select name="GroupMember8" id="User">
                    <?php

                        $Member = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername FROM Profil");

                        while ($row_Group_Member = mysqli_fetch_assoc($Member)){

                            $Group_Member_benutzername = $row_Group_Member['benutzername'];
                            $Group_Member_Vorname = $row_Group_Member['Vorname'];
                            $Group_Member_Nachnme = $row_Group_Member['Nachname'];
                            
                            echo "<option value='$Group_Member_benutzername'>$Group_Member_Vorname $Group_Member_Nachnme</option>";

                        }

                    ?>
                </select><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="AdminGroupMember8" />-->
                <br /><br />
                Gruppen Mitglied 9:
                <select name="GroupMember9" id="User">
                    <?php

                        $Member = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername FROM Profil");

                        while ($row_Group_Member = mysqli_fetch_assoc($Member)){

                            $Group_Member_benutzername = $row_Group_Member['benutzername'];
                            $Group_Member_Vorname = $row_Group_Member['Vorname'];
                            $Group_Member_Nachnme = $row_Group_Member['Nachname'];
                            
                            echo "<option value='$Group_Member_benutzername'>$Group_Member_Vorname $Group_Member_Nachnme</option>";

                        }

                    ?>
                </select><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="AdminGroupMember9" />-->
                <br /><br />
                Gruppen Mitglied 10:
                <select name="GroupMember10" id="User">
                    <?php

                        $Member = mysqli_query($verbindung, "SELECT Vorname, Nachname, benutzername FROM Profil");

                        while ($row_Group_Member = mysqli_fetch_assoc($Member)){

                            $Group_Member_benutzername = $row_Group_Member['benutzername'];
                            $Group_Member_Vorname = $row_Group_Member['Vorname'];
                            $Group_Member_Nachnme = $row_Group_Member['Nachname'];
                            
                            echo "<option value='$Group_Member_benutzername'>$Group_Member_Vorname $Group_Member_Nachnme</option>";

                        }

                    ?>
                </select><!--&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="AdminGroupMember10" />-->
                <br /><br />
                <input type="submit" value="Gruppe erstellen" />
            </div>
        </form>
    </div>
</body>
</html>