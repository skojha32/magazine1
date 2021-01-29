<?php 
require "subs_count.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <!-- Title -->
  <title>Vachanam Balivediyil</title>

  <!-- Favicon -->
  <link rel="icon" href="./img/bg-img/logo.png">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="style.css">

</head>

<body>

	
  <!-- Preloader -->
  <div class="preloader d-flex align-items-center justify-content-center">
    <div class="lds-ellipsis">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <style>
    .btn1{
      padding: 10px 10px;
      border: none;
      border-radius: 4px;
      transition-duration: 0.4s;
      background-color: #ff7902;
      color: white;
    }
    .btn1:hover {
      background-color: #688bfe;
      color: white;

    }

  </style>
  <!-- ##### Header Area Start ##### -->
  <header class="header-area">
    <!-- Navbar Area -->
    <div class="pixel-main-menu" id="sticker">
      <div class="classy-nav-container breakpoint-off">
        <div class="container-fluid">
          <!-- Menu -->
          <nav class="classy-navbar justify-content-between" id="pixelNav">

            <!-- Nav brand -->
            <a href="home.php" class="nav-brand" style="color:white;"><img src="./img/bg-img/logo.png" style="width: 65px;height: 60px;border-radius:50%;margin-right:10px;" alt="">Vachanam Balivediyil</a>

            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
              <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>

            <!-- Menu -->
            <div class="classy-menu">

              <!-- Close Button -->
              <div class="classycloseIcon">
                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
              </div>

              <!-- Nav Start -->
              <div class="classynav">
                <ul>
                  
                  <li><a href="#">Transactions</a>
                    <ul class="dropdown">
                      <li><a href="home.php">Subscription</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Reports</a>
                    <ul class="dropdown">
                      <li><a href="report.php">Subscription Report</a></li>
                    </ul>
                  </li>
		  <li><a href="import.php" target="_blank">Import</a></li>
                  <li><a href="#">Settings</a>
                    <ul class="dropdown">
                      <li><a href="changepasswd.php">Change Password</a></li>
                      <li><a href="add_admin.php">Add Admin</a></li>
                    </ul>
                  </li>
                </ul>

                <!-- Top Social Info -->
                <a href='logout.php'>
                  <div class="top-social-info ml-5">
                    <button type="button" class="btn1">
                      <span class="glyphicon glyphicon-log-out"></span> Log out
                    </button>
                  </div>
                </a>
              </div>
              <!-- Nav End -->
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ##### Header Area End ##### -->

  <!-- ##### Breadcrumb Area Start ##### -->
  <section class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/8.jpg);">
    <div class="container-fluid h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <div class="breadcrumb-content">
            <h2>Subscription</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ##### Breadcrumb Area End ##### -->
  <style>
    #myDIV1 {
      padding: 50px 50px;


    }
    #myDIV2 {
      width: 100%;
      padding: 50px 50px;
      margin:auto;
      display:none;
    }
  </style>
  <!-- ##### Portfolio Area Start ###### -->
  <div class="pixel-portfolio-area section-padding-100">
    <!-- Portfolio Menu -->
    <div class="pixel-projects-menu">
      <div class="text-center portfolio-menu">
        <button style="outline:none" class="btn active" onclick="myFunction(1)">New</button>
        <button style="outline:none" class="btn" onclick="myFunction(2)">View</button>
      </div>
    </div>

    <style>            

    </style>


    <?php
    if(isset($_GET['uid']))
    {
      if(!isset($_GET['action']))
      {	
        $uid_data = array();
        $uid = $_GET['uid'];
        $query =  mysqli_query($con,"SELECT * FROM `userdetail` WHERE uid=$uid");
        while($data = mysqli_fetch_assoc($query))
        {

          array_push($uid_data, $data['fname'],$data['mname'],$data['lname'],$data['designation'],$data['hname'],$data['congname'],$data['cmobile'],$data['email'],$data['cstate'],$data['cdistrict'],$data['ccity'],$data['caddress'],$data['cpin'],$data['entrydate']);

        }
        $query =  mysqli_query($con,"SELECT * FROM `subscription` WHERE uid=$uid");	
        while($data = mysqli_fetch_assoc($query))
        {
         array_push($uid_data, $data['subid'],$data['type'],$data['comment'],$data['startdate'],$data['enddate'],$data['paymethod'],$data['comment1']);
       }
     }
     elseif(isset($_GET['action']))
     {
      $uid = $_GET['uid'];
      echo "<script type='text/javascript'>"."var r = confirm('Do you want to delete Selected User?');"."if (r == true) {"."$.ajax({"."url:'submit_data.php',"."type:'post',"."data: {"."ids:".$uid."},"."success:function(result){"."$('#result').html(result);"."}});} else { window.location.assign('home.php');}</script>";
      //echo "<script type='text/javascript'> alert('Hello');</script>";
     }
    }
  else{
    $uid = 0;
  }
  ?>
  <!-- Single gallery Item -->
  <div id="myDIV1" class="new" data-wow-delay="0.2s">

    <div class="new1">


      <form class="form-group-lg" method="POST" action="submit_data.php">

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="entrydate">Entry Date:</label>
            <input type="date" class="form-control" id="entrydate" name="entrydate" required value=<?php if(isset($uid_data)){ echo "'".$uid_data[13]."'" ; }?>>
          </div>
          <div class="form-group col-md-6">
            <label for="fname">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required value=<?php if(isset($uid_data)){  echo "'".$uid_data[0]."'";}?>>
          </div>
          <div class="form-group col-md-6">
            <label for="mname">Middle Name:</label>
            <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" value=<?php if(isset($uid_data)){  echo "'".$uid_data[1]."'";}?>>
          </div>
          <div class="form-group col-md-6">
            <label for="lname">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value=<?php if(isset($uid_data)){  echo "'".$uid_data[2]."'";}?>>
          </div>
          <!--<div class="form-group col-md-6">-->
          <!--  <label for="conginitial">Initial Of Congregation:</label>-->
            <!--<input type="text" class="form-control" id="conginitial" name="conginitial" placeholder="" value=<php if(isset($uid_data)){  echo "'".$uid_data[3]."'";}?>>-->
          <!--</div>-->
          <div class="form-group col-md-6">
            <label for="designation">Designation</label>
            <select id="designation" name="designation" class="form-control" required>
              <?php if(isset($uid_data)){  echo "<option>".$uid_data[3]."</option>";}else{ echo "<option disabled selected value> -- Select an option -- </option>";}?>
              <option>Fr</option>
              <option>Sr</option>
              <option>Prof</option>
              <option>Dr</option>
              <option>Mr</option>
              <option>Mrs</option>
              <option>Miss</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="hname">House Name:</label>
            <input type="text" class="form-control" id="hname" name="hname" placeholder="" value=<?php if(isset($uid_data)){ echo   "'".$uid_data[4]."'";}?>>
          </div>
          <!--<div class="form-group col-md-6">-->
          <!--  <label for="gender">Gender</label>-->
          <!--  <select id="gender" name="gender" class="form-control" required>-->
          <!--    <php if(isset($uid_data)){  echo "<option>".$uid_data[6]."</option>";}else{ echo "<option disabled selected value> -- Select an option -- </option>";}?>-->
          <!--    <option>Male</option>-->
          <!--    <option>Female</option>-->
          <!--    <option>Trans</option>-->
          <!--  </select>-->
          <!--</div>-->
          <!--<div class="form-group col-md-6">-->
          <!--  <label for="oname">Official Name:</label>-->
          <!--  <input type="text" class="form-control" id="oname" name="oname" placeholder="" value=<php if(isset($uid_data)){  echo "'".$uid_data[7]."'";}?>>-->
          <!--</div>-->
          <div class="form-group col-md-6">
            <label for="congname">Congregation/Diocese Name:</label>
            <input type="text" class="form-control" id="congname"  name="congname" placeholder="" value=<?php if(isset($uid_data)){  echo "'".$uid_data[5]."'";} ?>>
          </div>
          <div class="form-group col-md-6">
            <label for="cmobile">Mobile:</label>
            <input type="tel" class="form-control" id="cmobile" name="cmobile" placeholder="" required value=<?php if(isset($uid_data)){  echo "'".$uid_data[6]."'";}?>>
          </div>
          <div class="form-group col-md-6">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="" value=<?php if(isset($uid_data)){  echo "'".$uid_data[7]."'";}?>>
          </div>
          <!--<div class="form-group col-md-6">-->
          <!--  <label for="phone">Phone:</label>-->
          <!--  <input type="tel" class="form-control" id="phone" name="phone" placeholder="" value=<php  if(isset($uid_data)){ echo "'".$uid_data[11]."'";}?>>-->
          <!--</div>-->
          <!--<div class="form-group col-md-6">-->
          <!--  <label for="nationality">Nationality:</label>-->
          <!--  <input type="text" class="form-control" id="nationality" name="nationality" placeholder="" required value=<php  if(isset($uid_data)){echo "'".$uid_data[12]."'"; }?>>-->
          <!--</div>-->
          <div class="form-group col-md-6">
            <label for="cstate">State:</label>
            <input type="text" class="form-control" id="cstate" name="cstate" placeholder="" required value=<?php if(isset($uid_data)){ echo "'".$uid_data[8]."'";}?>>
          </div>
          <div class="form-group col-md-6">
            <label for="ccity">City:</label>
            <input type="text" class="form-control" id="ccity" name="ccity" placeholder="" value=<?php if(isset($uid_data)){ echo "'".$uid_data[10]."'";}?>>
          </div>
          <div class="form-group col-md-6">
            <label for="cdistrict">District:</label>
            <input type="text" class="form-control" name="cdistrict" id="cdistrict" placeholder="" required value=<?php if(isset($uid_data)){ echo "'".$uid_data[9]."'";}?>>
          </div>
          <div class="form-group col-md-6">
            <label for="caddress">Address:</label>
            <textarea class="form-control" rows="3" cols="40" id="caddress" name="caddress" placeholder="1234 Main St" required><?php if(isset($uid_data)){ echo $uid_data[11]; }?></textarea>
          </div>
          <div class="form-group col-md-6">
            <label for="cpin">PIN:</label>
            <input type="pin" class="form-control" id="cpin" name="cpin" placeholder="" required value=<?php if(isset($uid_data)){ echo "'".$uid_data[12]."'" ; }?>>
          </div>
          <!--<input type="hidden" name="uid" value="0">-->
        </div>
        <style>
          .chk1 label{
            margin-left: 15px;
          }
        </style>
        <div class="form-row">
          <div class="form-group">
            <hr style="height:2px;border-width:0;color:gray;background-color:gray">


            <input type="hidden" class="form-control" id="subid" name="subid" placeholder="" value=<?php if(isset($uid_data)){ echo "'".$uid_data[14]."'";}?>>

            <div class="form-group col-md-6">
              <label for="type">
              Subscription Type:</label>
              <select id="type" name="type" class="form-control" required>
                <?php if(isset($uid_data)){  echo "<option>".$uid_data[15]."</option>";}else{ echo "<option disabled selected value> -- Select an option -- </option>";}?>
                <option>Paid</option>
                <option>Complementary</option>
                <option>Others</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="comment">Other Details:</label>
              <input type="text" class="form-control" id="comment" name="comment" placeholder="" value=<?php if(isset($uid_data)){ echo "'".$uid_data[16]."'"; }?>>
            </div>
            <div class="form-group col-md-6">
              <label for="startdate">Period From:</label>
              <input type="date" class="form-control" id="startdate" name="startdate" placeholder=""  required value=<?php if(isset($uid_data)){ echo "'".$uid_data[17]."'" ; }?>>
            </div>
            <div class="form-group col-md-6">
              <label for="enddate">Period To:</label>
              <input type="date" class="form-control" id="enddate" name="enddate" placeholder="" required value=<?php if(isset($uid_data)){ echo "'".$uid_data[18]."'" ; }?>>
            </div>
            <div class="form-group col-md-6">
              <label for="paymethod">
              Method Of Payment:</label>
              <select id="paymethod" name="paymethod" class="form-control" required>
                <?php if(isset($uid_data)){  echo "<option>".$uid_data[19]."</option>";}else{ echo "<option disabled selected value> -- Select an option -- </option>";}?>
                <option>Cash</option>
                <option>Cheque</option>
                <option>Bank</option>
                <option>Others</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="comment1">Other Details:</label>
              <input type="text" class="form-control" id="comment1" name="comment1" placeholder="" value=<?php if(isset($uid_data)){ echo "'".$uid_data[20]."'" ; }?>>
            </div>

          </div>
        </div>
        <button name="sbmt" type="submit" class="btn pixel-btn mt-15">Save</button>
        <button type="reset" class="btn pixel-btn mt-15">Clear</button>
        <input type="hidden" name="uid"  value=<?php if(isset($uid_data)){ echo $uid;}else{echo "0";}?>>
      </form>
    </div>

  </div>
  
  
  <!-- Single gallery Item -->
  <div id="myDIV2" class="view" data-wow-delay="0.4s">

    <script>
      $(document).ready(function(){
        $("#active").click(function(){
         var Id = this.id;
         $.ajax({
          url:'data.php',
          type:'post',
          data: {
           ids:Id
         },
         success:function(result){
           $("#result").html(result);
         }
       });
       });
        $("#all").click(function(){
         var Id = this.id;
         $.ajax({
          url:'data.php',
          type:'post',
          data: {
           ids:Id
         },
         success:function(result){
           $("#result").html(result);
         }
       });
       });
        $("#inactive").click(function(){
         var Id = this.id;
         $.ajax({
          url:'data.php',
          type:'post',
          data: {
           ids:Id
         },
         success:function(result){
           $("#result").html(result);
         }
       });
       });
      });
    </script>
    <input type="submit" class="btn pixel-btn mt-15" id="all" name="all" value="All" />
    <input type="submit" class="btn pixel-btn mt-15" id="active" name="active" value="Active" />
    <input type="submit" class="btn pixel-btn mt-15" id="inactive" name="inactive" value="Inactive" />
    <span id="result"></span> 

  </div>
  <link rel="stylesheet" href="./tstyle.css">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>

  <script>
    function myFunction(btnsel) {
      if(btnsel===1){
        var x = document.getElementById("myDIV1");
        var y = document.getElementById("myDIV2");
        x.style.display = "block";
        y.style.display = "none";
      }
      if(btnsel===2){
        var x = document.getElementById("myDIV1");
        var y = document.getElementById("myDIV2");
        x.style.display = "none";
        y.style.display = "block";

      }  

    }
  </script>

</div>
<br>
<br>

<section class="pixel-cool-facts-area bg-gray section-padding-70-0">
    <div class="container-fluid">
      <div class="row">

        <!-- Single Cool Facts -->
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="single-cool-fact mb-10">
            <div class="scf-icon">
              <img src="img/core-img/m1.png" style="width:60px;height:50px;margin-top:20px;" alt="">
            </div>
            <div class="scf-text">
              <h2><span class="counter"><?php echo $all; ?></span></h2>
              <h6>Total Subscriber</h6>
            </div>
          </div>
        </div>

        <!-- Single Cool Facts -->
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="single-cool-fact mb-10">
            <div class="scf-icon">
              <img src="img/core-img/m2.png" style="width:60px;height:50px;margin-top:20px;" alt="">
            </div>
            <div class="scf-text">
              <h2><span class="counter"><?php echo $active; ?></span></h2>
              <h6>Active Subscriber</h6>
            </div>
          </div>
        </div>

        <!-- Single Cool Facts -->
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="single-cool-fact mb-10">
            <div class="scf-icon">
              <img src="img/core-img/m3.png" style="width:60px;height:50px;margin-top:20px;" alt="">
            </div>
            <div class="scf-text">
              <h2><span class="counter"><?php echo $inactive; ?></span></h2>
              <h6>Inactive Subscriber</h6>
            </div>
          </div>
        </div>

        <!-- Single Cool Facts -->
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="single-cool-fact mb-10">
            <div class="scf-icon">
              <img src="img/core-img/m4.png" style="width:60px;height:50px;margin-top:20px;" alt="">
            </div>
            <div class="scf-text">
              <h2><span class="counter"><?php echo $today; ?></span></h2>
              <h6>Subscriber To Be Added</h6>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
<!-- ##### Portfolio Area End ###### -->

<!-- ##### Footer Area Start ##### -->
<footer class="footer-area section-padding-30-0">


  <!-- Copywrite Area -->
  <div class="copywrite-area">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-md-12">
          <div class="copywrite-content" >
            <!-- Copywrite Text -->
            <p class="copywrite-text" style="margin-left:30%;"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This Project is made by <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="developer.php" target="_blank">TechTeam</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</footer>
<!-- ##### Footer Area Start ##### -->

<!-- ##### All Javascript Script ##### -->
<!-- jQuery-2.2.4 js -->
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins js -->
<script src="js/plugins/plugins.js"></script>
<!-- Active js -->
<script src="js/active.js"></script>
</body>

</html>
