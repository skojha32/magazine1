<?php 
require "config.php"; 
//Authentication Code
if(isset($_COOKIE['userNam']) && isset($_COOKIE['sessionVal'])){
    $uname = $_COOKIE['userNam'];
    $csessionid = $_COOKIE['sessionVal'];
}
else{
    echo "<script type='text/javascript'>alert('Something went wrong redirecting to login page!')</script>";
    echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
}

$fetchsess = mysqli_query($con,"SELECT sessionid FROM gateway WHERE username = '$uname'");
$dbsessarray = mysqli_fetch_assoc($fetchsess);
$dbsession = $dbsessarray['sessionid'];
if($csessionid != $dbsession)
{
  echo "<script type='text/javascript'>alert('Something went wrong redirecting to login page!')</script>";
  echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
}

?>