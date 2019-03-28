<?php 
	include('connect.php');
  require('loggedin.php');
  
  	$selectPosts = "SELECT CharacterID,Class,Name,HP,Mana,Attack,Defense,DateAdded AS timeStamp FROM `character` ORDER BY CharacterID DESC";
  	$result = $db->query($selectPosts);

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>BattleBudz</title>
 </head>
 <body>
 <div id="wrapper">
        <div id="header">
            <h1><a href="main.php">BattleBudz</a></h1>
        </div> 
<ul id="menu">
    <li><a href="logout.php" class='active'>Logout</a></li>
    <li><a href="create.php" >New Post</a></li>
</ul> 
<div id="content">
  <?php foreach($result as $key):?>
      <div class="blog_post">
      <h2><a href="show.php?id=<?=$key['CharacterID']?>"><?=$key['Name']?></a></h2>
      <h3><?=$key['Class']?></h3>
      <p>
        <small>
          <?=$key['timeStamp']?> -
          <a href="edit.php?id=<?=$key['CharacterID']?>">edit</a>
        </small>
      </p>
      <div class='character_content'>
        <p>HP: <?=$key['HP']?>/30<p>
        <p>Mana: <?=$key['Mana']?>/30<p>
        <p>Attack: <?=$key['Attack']?>/30<p>
		<p>Defense: <?=$key['Defense']?>/30<p>
          <a href="show.php?id=<?=$key['CharacterID']?>">Read more</a>
      </div>
    </div>
  <?php endforeach?>
        </div>
    </div> 
 </body>
 </html>