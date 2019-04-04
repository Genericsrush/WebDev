<?php 
  session_start();
	$loginFailed = false;

	if (isset($_GET['loginFailed'])) {
		$loginFailed = filter_input(INPUT_GET,'loginFailed', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
	if(isset($_SESSION['username'])){
		header('location: main.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php if ($loginFailed):?>
		<script type='text/javascript'>alert('LOGIN FAILED: Invalid Login Credentials')</script>
	<?php endif?>
</head>
<body>
	<h1>BattleBudz</h1>
	<form action="authenticateLogin.php" method="POST">
		<fieldset>
			<label for="username">Username</label>
			<input type="text" name="username" placeholder="Username" required>
			<label for="password">Password</label>
			<input type="password" name="password" placeholder="Password" required>
			<button type="submit">Submit</button>
			<p>Not a User? <a href="createUser.php">Register</a></p>		
		</fieldset>
	</form>
</body>
</html>