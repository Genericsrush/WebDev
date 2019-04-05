<?php 
	include "connect.php";

	$message = "";

	if(isset($_POST['Name']) && $_POST['Name'] != "")
    {
	    $Name = filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
	else
	{
		$message = "You must set a name!";
	}

	if(isset($_POST['Password']))
    {
	    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

	}
	else
	{
		$Privilege = 1;
	}

	if(isset($_POST['Privilege']))
    {
	    $Privilege = filter_input(INPUT_POST, 'Privilege', FILTER_VALIDATE_INT);
	}
	else
	{
		$Privilege = 1;
	}

	if(isset($_POST['UserID']))
	{
		$UserID = filter_input(INPUT_POST, 'UserID', FILTER_VALIDATE_INT);
	}

	if(isset($_POST['command']))
    {
	    $command = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	if($_POST['Name'] === "" || $_POST['Privilege'] === "")
	{
		//This part of the code makes sure the rest of the code doesn't exicute if the content or title are empty.
	}	
	else
	{
		if(isset($_POST['command']))
	    {
		switch (strtoupper($command)) {
			case "INSERT":
				$query = "".strtoupper($command)." INTO users (Name,Password,Privilege) VALUES (:Name,:Password,:Privilege)";
				break;
			case "UPDATE":
				$query = "".strtoupper($command)." users SET Name=:Name, Privilege=:Privilege WHERE UserID = :UserID";
				break;
			case "DELETE":
				$query = "".strtoupper($command)." FROM users WHERE UserID=:UserID";
					$statement = $db->prepare($query);
					$statement->bindValue(':UserID', $UserID);
					$statement->execute();
					header("Location: main.php");
					exit;
				break;
			default:
		}
		}
		if(isset($query)){
			$statement = $db->prepare($query);
		}

				if(isset($_POST['UserID'])){
				$statement->bindValue(':UserID', $UserID);
				}   

				if(isset($_POST['Name'])){
		        $statement->bindValue(':Name', $Name);
		    	}

		        if(isset($_POST['Password'])){
		        $statement->bindValue(':Password', $Password);
		   		 }

		   		if(isset($_POST['Privilege'])){
		        $statement->bindValue(':Privilege', $Privilege);
		   		 }

		   	if(isset($statement)){
		        $statement->execute();
		    }
		    header("Location: main.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Error</title>
</head>
<body>
<p><?=$message?></p>
</body>
</html>