<?php
	
	//Load of the Header information as POST

	$database_Username = ($_POST["DB_User"]);
	$database_User_Password = ($_POST["password"]);
	$database_User_Password_Again = ($_POST["password_again"]);
	$database_Name = ($_POST["DB_Name"]);

	//loading of the functions for the process

	include("Controlling_DBUsername.php");


	if ($database_Username == "" or $database_User_Password == "" or $database_User_Password_Again == "" or $database_Name == "") {
		
		//Close the creating process of the database
		header("refresh:5;url=../close.html");
		echo "You forgot to wirte all information at the form";
		exit();

	}else{

		//Control of the passwords if they the same words
		if ($database_User_Password != $database_User_Password_Again) {
			
			//Close the creating process of the database
			header("refresh:5;url=../close.html");
			echo "The passwords are not the same. Please fix it.";
			exit();

		}else{

			require_once("../connection.php");

			//This function search the username and set a global variable with the value "Username is free" for a positiv result or "Username is in use" for a neagativ result

			UserControl();

			if ($result_DBUser == TRUE) {
				
				$creation_DBUser = mysqli_query($verbindung, "CREATE USER '$database_Username'@'localhost' IDENTIFIED BY '$database_User_Password'");

				//Control the value of $creation_DBUser

				if ($creation_DBUser == TRUE) {
				
					//the user gets all rights for mysql

					$creation_all_rights = mysqli_query($verbindung, "GRANT ALL PRIVILEGES ON * . * TO '$database_Username'@'localhost';");

					//control the value of  $creation_all_rights

					if ($creation_all_rights == TRUE) {
						
						//Create the database for the project 

						$create_database = mysqli_query($verbindung, "CREATE DATABASE '$database_Name'");

						//control the value of $create_database

						if ($create_database == TRUE) {

							mysqli_close($verbindung);
							
							header("refresh:60;url=../close.html");
							print("<center>The process was successfully!<br />Please wirte your username, password and the databasename in the file <b>connection.php</b>, if you do not the tool can not work!</center>");
							exit();

						}else{
							header("refresh:10;url=../close.html");
							print("<center>The process failed by create the database!<br /><br />Message closed at 10 secounds.</center>")
							mysqli_close($verbindung);
							exit();

						}
					}else{

						header("refresh:10;url=../close.html");
						print("<center>The process failed when the right one is awarded!<br /><br />Message closed at 10 secounds.</center>");
						mysqli_close($verbindung);
						exit();

					}
				}else{

					header("refresh:10;url=../close.html");
					print("<center>The process failed by creating the User.<br /><br />Message closed at 10 secounds.</center>");
					mysqli_close($verbindung);
					exit();

				}
			}else{

				header("refresh:10;url=../close.html");
				print("<center>The process failed. Username in use!<br /><br />Message closed at 10 secounds.</center> ");
				mysqli_close($verbindung);
				exit();

			}
		}
	}
?>