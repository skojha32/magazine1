<?php 
require "session.php"; 
?>
<?php
  function test_input($data)
  {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }
 if(isset($_POST['sbmt']))
 {
  $uid = $_POST['uid'];
  $fname = test_input($_POST['fname']);
  $lname = test_input($_POST['lname']);
  $mname = test_input($_POST['mname']);
  $entrydate = test_input($_POST['entrydate']);
  //$conginitial = test_input($_POST['conginitial']);
  $designation = test_input($_POST['designation']);
  $hname = test_input($_POST['hname']);
  //$gender = test_input($_POST['gender']);
  //$oname = test_input($_POST['oname']);
  $congname = test_input($_POST['congname']);
  $cmobile =  test_input($_POST['cmobile']);
  $email = test_input($_POST['email']);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  //$phone = test_input($_POST['phone']);
  //$nationality = test_input($_POST['nationality']);
  $cstate  = test_input($_POST['cstate']);
  $ccity = test_input($_POST['ccity']);
  $caddress = test_input($_POST['caddress']);
  $cpin = test_input($_POST['cpin']);
  $type = test_input($_POST['type']);
  $comment = test_input($_POST['comment']);
  $startdate = test_input($_POST['startdate']);
  $enddate = test_input($_POST['enddate']);
  $paymethod = test_input($_POST['paymethod']);
  $comment1 = test_input($_POST['comment1']);
  $cdistrict = test_input($_POST['cdistrict']);
  //echo $uid."<br>".$fname."<br>".$mname."<br>".$lname."<br>".$entrydate."<br>".$conginitial."<br>".$designation."<br>".$hname."<br>".$gender."<br>".$oname."<br>".$congname."<br>".$cmobile."<br>".$email."<br>".$phone."<br>".$nationality."<br>".$cstate."<br>".$ccity."<br>".$caddress."<br>".$cpin."<br>".$type."<br>".$comment."<br>".$startdate."<br>".$enddate."<br>".$paymethod."<br>".$comment1."<br>".$cdistrict."<br>";
  
  
  if($fname =="" ||  $entrydate=="" || $cmobile=="" || $cstate == "" || $cdistrict == "" || $caddress == "" || $cpin == "" || $type == "" || $paymethod == "" || $startdate == "" || $enddate == ""   )
  {
     echo "<script type='text/javascript'>alert('Enter All the details Carefully')</script>";
     exit;
 }
	        //Validate e-mail
 if($email != '')
 {
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
     {
        echo "<script type='text/javascript'>alert('Invalid Email')</script>";
        exit;
     }
 }
 
 if($email == '')
 {
     $email = 'null@'.date("Y-m-d h:i:sa").".com";
     $email = filter_var($email, FILTER_SANITIZE_EMAIL);
 }
 
 // Validate Name and Address
 if(is_numeric($fname) || is_numeric($mname) || is_numeric($lname) || is_numeric($hname) || is_numeric($congname) || is_numeric($cstate) || is_numeric($ccity) || is_numeric($caddress) || is_numeric($cdistrict))
 {

  echo "<script type='text/javascript'>alert('Invalid Name or Address')</script>";
  exit;

}
//Validate Pin
if(!is_numeric($cpin) || strlen($cpin) <> 6) 
{

 echo "<script type='text/javascript'>alert('Invalid PinCode')</script>";
 exit;
}
if($enddate < $startdate)
{

 echo "<script type='text/javascript'>alert('Invalid Subscription period')</script>";
 exit;

}	

		    //Validate Phone
if(!is_numeric($cmobile) || strlen($cmobile) <> 10)
{

 echo "<script type='text/javascript'>alert('Invalid Mobile Number')</script>";
 exit;

}

else
{
  
  if($uid == 0)
  { 


    $query =  mysqli_query($con,"INSERT INTO `userdetail`( `fname`, `mname`, `lname`, `designation`, `hname`, `congname`, `cmobile`, `email`, `cstate`, `cdistrict`, `ccity`, `caddress`, `cpin`, `entrydate`) VALUES ('$fname','$mname','$lname','$designation','$hname','$congname','$cmobile','$email','$cstate','$cdistrict','$ccity','$caddress','$cpin','$entrydate')");


    if($query)
    {
      $query = mysqli_query($con,"SELECT uid from `userdetail` where email='$email'");
      $uid_r = mysqli_fetch_assoc($query);
      $uid = $uid_r['uid'];
      $query = mysqli_query($con,"INSERT INTO `subscription`( `uid`, `type`, `paymethod`, `startdate`, `enddate`, `comment`,`comment1`) VALUES ($uid,'$type','$paymethod','$startdate','$enddate','$comment','$comment1')");
      if($query)
      {
       echo "<script type='text/javascript'>alert('User added Successfully')</script>";
				           
     }
     else
     {
         
      echo "<script type='text/javascript'>alert('New Record Failed')</script>";
     }

                
   }
   else
   {
       echo "<script type='text/javascript'>alert('New Record Failed')</script>";
               
  }
}
else
{
  
  $uquery =  mysqli_query($con,"UPDATE `userdetail` SET `fname` = '$fname',`mname` = '$mname',`lname` = '$lname',`designation` = '$designation',`hname` = '$hname',`congname` = '$congname',`cmobile` = '$cmobile',`email` = '$email',`cstate` = '$cstate',`cdistrict` = '$cdistrict',`ccity` = '$ccity',`caddress` = '$caddress',`cpin` = '$cpin' WHERE `uid` = '$uid'");
  if($uquery)
  {
    $uquery =  mysqli_query($con,"UPDATE `subscription` SET `type` = '$type',`paymethod` = '$paymethod',`startdate` = '$startdate',`enddate` = '$enddate',`comment` = '$comment',`comment1` = '$comment1' WHERE `uid` = '$uid'");
    if($uquery)
    {
      echo "<script type='text/javascript'>alert('User Detail Updated Successfully')</script>";
            
    }
    else
    {
      echo "<script type='text/javascript'>alert('Update Failed')</script>";
      echo mysqli_error($con);
    }
  }
  else
  {
    echo "<script type='text/javascript'>alert('Update Failed')</script>";
    echo mysqli_error($con);
  }


}

}
}
else
{
  $uid = $_POST['ids'];
  $query = mysqli_query($con, "DELETE FROM `subscription` WHERE `uid` = '$uid'");
  if($query)
  {
    $query = mysqli_query($con, "DELETE FROM `userdetail` WHERE `uid` = '$uid'");
    if($query)
    {
      echo "<script type='text/javascript'>alert('User Detail Deleted Successfully')</script>";
    }
    else
    {
      echo "<script type='text/javascript'>alert('Delete Failed')</script>";
      echo mysqli_error($con);
    }
  }
  else
  {
    echo "<script type='text/javascript'>alert('Delete Failed')</script>";
    echo mysqli_error($con);
  }
}
//Enable it once everything set
  echo "<script type='text/javascript'>window.location.assign('home.php')</script>";
//echo "Finish";
?>