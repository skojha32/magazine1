<?php
// session_start();
require "config.php";
if(isset($_COOKIE['userNam']) && isset($_COOKIE['sessionVal'])){
  $uname = $_COOKIE['userNam'];
  $csessionid = $_COOKIE['sessionVal'];
  $delsession = mysqli_query($con, "UPDATE gateway SET sessionid=NULL WHERE username='$uname'");

if(!$delsession)
{
    echo "<script type='text/javascript'>alert('Something went Wrong! Logout unsuccessful')</script>";
}

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
else {
    echo "<script type='text/javascript'>alert('Something went Wrong! Logout unsuccessful')</script>";
}
}

// echo "<script type='text/javascript'>window.location.assign('login.php')</script>";
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="./img/img_1.png">
  <title>Login - Vachanam Balivediyil</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css'><link rel="stylesheet" href="./login_style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="styles_home.css" rel="stylesheet" />
  

</head>

<body>
  <style>
    body{
      min-height:100%;
  background:linear-gradient(0deg, rgba(104, 139, 254, 0.75), rgba(104, 139, 254, 0.75)), url('./img/bg-img/bck1.png');
  background-size:cover;
    }
    .form-text{
      padding: 10px 10px;
      margin-left:7%;
      margin-bottom: 2%;
      width:100%;
    }
    .form-text a{
      width:50%;
      color: grey;
      text-decoration: none;
      float: left;
      margin-bottom: 5%;
    }
  </style>

  
<!-- partial:index.partial.html -->
<!--<center><img src="./img/img_1.png" class="logo1" style="width: 100px;height: 100px;border-radius:50%;margin-top:5px;" alt=""/>-->
<!--<br><h1 style="color:white;font-size:50px;">VACHANAM BALIVEDIYIL</h1></center>-->
<!--<form class="modal-content" method="post" action="cookie.php">-->
<!--  <br>-->
  
  <div class="top_header_wrapper">
      <div class="containe container_items">
        <div class="img_left">
          <img src="img/img_1.png" />
        </div>
        <div class="head_content">
          <h1 class="heading">Vachanam</h1>
          <p class="sub_heading">
            Pastoral Initiative of CMI-Kottayam Province</p>
        </div>
        <div class="img_right">
          <img src="img/img_2.png" />
        </div>
      </div>
    </div>
  
<form method="post" action="cookie.php">
<div class="login" style="margin-top:5%;">
  <div class="form">
    <h2>Login</h2>
    
    <div class="form-field">
      <label for="login-mail"><i class="fa fa-user"></i></label>
      <input id="login-mail" type="text" name="uname" placeholder="Username" required>
      <svg>
        <use href="#svg-check" />
      </svg>
    </div>
    <div class="form-field">
      <label for="login-password"><i class="fa fa-lock"></i></label>
      <input id="login-password" type="password" name="password" placeholder="Password" pattern=".{6,}" required>
      <svg>
        <use href="#svg-check" />
      </svg>
    </div>
    
    
    <button type="submit" class="button" name="sbmt">
      <div class="arrow-wrapper">
        <span class="arrow"></span>
      </div>
      <p class="button-text">SIGN IN</p>
    </button>
  </div>
  <div class="finished">
    <svg>
      <use href="#svg-check" />
    </svg>
  </div>
</div>
</form>



<!-- //--- ## SVG SYMBOLS ############# -->
<!-- <svg style="display:none;">
  <symbol id="svg-check" viewBox="0 0 130.2 130.2">
    <polyline points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
  </symbol>
</svg> -->
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
