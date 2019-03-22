<?php
  include('connect.php');
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
<ul id="menu">
    <li><a href="index.php" >Logout</a></li>
    <li><a href="create.php" >New Post</a></li>
</ul>
<div id="all_blogs">
  <form action="process_post.php" method="POST">
    <fieldset>
      <legend>Edit Charater</legend>
      <?php foreach($result as $row):?>
      <p>
        <label for="Name">Title</label>
        <input name="Name" id="Name" value="<?=$row['Name']?>" />
      </p>
      <p>
        <label for="Class">Class</label>
        <input name="Class" id="Class" value="<?=$row['Class']?>" />
      </p>
      <p>
        <label for="HP">HP</label>
        <input name="HP" id="HP" value="<?=$row['HP']?>"/>/30
      </p>
      <p>
        <label for="Mana">Mana</label>
        <input name="Mana" id="Mana" value="<?=$row['Mana']?>"/>/30
      </p>
      <p>
        <label for="Attack">Attack</label>
        <input name="Attack" id="Attack" value="<?=$row['Attack']?>"/>/30
      </p>
      <p>
        <label for="Defense">Defense</label>
        <input name="Defense" id="Defense" value="<?=$row['Defense']?>"/>/30
      </p>
      <p>
        <input type="hidden" name="id" value="<?=$row['id']?>" />
      <?php endforeach?>
        <input type="submit" name="command" value="Update" />
        <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
      </p>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2019 - No Rights Reserved
        </div> 
    </div>
</body>
</html>