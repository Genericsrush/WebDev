<?php
  include('connect.php');
  require('loggedin.php');

  $privilege = 1;

  if (isset($_SESSION['priv'])) {
    $privilege = $_SESSION['priv'];
  }

  if ($privilege != 5) {
    header('Location: index.php');
  }

  $selectPost = "SELECT UserID,Name,Privilege FROM users";
  $result = $db->query($selectPost);
  
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
        <header>
            <h1><a href="main.php">BattleBudz</a></h1>
        </header> 
<nav>
    <a href="main.php">Home</a>
    <a href="create.php" <?php if(!($privilege > 1)):?> style="display:none"<?php endif ?>>New Post</a>
    <a href="logout.php" class='active' <?php if(!($privilege > 1)):?> style="display:none"<?php endif ?>>Logout</a>
    <a href="userTable.php" <?php if($privilege != 5):?> style="display:none"<?php endif ?>>Users</a>
</nav>
<content>
  <?php foreach($result as $row):?>
  <form action="process_user.php" method="POST">
    <fieldset>
      <legend>Modify Users</legend>
        <label for="UserID">UserID</label>
        <input name="UserID" id="UserID" value="<?=$row['UserID']?>" readonly/>

        <label for="Name">Username</label>
        <input name="Name" id="Name" value="<?=$row['Name']?>" />

        <label for="Privilege">Privilege</label>
        <input name="Privilege" id="Privilege" value="<?=$row['Privilege']?>"/>

        <input type="submit" name="command" value="Update" />
        <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this user?')" />
    </fieldset>
  </form>
<?php endforeach?>
</content>
    </div>
</body>
</html>