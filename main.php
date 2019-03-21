<?php 
	include('connect.php');

  	$selectPosts = "SELECT CharacterID,Name,HP,Mana,DateAdded AS timeStamp FROM `character` ORDER BY CharacterID DESC LIMIT 5";
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
            <h1><a href="index.php">BattleBudz</a></h1>
        </div> 
<ul id="menu">
    <li><a href="index.php" class='active'>Home</a></li>
    <li><a href="create.php" >New Post</a></li>
</ul> 
<div id="content">
  <?php foreach($result as $key):?>
      <div class="blog_post">
      <h2><a href="show.php?id=<?=$key['CharacterID']?>"><?=$key['Name']?></a></h2>
      <p>
        <small>
          <?=$key['timeStamp']?> -
          <a href="edit.php?id=<?=$key['CharacterID']?>">edit</a>
        </small>
      </p>
      <div class='character_content'>
        <p>HP: <?=$key['HP']?>/30<p>
        <p>Mana: <?=$key['Mana']?>/30<p>
        <p>HP: <?=$key['HP']?>/30<p>
          <a href="show.php?id=<?=$key['CharacterID']?>">Read more</a>
      </div>
    </div>
  <?php endforeach?>
        </div>
    </div> 
 </body>
 </html>