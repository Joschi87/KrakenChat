<!DOCTYPE html>
<html>
<head>
	<title>KrakenChat</title>
	<meta charset="utf-8" /> 
	<link href="../style.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <header>
    </header>
   <div class="content">
   		<h3>First steps of the KrakenChat</h3>
   		<form action="../function/first_step/first_steps.php" method="post" class="first_steps">
   			Database Username: &nbsp;&nbsp;&nbsp;<input type="text" name="DB_User" /><br />
   			Database User password: &nbsp;&nbsp; <input type="password" name="password" class="password" id="password_1" /><br />
   			Replay password: &nbsp;&nbsp;&nbsp;  <input type="password" name="password_again" class="password" id="password_2" /><br />
   			<p id="password_status"></p>
   			Databasename:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="DB_Name" />
   			<br /><br />
   			<input type="submit" value="Datenbank einrichten" />
   		</form>
   </div>
   <script>
		$("input.password").change(function(){
			if ($('#password_1').val()==$('#password_2').val()){
				$('#password_status').html('The passwords are the same.');
				$('#password_status').css('color', 'green');
			}else{
				$('#password_status').html('The passwords are not the same words.');
				$('#password_status').css('color', 'red');
			}
		});	
	</script>
</body>
</html>