<?php     
session_start();
if(!isset($_SESSION["username"])) {
    header("Location: /mounty/login");
}else{ require('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Mounty Outdoor Adventure</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="style.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="/"><img src="https://www.mounty.co/images/svg/logo.svg?v=1.1.2" alt="Mounty" class="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/mounty/logout" id="logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-center align-center">
        <h1 class="mt-5 myh">Welcome <?php echo '<span>'.$_SESSION["name"].'</span>'; ?></h1>
        <div id="chatbox" class="row">
          <div id="sender" class="col-md-3">
            <?php
              $current_user = $_SESSION['user_id'];
              $sql = "SELECT id, name FROM user WHERE id != '$current_user'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                $count = 0;
                while($row = $result->fetch_assoc()) { 
                  if ($count == 0) {
                    $firstChat = $row['id'];
                    $firstChatName = $row['name'];
                  } $count++
                  ?>
                   <div class="chat_with <?php if($firstChat == $row['id']){ echo 'active'; }?>" data-id="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></div>    
             <?php  }
             }
            ?>
          </div>
          <div id="messages" class="col-md-9">
            <div class="chat_title"><?php echo 'Chat with <b id="chat_with_name">'.$firstChatName.'</b>'; ?></div>
            <div id="message-body">
              <?php
              $sql = "SELECT * FROM chat WHERE ( from_user_id = '$firstChat' AND to_user_id = '$current_user') OR ( from_user_id = '$current_user' AND to_user_id = '$firstChat')";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { ?>
                    <div class="message <?php if($row['from_user_id'] == $current_user){ echo 'right';}else{ echo 'left';}?>"><?php echo $row['message'];?><br><span class="time_m" title="<?php echo $row['time'].'Z'; ?>"></span></div>
                <?php }
              }else{
                echo '<div class="message nomessage" style="margin-top: 10%;">No message</div>';
              }
            ?>
            </div>
            <div id="message-body-new">
              <div class="preloader-chat" style="display: none;">
                <div class="cssload-speeding-wheel"><img src="img/spin.gif"></div>
              </div>
            </div>
            <div id="reply">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <textarea class="form-control reply-message" rows="1"></textarea>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <button type="button" class="btn btn-warning reply" data-user="<?php echo $firstChat; ?>" >Send</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <audio id="myAudio">
          <source src="music/beep.ogg" type="audio/ogg">
          <source src="music/beep.mp3" type="audio/mpeg">
          Your browser does not support the audio element.
        </audio>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript">
    var current_user = <?php echo $current_user;?>;
    <?php
        $sql = "SELECT MAX(id) AS lastID FROM chat WHERE ( from_user_id = '$firstChat' AND to_user_id = '$current_user') OR ( from_user_id = '$current_user' AND to_user_id = '$firstChat') ORDER BY id DESC LIMIT 1";

        $last_message = $conn->query($sql);
        $last_message1 = $last_message->fetch_assoc();
    ?>
    var last_message_id = <?php if($last_message1['lastID']){ echo $last_message1['lastID']; }else{ echo 1;} ?>;
  </script>
  <script src="js/jquery.timeago.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(".time_m").timeago();
      //messgebody scroll bottom
      var objDiv = document.getElementById("message-body");
      objDiv.scrollTop = objDiv.scrollHeight;
    });
  </script>
  <script type="text/javascript" src="js/main.js"></script>

</body>

</html>
<?php } ?>