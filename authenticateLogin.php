<?php  
 require('connect.php');

 session_start();

if (isset($_POST['username']) and isset($_POST['password'])){
	
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "SELECT * FROM users WHERE Name ='$username' AND Password ='$password'";
	 
	$result = $db->query($query);

	$count = $result->rowCount();

	if ($count == 1){

		//echo "<script type='text/javascript'>alert('Login Credentials verified')</script>";
		$_SESSION['username'] = $username;
		header("Location: main.php");

	} else {
		//echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
		
		header( "Location: index.php?loginFailed=true" );
	}
}
?>