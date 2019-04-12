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

	if(isset($_POST['captcha']))
	{
		$captcha = filter_input(INPUT_POST, 'captcha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	if(isset($_POST['CharacterID']))
	{
		$CharacterID = filter_input(INPUT_POST, 'CharacterID', FILTER_VALIDATE_INT);
	}

	if(isset($_SESSION['UserID']))
	{
		$UserID = $_SESSION['UserID'];
	}

	if(strlen($_FILES['image']['name'])>0)
	{
		$image = $_FILES['image']['name'];
	    function file_upload_path($original_filename, $upload_subfolder_name = 'images') {
	       $current_folder = dirname(__FILE__);

	       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
	       
	       return join(DIRECTORY_SEPARATOR, $path_segments);
	    }
	    
	    function file_is_an_image($temporary_path, $new_path) {
	        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
	        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
	        
	        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
	        
	        $actual_mime_type        = $_FILES['image']['type'];

	        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
	        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
	        
	        return $file_extension_is_valid && $mime_type_is_valid;
	    }
	    
	    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
	    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

	    if ($image_upload_detected) { 
	        $image_filename        = $_FILES['image']['name'];
	        $temporary_image_path  = $_FILES['image']['tmp_name'];
	        $new_image_path        = file_upload_path($image_filename);
	        if (file_is_an_image($temporary_image_path, $new_image_path)) {
	            move_uploaded_file($temporary_image_path, $new_image_path);
	        }
	        else{
	        	$_FILES['image']['name'] = null;
	        	$image = null;
	        }
	    }

	}
	else
	{
		$image = null;
	}

	if(isset($_POST['command']))
    {
	    $command = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	if($captcha != $_SESSION['code'])
	{
		$_SESSION['Content'] = $Content;
		header("Location: show.php?id=$CharacterID");
	}	
	else
	{
		$_SESSION['Content'] = '';
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
					header("Location: show.php?id=$CharacterID");
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
		   		 else{
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