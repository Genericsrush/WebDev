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
    <a href="addUser.php" <?php if($privilege != 5):?> style="display:none"<?php endif ?>>Add User</a>
<nav> 
<div id="all_blogs">
  <form action="process_post.php" method="POST">
    <fieldset>
      <legend>Create Character</legend>
        <label for="Name">Name</label>
        <input name="Name" id="Name"/>

        <label for="Class">Class</label>
        <input name="Class" id="Class"/>

        <label for="HP">HP</label>
        <input name="HP" id="HP"/><p>/30</p>

        <label for="Mana">Mana</label>
        <input name="Mana" id="Mana"/><p>/30</p>

        <label for="Attack">Attack</label>
        <input name="Attack" id="Attack"/><p>/30</p>

        <label for="Defense">Defense</label>
        <input name="Defense" id="Defense"/><p>/30</p>

        <input type="submit" name="command" value="Insert" />
    </fieldset>
  </form>
</div>
    </div>
</body>
</html>