<?php
  include('connect.php');

  $privilege = 1;

  if (isset($_SESSION['priv'])) {
    $privilege = $_SESSION['priv'];
  }

  $id = filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);

  $selectPost = "SELECT CharacterID,Class,Name,HP,Mana,Attack,Defense,DateAdded AS timeStamp FROM `character`
  WHERE CharacterID = ".$id." ORDER BY CharacterID DESC LIMIT 1";
  $result = $db->query($selectPost);
  
  $selectReviews = "SELECT ReviewID, Name,Content 
  FROM reviews R JOIN users u ON (R.UserID = U.UserID)
  WHERE CharacterID = ".$id." ORDER BY ReviewID DESC LIMIT 5";
  $result2 = $db->query($selectReviews);

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
                <?php foreach($result as $row):?>
                <h2><?=$row['Name']?></h2>
                <h3>Class: <?=$row['Class']?></h3>
                <p>HP: <?=$row['HP']?>/30</p>
                <p>Mana: <?=$row['Mana']?>/30</p>
                <p>Attack: <?=$row['Attack']?>/30</p>
                <p>Defense: <?=$row['Defense']?>/30</p>
              <?php endforeach?>
          </div>

          <div id="comments">
            <h2>Comment Section</h2>
              <?php foreach($result2 as $row):?>
                <h4><?=$row['Name']?></h4>
                <p><?=$row['Content']?></p>
              <?php endforeach?>
          </div>
    </div>
</body>
</html>