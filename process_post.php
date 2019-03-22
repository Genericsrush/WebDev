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

	if(isset($_POST['Class']) && $_POST['Class'] != "")
    {
	    $Class = filter_input(INPUT_POST, 'Class', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	if(isset($_POST['HP']) && $_POST['HP'] != "")
    {
	    $HP = filter_input(INPUT_POST, 'HP', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
	else
	{
		$HP = 0;
	}

	if(isset($_POST['Mana']) && $_POST['Mana'] != "")
    {
	    $Mana = filter_input(INPUT_POST, 'Mana', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
	else
	{
		$Mana = 0;
	}

	if(isset($_POST['Attack']) && $_POST['Attack'] != "")
    {
	    $Attack = filter_input(INPUT_POST, 'Attack', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
	else
	{
		$Attack = 0;
	}

	if(isset($_POST['Defense']) && $_POST['Defense'] != "")
    {
	    $Defense = filter_input(INPUT_POST, 'Defense', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
	else
	{
		$Defense = 0;
	}

	if(isset($_POST['command']))
    {
	    $command = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	if(isset($_POST['id']))
	{
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	if($_POST['Name'] === "" || $_POST['Class'] === "")
	{
		//This part of the code makes sure the rest of the code doesn't exicute if the content or title are empty.
	}	
	else
	{
		if(isset($_POST['command']))
	    {
		switch (strtoupper($command)) {
			case "INSERT":
				$query = "".strtoupper($command)." INTO `character`(Name, Class,HP,Mana,Attack,Defense) VALUES (:Name,:Class,:HP,:Mana,:Attack,:Defense)";
				break;
			case "UPDATE":
				$query = "".strtoupper($command)." `character` SET Name=:Name, Class=:Class,HP=:HP,Mana=:Mana,Attack=:Attack,Defense=:Defense WHERE CharacterID = :id";
				break;
			case "DELETE":
				$query = "".strtoupper($command)." FROM `character` WHERE CharacterID=:id";
					$statement = $db->prepare($query);
					$statement->bindValue(':id', $id);
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

				if(isset($_POST['id'])){
				$statement->bindValue(':id', $id);
				}   

				if(isset($_POST['Name'])){
		        $statement->bindValue(':Name', $Name);
		    	}

		        if(isset($_POST['Class'])){
		        $statement->bindValue(':Class', $Class);
		   		 }
		   		 if(isset($_POST['HP'])){
		        $statement->bindValue(':HP', $HP);
		   		 }
		   		 if(isset($_POST['Mana'])){
		        $statement->bindValue(':Mana', $Mana);
		   		 }
		   		 if(isset($_POST['Attack'])){
		        $statement->bindValue(':Attack', $Attack);
		   		 }
		   		 if(isset($_POST['Defense'])){
		        $statement->bindValue(':Defense', $Defense);
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