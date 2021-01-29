<?php
   require "session.php";

   session_start();
?>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="./img/bg-img/logo.png">
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  font-size: 11px;	
  float: left;
  width: 33%;
  margin-right: 1px;
  margin-bottom: 3px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

</style>
</head>
<body>
<?php 

   if(!isset($_SESSION["Vachanamdata"]))
   {
   	echo "<script type='text/javascript'>alert('Nothing To Print')</script>";
   	echo "<script type='text/javascript'>window.close()</script>";
   }

   $dom = new domDocument; 
    
   $dom->loadHTML($_SESSION["Vachanamdata"]); 
   
   $dom->preserveWhiteSpace = false; 
   
   $tables = $dom->getElementsByTagName('table'); 
   
   $rows = $tables->item(0)->getElementsByTagName('tr');
   $count = 1;

  
   $report = array();
   
   foreach ($rows as $row) {
      $cols = $row->getElementsByTagName('td');
      
      if($count != "1")
      {
      	array_push($report, array($cols->item(1)->nodeValue,$cols->item(2)->nodeValue,$cols->item(3)->nodeValue,$cols->item(4)->nodeValue,$cols->item(5)->nodeValue,$cols->item(6)->nodeValue,$cols->item(7)->nodeValue,$cols->item(8)->nodeValue)); 
      }else
      {
      	$count = $count + 1;
      }
    }

    echo "<div class='row'>";

    $count = 0;

    foreach ($report as $element) {
  
         if($count == 3)
         {
         	echo "</div>";
         	echo "<div class='row'>";
         	$count = 0;
         }
         echo "<div class='column'>";
          echo "<p>".$element[0]."<br>".$element[3]."<br>".$element[5].",".$element[4].",".$element[6]."<br>"."Pincode:".$element[7]."<br>"."Mob:".$element[2]."</p>";
          echo "</div>";
          $count = $count + 1;
    	
    }
    if($count != 3)
    {
    	echo "</div>";
    }
    echo "<script>window.print()</script>";
   
?> 
</body>
</html>