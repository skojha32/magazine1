<?php require "session.php"; ?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="./img/bg-img/logo.png">
  <title>New Admin Registration - </title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css'><link rel="stylesheet" href="./login_style.css">

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
<form class="modal-content" method="post" action="add_admin.php">
<div class="login">
  <div class="form">
    <h2>New Admin Registration</h2>
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
      <p class="button-text">Add admin</p>
    </button>
  </div>
  <div class="finished">
    <svg>
      <use href="#svg-check" />
    </svg>
  </div>
</div>
</form>

<?php
    if(isset($_POST['sbmt']))
    {
        $uname = $_POST['uname'];
        $paswd = $_POST['password'];
        
        if($uname=="" || $paswd=="")
    {
      echo "<script type='text/javascript'>alert('Enter the username and password')</script>";
      echo "<script type='text/javascript'>window.location.assign('add_admin.php')</script>";
        }
        else
        {
            $hash = password_hash($paswd, PASSWORD_DEFAULT);
            $query = mysqli_query($con,"Insert into gateway(username,password) values('$uname','$hash')");
            if($query)
            {
                echo "<script type='text/javascript'>alert('Admin Added Successfully')</script>";
                echo "<script type='text/javascript'>window.location.assign('add_admin.php')</script>";
            }
            else
            {
                echo "<script type='text/javascript'>alert('Unable to Add admin. Please Try Again')</script>";
                echo "<script type='text/javascript'>window.location.assign('add_admin.php')</script>";
            }
        }
    }
?>
<!-- //--- ## SVG SYMBOLS ############# -->
<svg style="display:none;">
  <symbol id="svg-check" viewBox="0 0 130.2 130.2">
    <polyline points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
  </symbol>
</svg>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
