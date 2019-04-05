<?php
  include('connect.php'); 
  require('loggedin.php');

  $privilege = 1;

  if (isset($_SESSION['priv'])) {
    $privilege = $_SESSION['priv'];
  }

  if (!($privilege > 1)) {
    header('Location: index.php');
  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BattleBudz</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="main.php">BattleBudz</a></h1>
        </div> 
<nav>
    <a href="main.php">Home</a>
    <a href="create.php" <?php if(!($privilege > 1)):?> style="display:none"<?php endif ?>>New Post</a>
    <a href="logout.php" class='active' <?php if(!($privilege > 1)):?> style="display:none"<?php endif ?>>Logout</a>
    <a href="userTable.php" <?php if($privilege != 5):?> style="display:none"<?php endif ?>>Users</a>
</nav>
<div id="all_blogs">
  <form action="process_user.php" method="POST">
    <fieldset>
      <legend>Create Character</legend>
        <label for="Name">Name</label>
        <input name="Name" id="Name"/>

        <label for="Password">Password</label>
        <input name="Password" id="Password"/>

        <label for="Privilege">Privilege</label>
        <input name="Privilege" id="Privilege"/>

        <input type="submit" name="command" value="Insert" />
    </fieldset>
  </form>
</div>
    </div>
</body>
</html>