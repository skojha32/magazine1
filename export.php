<?php

require "session.php";

session_start();

if(!isset($_SESSION["Vachanamexport"]))
{
   	echo "<script type='text/javascript'>alert('Nothing To Export')</script>";
       echo "<script type='text/javascript'>window.close()</script>";
    exit;
}
 
$fileName = "Subscription_Report-" . date("d/m/y") . ".xls"; 
 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
header("Content-Type: application/vnd.ms-excel"); 

$data = $_SESSION["Vachanamexport"];
 
$flag = false; 
foreach($data as $row) { 
    if(!$flag) { 
        echo implode("\t", array_keys($row)) . "\n"; 
        $flag = true; 
    }  
    echo implode("\t", array_values($row)) . "\n"; 
} 
 
exit;
?>