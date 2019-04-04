<?php
	Session_Start();

	$userExists = false;
	if(isset($_SESSION['username'])){
		header('location: main.php');
	}
	if(isset($_GET['userExists'])){
		$userExists = filter_input(INPUT_GET, 'userExists', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create</title>
</head>
<body>
	<h1>BattleBudz</h1>
	<form class="create" action="athenticateUserCreate.php" method="POST">
    <fieldset>
    	<?php if($userExists):?>
    		<p>* That Username is already taken</p>
    	<?php endif?>
    	<label for="username">Username</label>
    	<input type="text" name="username" placeholder="Username" required>

    	<label for="Email">Email</label>
    	<input type="email" name="Email" placeholder="example@domain.com" required>

    	<label for="username">Password</label>
        <input type="password" name="password" placeholder="Password" id="password" required>

        <label for="username">Confirm Password</label>
        <input type="password" placeholder="Confirm Password" id="confirm_password" required>

        <button type="submit" id="submit">Register</button>
        <p><a href="index.php">Home Page</a></p>
    </fieldset>
    <script type="text/javascript">
		var password = document.getElementById("password");
		var confirm_password = document.getElementById("confirm_password");

		document.getElementById("submit").addEventListener("click", function(event){
		  validatePassword();
		});

		function validatePassword(){
		  if(password.value != confirm_password.value) {
		    confirm_password.setCustomValidity("Passwords Don't Match");
		    event.preventDefault()
		  } else {
		    confirm_password.setCustomValidity("");
		  }
		}

		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script>
</form>
</body>
</html>