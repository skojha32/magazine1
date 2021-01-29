<?php
// session_start();
require "session.php";
$uname = $_COOKIE['userNam'];
$delsession = mysqli_query($con, "UPDATE gateway SET sessionid=NULL WHERE username='$uname'");

if ($delsession)
{
    echo "<script type='text/javascript'>alert('Logout successful')</script>";
    echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
}
else
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

// echo "<script type='text/javascript'>window.location.assign('login.php')</script>";
?>