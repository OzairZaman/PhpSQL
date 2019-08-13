<?php
	// $ for variables
	
	// server login variables
	$server_name = "localhost";
	$server_username = "root";
	$server_password = "";
	$database_name = "nsirpg";
	
	//user variables
	//these variables represent data in our table, our columns. 
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	
	//check connection
	$conn = new mysqli($server_name, $server_username, $server_password, $database_name);
	if(!$conn)
	{
		die("connection failed".mysqli_connect_error());
	}
	
	
	
	//check users exists
	//we going to query
	$namecheckquery = "SELECT username FROM users WHERE username = '".$username."'";
	$namecheck = mysqli_query($conn, $namecheckquery);
	if(mysqli_num_rows($namecheck) > 0)
	{
		echo "Username Already Exists";
		exit();
	}
	//check if email exists
	$emailcheckquery = "SELECT email FROM users WHERE email = '".$email."'";
	$emailcheck = mysqli_query($conn, $emailcheckquery);
	if(mysqli_num_rows($emailcheck) > 0)
	{
		echo "Email Already Exists";
		exit();
	}
	
	
	//password
	//salt + hash
		$salt = "\$5\$round=5000\$"."supercalifragilisticexpialidocious".$username."\$";
		$hash = crypt($password, $salt);
		
		//note: the sql statement VALUES variables are the data variable we created
		//		to represent the table
		$insertuserquery = "INSERT INTO users(username, email, hash, salt) VALUES('".$username."', '".$email."', '".$hash."', '".$salt."')";
		//use built in method to execute the SQL statement
		mysqli_query($conn, $insertuserquery) or die("Error: insert failed");
		echo "Success";
	
	//create user
	
	

?>