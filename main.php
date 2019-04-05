<?php 
	include('connect.php');
  require('loggedin.php');

  $privilege = 2;

  if (isset($_SESSION['priv'])) {
    $privilege = $_SESSION['priv'];
  }

  $orderBy = '';
  $firstTime = '';

  if(isset($_GET['type'])){
    $orderBy = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $selectPosts = "SELECT CharacterID,Class,Name,HP,Mana,Attack,Defense,DateAdded AS timeStamp FROM `character` ORDER BY ".$orderBy."";
  }
  else{
    $orderBy = 'CharacterID';
    $selectPosts = "SELECT CharacterID,Class,Name,HP,Mana,Attack,Defense,DateAdded AS timeStamp FROM `character` ORDER BY ".$orderBy." DESC";
  }
  $result = $db->query($selectPosts);

  if(isset($_GET['userCreated'])){
    $userCreated = filter_input(INPUT_GET, 'userCreated', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>BattleBudz</title>
  <?php if(isset($userCreated)):?>
    <?php if ($userCreated):?>
      <script type='text/javascript'>alert('New User created: Welcome!')</script>
    <?php endif?>
  <?php endif?>
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
<nav> 

<content>
  <h3>Order By:</h3>
  <h4><a href="main.php?type=Name">Name</a></h4>
  <h4><a href="main.php?type=Class">Class</a></h4>
  <h4><a href="main.php?type=DateAdded DESC">Date Added</a></h4>
  <?php foreach($result as $key):?>
      <div class="blog_post">
      <h2><a href="show.php?id=<?=$key['CharacterID']?>"><?=$key['Name']?></a></h2>
      <h3><?=$key['Class']?></h3>
      <p>
        <small>
          <?=$key['timeStamp']?> -
          <a href="edit.php?id=<?=$key['CharacterID']?>" <?php if(!($privilege > 1)):?> style="display:none"<?php endif ?>>edit</a>
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
        </content>
    </div> 
    <footer>

    </footer>
 </body>
 </html>