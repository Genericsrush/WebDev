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

  $selectReviews = "SELECT CharacterID, ReviewID, Name, Content , images
  FROM reviews R JOIN users U ON (R.UserID = U.UserID)
  WHERE ReviewID = ".$id."";
  $result = $db->query($selectReviews);
  
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
  <form action="process_comment.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>Edit Comment</legend>
      <?php foreach($result as $row):?>

        <input type="hidden" name="ReviewID" value="<?=$id?>"/>

        <input type="hidden" name="CharacterID" value="<?=$row['CharacterID']?>"/>

        <label for="Content">Comment</label>
        <input name="Content" id="Content" value="<?=$row['Content']?>" />

        <input type="file" name="image"/>

        <input type="submit" name="command" value="Update" />
        <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
      </p>
    <?php endforeach?>
    </fieldset>
  </form>
</div>
    </div>
</body>
</html>