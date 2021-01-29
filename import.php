<?php require "session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/bg-img/logo.png">
    <title>Import User Detail</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="./login_style.css">

</head>

<body>
    <style>
        body {
            min-height: 100%;
            background: linear-gradient(0deg, rgba(104, 139, 254, 0.75), rgba(104, 139, 254, 0.75)), url('./img/bg-img/bck1.png');
            background-size: cover;
        }

        .form-text {
            padding: 10px 10px;
            margin-left: 7%;
            margin-bottom: 2%;
            width: 100%;
        }

        .form-text a {
            width: 50%;
            color: grey;
            text-decoration: none;
            float: left;
            margin-bottom: 5%;
        }
    </style>
      
    <!-- partial:index.partial.html -->
    <form class="modal-content" method="post" action="import.php" enctype="multipart/form-data">
    
        <div class="login">
        <center>
        <a href="home.php" style="text-decoration:none;"><h2 style="color:grey;">Vachanam Balivediyil</h2></a>
        </center>
            <div class="form">
                <h2><b>Import User Information</b></h2>
                <div class="form-field">
                    <input id="filetoUpload" type="file" name="filetoUpload" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                    <svg>
        <use href="#svg-check" />
      </svg>
                </div>


                <button type="submit" class="button" name="sbmt">
                    <div class="arrow-wrapper">
                        <span class="arrow"></span>
                    </div>
                    <p class="button-text">Import</p>
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
    <svg style="display:none;">
        <symbol id="svg-check" viewBox="0 0 130.2 130.2">
            <polyline points="100.2,40.2 51.5,88.8 29.8,67.5 " />
        </symbol>
    </svg>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src="./script.js"></script>

    <?php

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST['sbmt'])) {

        $list = '';

        
        include "SimpleXLSX.php";



        if ($xlsx = SimpleXLSX::parse($_FILES["filetoUpload"]["tmp_name"])) {
            
            $i = 0;


            foreach ($xlsx->rows() as $elt) {
                if ($i == 0) {
                    $i++;
                    continue;

                    
                } else {
                    
                    $entrydate = test_input($elt[1]);
                    $designation = test_input($elt[2]);
                    $fname = test_input($elt[3]);
                    $mname = test_input($elt[4]);
                    $lname = test_input($elt[5]);
                    //$oname = test_input($elt[6]);
                    //$gender = test_input($elt[7]);
                    $cmobile =  test_input($elt[6]);
                    $email = test_input($elt[7]);
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    //$phone = test_input($elt[10]);
                    $hname = test_input($elt[8]);
                    //$conginitial = test_input($elt[12]);
                    $congname = test_input($elt[9]);
                    //$nationality = test_input($elt[14]);
                    $cstate  = test_input($elt[10]);
                    $cdistrict = test_input($elt[11]);
                    $ccity = test_input($elt[12]);
                    $caddress = test_input($elt[13]);
                    $cpin = test_input($elt[14]);
                    
                    $check = 0;
                    
                   // echo "Email is ".$email;
                   // echo "<br>".var_dump($fname)."<br>".$mname."<br>".$lname."<br>".var_dump($entrydate)."<br>".$conginitial."<br>".$designation."<br>".$hname."<br>".$gender."<br>".$oname."<br>".$congname."<br>".var_dump($cmobile)."<br>".$email."<br>".$phone."<br>".$nationality."<br>".$cstate."<br>".$ccity."<br>".$caddress."<br>".$cpin."<br>".var_dump($cdistrict)."<br>";
                    if ($fname == "" ||  $entrydate == ""  || $cmobile == "" || $cstate == "" || $cdistrict == "" || $caddress == "" || $cpin == "") {
                        echo "Error1";
                        $list .= $fname . ",";
                    }
                    //Validate e-mail
                    
                    elseif(!empty($email))
                    {
                       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                       {
                        echo "Error2";
                        $list .= $fname . ",";
                       }
                       else{
                           $check = 1;
                       }
                    }
                    // Validate Name and Address
                    elseif (is_numeric($fname) || is_numeric($mname) || is_numeric($lname)  || is_numeric($hname) || is_numeric($congname) || is_numeric($cstate) || is_numeric($ccity) || is_numeric($caddress) || is_numeric($cdistrict)) {
                        echo "Error3";
                        $list .= $fname . ",";
                    }
                    //Validate Pin
                    elseif (!is_numeric($cpin) || strlen($cpin) <> 6) {
                        echo "Error4";
                        $list .= $fname . ",";
                    }
                    //Validate Phone
                    elseif (!is_numeric($cmobile) || strlen($cmobile) <> 10) {
                        echo "Error5";
                        $list .= $fname . ",";
                    }else {
                        $check = 1;
                        
                    }
                    if($check == 1){
                        
                        if(empty($email))
                        {
                           $email = 'null@'.date("Y-m-d h:i:sa").'.com';
                           $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                        }
                        
                        $query =  mysqli_query($con, "INSERT INTO `userdetail`( `fname`, `mname`, `lname`, `designation`, `hname`, `congname`, `cmobile`, `email`, `cstate`, `cdistrict`, `ccity`, `caddress`, `cpin`, `entrydate`) VALUES ('$fname','$mname','$lname','$designation','$hname','$congname','$cmobile','$email','$cstate','$cdistrict','$ccity','$caddress','$cpin','$entrydate')");


                        if ($query) {
                            $query = mysqli_query($con, "SELECT uid from `userdetail` where email='$email'");
                            $uid_r = mysqli_fetch_assoc($query);
                            $uid = $uid_r['uid'];
                            $query = mysqli_query($con, "INSERT INTO `subscription`( `uid`) VALUES ($uid)");
                            if (!$query) {
                                $list .= $fname . ",";
                            }
                        } else {
                            
                            $list .= $fname . ",";
                        }
                    }
                }

                $i++;
               
            }


            if (!empty($list)) {
                $msg = 'For Following user\n' .$list.'\nData cant be insert to Database.Please check and insert it explicitly';
                echo "<script type='text/javascript'>alert(\"".$msg."\")</script>";
            } else {
                echo "<script type='text/javascript'>alert('All Records Inserted Successfully.Update there Subscription explicitly')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Error in File or FileFormat')</script>";
            echo SimpleXLSX::parseError();
        }
    }


    ?>

</body>

</html>
