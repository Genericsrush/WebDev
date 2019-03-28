<?php
  include('connect.php'); 
  require('loggedin.php');
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
    <li><a href="logout.php" >Logout</a></li>
    <li><a href="create.php" >New Post</a></li>
</ul>
<div id="all_blogs">
  <form action="process_post.php" method="POST">
    <fieldset>
      <legend>Create Character</legend>
      <p>
        <label for="Name">Name</label>
        <input name="Name" id="Name"/>
      </p>
      <p>
        <label for="Class">Class</label>
        <input name="Class" id="Class"/>
      </p>
      <p>
        <label for="HP">HP</label>
        <input name="HP" id="HP"/>/30
      </p>
      <p>
        <label for="Mana">Mana</label>
        <input name="Mana" id="Mana"/>/30
      </p>
      <p>
        <label for="Attack">Attack</label>
        <input name="Attack" id="Attack"/>/30
      </p>
      <p>
        <label for="Defense">Defense</label>
        <input name="Defense" id="Defense"/>/30
      </p>
      <p>
        <input type="submit" name="command" value="Insert" />
      </p>
    </fieldset>
  </form>
</div>
    </div>
</body>
</html>