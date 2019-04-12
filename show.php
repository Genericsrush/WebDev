<?php
  include('connect.php');

  $privilege = 1;

  session_start();

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  if (isset($_SESSION['priv'])) {
    $privilege = $_SESSION['priv'];
  }

  if(isset($_SESSION['UserID'])){
    $UserID = $_SESSION['UserID'];
  }

  $id = filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);

  $selectPost = "SELECT CharacterID,Class,Name,HP,Mana,Attack,Defense,DateAdded AS timeStamp FROM `character`
  WHERE CharacterID = ".$id." ORDER BY CharacterID DESC LIMIT 1";
  $result = $db->query($selectPost);
  
  $selectReviews = "SELECT R.UserID AS UserID, ReviewID, Name, Content 
  FROM reviews R JOIN users U ON (R.UserID = U.UserID)
  WHERE CharacterID = ".$id." ORDER BY ReviewID DESC LIMIT 5";
  $result2 = $db->query($selectReviews);
  $count = $result2->rowCount();

  if(isset($_POST) & !empty($_POST)){
    if($_POST['captcha'] == $_SESSION['code']){
      echo "correct captcha";
    }else{
      echo "Invalid captcha";
    }
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
            <?php if ($count > 0):?>
              <?php foreach($result2 as $row):?>
                <h4><?=$row['Name']?></h4>
                <?php if($row['UserID'] = $UserID || $privilege >= 4):?>
                  <p><a href="editComment.php">edit</a></p>
                <?php endif?>
                <p><?=$row['Content']?></p>
              <?php endforeach?>
              <?php else :?>
                <p>No comments are available for this page.</p>
             <?php endif?>
          </div>

          <?php if ($privilege >= 2):?>
            <form action="process_comment.php" method="POST" id="form" enctype="multipart/form-data">
              <fieldset>
                <input type="hidden" name="CharacterID" value="<?php echo $id?>">
                <label for="comment">Comment</label>
                <input id="comment" type="textarea" name="Content" />
                <!-- <img src="generate.php" width="120" height="30" border="1" alt="CAPTCHA"/></p>
                <p><input type="text" size="6" maxlength="5" name="captcha" value="" id="captcha"><br>
                <small>copy the digits from the image into this box</small></p> -->
                <input type="file" name="image">
                <input type="submit" name="command" value="insert" id="submit"/>
              </fieldset>
            </form>
          <?php endif?>

    </div>
    <!-- <script type="text/javascript">
      var captcha = document.getElementById("captcha");

      document.getElementById("submit").addEventListener("click", function(event){
      checkForm()};

      function checkForm(){
        if(length(captcha) != 5) {
        alert('Incorrect captcha length!');
        captcha.focus();
        event.preventDefault();
        }
      }
    </script> -->
</body>
</html>