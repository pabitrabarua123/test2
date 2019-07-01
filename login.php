<?php

session_start();
if(isset($_SESSION["username"]) && !isset($_GET['firstLogin'])) {
    header("Location: /mounty");
}else{ ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

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
            <a class="nav-link" id="register" href="/mounty/register">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 text-center form">
        <form action="login-process.php" method="POST" class="myform">
          <h3 class="">Login</h3>
          <?php
             if(isset($_GET['login']) && $_GET['login'] == 'error') { ?>
                 <div class="error">Invalid username and password</div>
             <?php } ?>
          <div class="form-group">
             <input type="text" class="form-control" placeholder="Username" name="username">
          </div>
          <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" name="password">
          </div>
          <button type="submit" class="btn btn-success">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div id="welcome" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p>Congratulation .... you are successfully registered. Please login and go to chat room.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default cong" data-dismiss="modal">Ok</button>
      </div>
    </div>

  </div>
</div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <?php 
  if(isset($_GET['firstLogin'])){ ?>
    <script type="text/javascript">
      $(window).on('load',function(){
        $('#welcome').modal('show');
    });
    </script>
<?php } ?>

</body>

</html>

<?php } ?>