<?php

require "session.php";

session_start();

echo "<br><br><table class='rwd-table' style='margin:auto; color:white;'>";


echo "<tr>
<th>S.No</th>
<th>Name</th>
<th>Email</th>
<th>Mobile</th>
<th>SubPeriodFromDate</th>
<th>SubPeriodToDate</th>
<th>Edit</th>
<th>Delete</th>
</tr>";

if($_POST['ids'] == "active"){

	$count = 1;

	$emailList = array();

	$query = mysqli_query($con, "SELECT userdetail.fname,userdetail.mname,userdetail.lname,userdetail.designation,userdetail.email,userdetail.cmobile,subscription.startdate,subscription.enddate,userdetail.uid FROM userdetail INNER JOIN subscription ON userdetail.uid = subscription.uid WHERE DATE_FORMAT(subscription.enddate, '%Y-%m-%d') >= CURDATE() ");
	if(mysqli_num_rows($query) == 0)
	{
		echo "<tr><td colspan = '4'>no rows returned</td></tr>";
		unset($_SESSION["Vachanamemail"]);
		unset($_SESSION["Vachanamreminder"]);
	}
	else
	{
		while($row = mysqli_fetch_row($query))
		{
			$date1=date_create(date("Y-m-d"));
            $date2=date_create($row[7]);
            $diff=date_diff($date1,$date2);
			$val = $diff->format("%a");
			if($val <= 30)
			{
				array_push($emailList,array($row[4],$row[3]."."." ".$row[0]." ".$row[1]." ".$row[2]));
			}
			echo "<tr><td data-th='S.No'>{$count}</td><td data-th='Name'>"."{$row[3]}"."."." "."{$row[0]}"." "."{$row[1]}"." "."{$row[2]}"."</td><td data-th='Email'>{$row[4]}</td><td data-th='Mobile'>{$row[5]}</td><td data-th='SubPeriodFromDate'>{$row[6]}</td><td data-th='SubPeriodToDate'>{$row[7]}</td><input type='hidden' value={$row[8]} name='uid'><td data-th='Edit'><a href='./home.php?uid="."{$row[8]}"."' id='btn_read_HTML_Table' class='fa fa-edit' style='font-size: 20px;color:orange'></td>
			<td data-th='Delete'><a href='./home.php?uid="."{$row[8]}"."&action="."delete"."' id='btn_read_HTML_Table' class='fa fa-trash-o' style='font-size:20px;color:red'></i></td></tr>";
			$count++;
		}
		
		echo "</table><br><br>";
		$_SESSION["Vachanamemail"]=$emailList;
		$_SESSION["Vachanamreminder"] = "yes";
		echo  "<a href='mail.php' target='_blank'><button class='btn pixel-btn mt-15'>Send Reminder</button></a>";
	}
	
}
elseif($_POST['ids'] == "all"){
	
	$count = 1;

	$query = mysqli_query($con, "SELECT userdetail.fname,userdetail.mname,userdetail.lname,userdetail.designation,userdetail.email,userdetail.cmobile,subscription.startdate,subscription.enddate,userdetail.uid FROM userdetail INNER JOIN subscription ON userdetail.uid = subscription.uid");
	if(mysqli_num_rows($query) == 0)
	{
		echo "<tr><td colspan = '4'>no rows returned</td></tr>";
	}
	else
	{
		while($row = mysqli_fetch_row($query))
		{
			
			echo "<tr><td data-th='S.No'>{$count}</td><td data-th='Name'>"."{$row[3]}"."."." "."{$row[0]}"." "."{$row[1]}"." "."{$row[2]}"."</td><td data-th='Email'>{$row[4]}</td><td data-th='Mobile'>{$row[5]}</td><td data-th='SubPeriodFromDate'>{$row[6]}</td><td data-th='SubPeriodToDate'>{$row[7]}</td><input type='hidden' value={$row[8]} name='uid'><td data-th='Edit'> <a href='./home.php?uid="."{$row[8]}"."' id='btn_read_HTML_Table' class='fa fa-edit' style='font-size: 20px;color:orange'></td>
			<td data-th='Delete'><a href='./home.php?uid="."{$row[8]}"."&action="."delete"."' id='btn_read_HTML_Table' class='fa fa-trash-o' style='font-size:20px;color:red'></i></td></tr>";
			$count++;
		}
		echo "</table>";
	}
	
}
elseif($_POST['ids'] == "inactive"){
	
	$count = 1;
	$ids = "";
	$body = "Hello!, Please Renew your subscription";
	$emailList = array();
	$query = mysqli_query($con, "SELECT userdetail.fname,userdetail.mname,userdetail.lname,userdetail.designation,userdetail.email,userdetail.cmobile,subscription.startdate,subscription.enddate,userdetail.uid FROM userdetail INNER JOIN subscription ON userdetail.uid = subscription.uid WHERE DATE_FORMAT(subscription.enddate, '%Y-%m-%d') < CURDATE()");
	if(mysqli_num_rows($query) == 0)
	{
		echo "<tr><td colspan = '4'>no rows returned</td></tr>";
		unset($_SESSION["Vachanamemail"]);
		unset($_SESSION["Vachanamreminder"]);
	}
	else
	{
		while($row = mysqli_fetch_row($query))
		{
			array_push($emailList,array($row[4],$row[3]."."." ".$row[0]." ".$row[1]." ".$row[2]));
			echo "<tr><td data-th='S.No'>{$count}</td><td data-th='Name'>"."{$row[3]}"."."." "."{$row[0]}"." "."{$row[1]}"." "."{$row[2]}"."</td><td data-th='Email'>{$row[4]}</td><td data-th='Mobile'>{$row[5]}</td><td data-th='SubPeriodFromDate'>{$row[6]}</td><td data-th='SubPeriodToDate'>{$row[7]}</td><input type='hidden' value={$row[8]} name='uid'><td data-th='Edit'><a href='./home.php?uid="."{$row[8]}"."'  id='btn_read_HTML_Table' class='fa fa-edit' style='font-size: 20px;color:orange'></td>
			<td data-th='Delete'><a href='./home.php?uid="."{$row[8]}"."&action="."delete"."' id='btn_read_HTML_Table' class='fa fa-trash-o' style='font-size:20px;color:red'></i></td></tr>";
			$count++;
		}
		echo "</table><br><br>";
		$_SESSION["Vachanamemail"]=$emailList;
		unset($_SESSION["Vachanamreminder"]);
	     echo  "<a href='mail.php' target='_blank'><button class='btn pixel-btn mt-15'>Send Mail</button></a>";	     
	 }

	}

	?>


	
