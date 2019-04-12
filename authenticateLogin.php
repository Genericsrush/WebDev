<?php  
 require('connect.php');

 session_start();

if (isset($_POST['username']) and isset($_POST['password'])){
	
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "SELECT UserID,Name,Password,Privilege FROM users WHERE Name ='$username'";
	 
	$result = $db->query($query);

	$count = $result->rowCount();

	if ($count == 1){
		foreach($result as $key){

			if (password_verify($password, $key['Password'])) {

				$_SESSION['username'] = $username;

				$_SESSION['priv'] = $key['Privilege'];
				$_SESSION['UserID'] = $key['UserID'];
				header("Location: main.php");
			}
			else {
				header( "Location: index.php?loginFailed=true" );
			}
		}
	} else {
		
		header( "Location: index.php?loginFailed=true" );
	}
}
?>