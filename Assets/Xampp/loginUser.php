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
	
	
	//check connection
	$conn = new mysqli($server_name, $server_username, $server_password, $database_name);
	if(!$conn)
	{
		die("connection failed".mysqli_connect_error());
	}
	
	//http://localhost/nsirpg/loginuser.php
	
	//check users exists
	$namecheckquery = "SELECT username, salt, hash FROM users WHERE username = '".$username."'";
	$namecheck = mysqli_query($conn, $namecheckquery);
	if(mysqli_num_rows($namecheck) != 1)
	{
		echo "Wi Tu Lo";
		exit();
	}
	
	//get login from query
	$existinginfo = mysqli_fetch_assoc($namecheck);
	$salt = $existinginfo["salt"];
	$hash = $existinginfo["hash"];
	
	$loginhash = crypt($password, $salt);
	if($hash != $loginhash)
	{
		echo "0";
		exit();
	}
	else
	{
		echo "1";
	}
	
	
	

?>