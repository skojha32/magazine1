<?php
    require "config.php";
	if(isset($_POST['sbmt']))
    {
        $username = $_POST['uname'];
        $paswd = $_POST['password'];
        
        if($username=="" || $paswd=="")
		{
			echo "<script type='text/javascript'>alert('Enter the username and password')</script>";
			echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
        }
        else
        {
			$queryhash = mysqli_query($con,"SELECT password FROM gateway WHERE username = '$username'");
			$hasharray = mysqli_fetch_assoc($queryhash);
			$hash = $hasharray['password'];
			
            if(password_verify($paswd, $hash))
            {
              
              $sessionid = uniqid();
              $inssession = mysqli_query($con, "UPDATE gateway SET sessionid='$sessionid' WHERE username='$username'");
              if($inssession)
              {
                setcookie('sessionVal', $sessionid, time() + (86400 * 7),"/");
                setcookie('userNam', $username, time() + (86400 * 7), "/");
                //echo "<script type='text/javascript'>alert(".$_COOKIE['userNam'].")</script>";
                echo "<script type='text/javascript'>window.location.assign('home.php')</script>";
              }
              else
              {
                //echo mysqli_error($con);
                echo "<script type='text/javascript'>alert('something went wrong please try again.')</script>";
              }
            }
            else
            {
				echo "<script type='text/javascript'>alert('Incorrect username or password.')</script>";
				echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
            }
        }
    }
?>