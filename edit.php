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

  $id = filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);

  $selectPost = "SELECT CharacterID,Class,Name,HP,Mana,Attack,Defense,DateAdded AS timeStamp FROM `character`
  WHERE CharacterID = ".$id." ORDER BY CharacterID DESC LIMIT 1";
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
  <form action="process_post.php" method="POST">
    <fieldset>
      <legend>Edit Charater</legend>
      <?php foreach($result as $row):?>

        <label for="Name">Title</label>
        <input name="Name" id="Name" value="<?=$row['Name']?>" />

        <label for="Class">Class</label>
        <input name="Class" id="Class" value="<?=$row['Class']?>" />

        <label for="HP">HP</label>
        <input name="HP" id="HP" value="<?=$row['HP']?>"/>/30

        <label for="Mana">Mana</label>
        <input name="Mana" id="Mana" value="<?=$row['Mana']?>"/>/30

        <label for="Attack">Attack</label>
        <input name="Attack" id="Attack" value="<?=$row['Attack']?>"/>/30

        <label for="Defense">Defense</label>
        <input name="Defense" id="Defense" value="<?=$row['Defense']?>"/>/30

        <input type="hidden" name="id" value="<?=$row['CharacterID']?>" />
      <?php endforeach?>
        <input type="submit" name="command" value="Update" />
        <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
      </p>
    </fieldset>
  </form>
</div>
    </div>
</body>
</html>