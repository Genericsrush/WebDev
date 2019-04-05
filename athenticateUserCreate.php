<?php  
 include('connect.php');

 session_start();

if (isset($_POST['username'])){
	
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "SELECT * FROM users WHERE Name ='$username'";
	 
	$result = $db->query($query);

	$count = $result->rowCount();

	if ($count == 1){

		header("Location: createUser.php?userExists=true");
	} else {

		if(isset($_POST['password'])){
			$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			$password = password_hash($password,PASSWORD_DEFAULT);
		}
		else{
			header("Location: index.php");
		}
		
		$query = "INSERT INTO users (Name,Password,Privilege) VALUES (:username,:password,2)";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':password', $password);
		$statement->execute();

		$_SESSION['username'] = $username;
		$_SESSION['priv'] = 2;
		header("Location: main.php?userCreated=true");
	}
}
else{
	header("Location: index.php");
}
?>