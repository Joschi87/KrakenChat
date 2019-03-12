<?php
	
	//Function of controlling the Database Username

	function UserControll(){

		$controlnumber = 0;
		$search_DBUser = mysqli_query($verbindung, "SELECT * FROM mysql.user WHERE User = '$database_Username'");
		while ($row_controlDBUser= mysqli_fetch_object($search_DBUser)){$controlnumber++;}

		if ($controlnumber != 0) {
			
			//Set the global variable for controlling the result of searching the username

			$GLOBALS['result_DBUser'] = $search_DBUser;

		}else{

			$GLOBALS['result_DBUser'] = $search_DBUser;

		}

	}

?>