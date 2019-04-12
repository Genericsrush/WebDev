<?php 
	include "connect.php";

	session_start();

	$message = "";

	if(isset($_POST['Content']) && $_POST['Content'] != "")
    {
	    $Content = filter_input(INPUT_POST, 'Content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
	else
	{
		$message = "You must have input data!";
	}

	if(isset($_POST['ReviewID']))
	{
		$ReviewID = filter_input(INPUT_POST, 'ReviewID', FILTER_VALIDATE_INT);
	}

	if(isset($_POST['CharacterID']))
	{
		$CharacterID = filter_input(INPUT_POST, 'CharacterID', FILTER_VALIDATE_INT);
	}

	if(isset($_SESSION['UserID']))
	{
		$UserID = $_SESSION['UserID'];
	}

	if(isset($_FILES['image']['name']))
	{
		$image = $_FILES['image']['name'];
	}
	else
	{
		$image = null;
	}

	if(isset($_POST['command']))
    {
	    $command = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	if($_POST['Content'] === "" || $_POST['CharacterID'] === "")
	{
		//This part of the code makes sure the rest of the code doesn't exicute if the content or title are empty.
	}	
	else
	{
		if(isset($_POST['command']))
	    {
		switch (strtoupper($command)) {
			case "INSERT":
				$query = "".strtoupper($command)." INTO `reviews` (Content,UserID,CharacterID,images) VALUES (:Content,:UserID,:CharacterID,:image)";
				break;
			case "UPDATE":
				$query = "".strtoupper($command)." reviews SET Content=:Content WHERE ReviewID = :ReviewID";
				break;
			case "DELETE":
				$query = "".strtoupper($command)." FROM reviews WHERE ReviewID=:ReviewID";
					$statement = $db->prepare($query);
					$statement->bindValue(':ReviewID', $ReviewID);
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

				if(isset($_SESSION['UserID'])){
				$statement->bindValue(':UserID', $UserID);
				}   

				if(isset($_POST['Content'])){
		        $statement->bindValue(':Content', $Content);
		    	}

		        if(isset($_POST['CharacterID'])){
		        $statement->bindValue(':CharacterID', $CharacterID);
		   		 
		   		 }

		   		 if(isset($_FILES['image']['name'])){
		         $statement->bindValue(':image', $image);
		   		 
		   		 }

		   	if(isset($statement)){
		        $statement->execute();
		    }
		    header("Location: show.php?id=$CharacterID");
		
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