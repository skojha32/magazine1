<?php require "session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
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
            <h2>Subscription Report</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ##### Breadcrumb Area End ##### -->
  <link rel="stylesheet" href="./radiostyle.css">

  <!-- ##### Portfolio Area Start ###### -->
  <div class="pixel-portfolio-area section-padding-100">
    <form id="filterform" class="form-group-lg" style="margin:auto;width: 100%;padding: 10px 10px;">
      <div class="form-row ">
        <div class="form-group col-md-4 radio-buttons">
          <label class="container">District
            <input type="radio" checked="checked" name="radio" value="District">
            <span class="checkmark"></span>
          </label>
          <select id="districtState" class="form-control">
           <option disabled selected value> -- Select an option -- </option>
           <?php

           $query =  mysqli_query($con, "SELECT DISTINCT cdistrict FROM userdetail");

           if(mysqli_num_rows($query) == 0)
           {
            echo "<option disabled selected value> -- Select an option -- </option>";
          }
          else
          {
            while($row = mysqli_fetch_row($query))
            {
             echo "<option>{$row[0]}</option>";
           }
           echo "</table>";
         }

         ?>
       </select>
     </div>
     <div class="form-group col-md-4 rd1">
      <label class="container"> Subscription Type
        <input type="radio" name="radio" value="subtype">
        <span class="checkmark"></span>
      </label>
      <select id="subState" class="form-control">
        <option disabled selected value> -- Select an option -- </option>
        <option>Paid</option>
        <option>Complementary</option>
        <option>Others</option>
      </select>
    </div>
    <div class="form-group col-md-4 rd1">
      <label class="container">Payment Type
        <input type="radio" name="radio" value="paytype">
        <span class="checkmark"></span>
      </label>
      <select id="payState" class="form-control">
        <option disabled selected value> -- Select an option -- </option>
        <option>Cash</option>
        <option>Cheque</option>
        <option>Bank</option>
        <option>Others</option>
      </select>
    </div>

  </div>
  <button type="submit" class="btn pixel-btn mt-15" id="show" name="show">Show</button>
  <button type="reset" class="btn pixel-btn mt-15">Clear</button>
  <a href="export.php" target="_blank"><span class="btn pixel-btn mt-15">Export</span></a>
<a href="print.php" target="_blank"><span class="btn pixel-btn mt-15">Print</span></a>
  <span id="result"></span> 
</form>



<!-- Single gallery Item -->
<link rel="stylesheet" href="./tstyle.css">
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>




<script>
  $(document).ready(function(){
    $("#show").click(function(e){
     e.preventDefault();
     var Id = this.id;
     var checked_option = $("input[name='radio']:checked").val();
     if(checked_option == "District")
     {
      var selected_option = $('#districtState option').filter(':selected').text();

    }
    else if(checked_option == "subtype")
    {
      var selected_option = $('#subState option').filter(':selected').text();

    }
    else if(checked_option == "paytype")
    {
      var selected_option = $('#payState option').filter(':selected').text();

    }					
    $.ajax({
      url:'report_data.php',
      type:'post',
      data: {
       radio_option:checked_option,
       select_option:selected_option
     },
     success:function(result){
       $("#result").html(result);
     }
   });
  });
  });
</script>


</div>



<br>
<br>
<!-- ##### Portfolio Area End ###### -->

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
