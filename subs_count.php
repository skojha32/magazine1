<?php
require "session.php";
$query = mysqli_query($con, "SELECT count(*) FROM userdetail INNER JOIN subscription ON userdetail.uid = subscription.uid WHERE (DATE_FORMAT(subscription.enddate, '%Y-%m-%d') >= CURDATE())");
$count = mysqli_fetch_row($query);
$active = $count[0];
$query = mysqli_query($con, "SELECT count(*) FROM userdetail INNER JOIN subscription ON userdetail.uid = subscription.uid");
$count = mysqli_fetch_row($query);
$all = $count[0];
$query = mysqli_query($con, "SELECT count(*) FROM userdetail INNER JOIN subscription ON userdetail.uid = subscription.uid WHERE (DATE_FORMAT(subscription.enddate, '%Y-%m-%d') < CURDATE())");
$count = mysqli_fetch_row($query);
$inactive = $count[0];
$query = mysqli_query($con, "SELECT count(*) FROM userdetail INNER JOIN subscription ON userdetail.uid = subscription.uid WHERE subscription.enddate IS NULL");
$count = mysqli_fetch_row($query);
$today = $count[0];
?>