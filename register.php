<?php

session_start();
if(isset($_SESSION["username"])) {
    header("Location: /mounty");
}else{ ?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

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
            <a class="nav-link" id="register" href="/mounty/login">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 text-center form">
       
         <form action="reg-process.php" method="POST" class="myform">
          <h3 class="">Register</h3>
          <?php if(isset($_GET['userExist']) && $_GET['userExist'] == 'true') { ?>
            <div class="error">User exist with same username or email</div>
          <?php } ?>
          <div class="form-group">
              <input type="text" class="form-control" name="name" placeholder="Full Name" required>
          </div>
          <div class="form-group">
             <input type="text" class="form-control" name="username" placeholder="Username" required>
          </div>
          <div class="form-group">
             <input type="email" class="form-control" name="email" placeholder="Email address" required>
          </div>
          <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
          <div class="form-group">
             <input type="tel" pattern="[789][0-9]{9}" class="form-control" name="phone" placeholder="Phone No" required>
          </div>
          <button type="submit" class="btn btn-success">Register</button>
        </form>
        
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php } ?>