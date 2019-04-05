<?php  
 require('connect.php');

 session_start();

if (isset($_POST['username']) and isset($_POST['password'])){
	
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

	$query = "SELECT Name,Password,Privilege FROM users WHERE Name ='$username' AND Password ='$password'";
	 
	$result = $db->query($query);

	$count = $result->rowCount();

	if ($count == 1){

		$_SESSION['username'] = $username;
		foreach($result as $key){
			$_SESSION['priv'] = $key['Privilege'];
		}
		header("Location: main.php");

	} else {
		
		header( "Location: index.php?loginFailed=true" );
	}
}
?>