
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css/leave.css">

</head>
<body>
	<button type='button' class='btns' id='logout' onclick='window.location.href="login.php"'>Logout</button>;
	<form class="box" action="lindup.php" method="get" accept-charset="utf-8">
	<h4>You have successfully updated the database. Click below to return to your profile.</h4>
	<input type="submit" id="linbtn" value="Profile">
	</form>
</body>
</html>
<?php
	session_start();
	$con=mysqli_connect("localhost", "root", "");
	mysqli_select_db($con,"login");
	$lid=$_POST['lid'];
	$status=$_POST['status'];
	$eid=$_SESSION['eid'];
	$sdate=$_POST['sdate'];
	$edate=$_POST['edate'];
	$adate=$_POST['adate'];
	$type=$_POST['type'];
	$now = new DateTime();
	$now= $now->format('Y-m-d');
	if ($now>$sdate){
		$msg="Cannot Delete anymore";
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}else{
		$sql= "DELETE FROM leaves WHERE lid=$lid and pide=$eid";
		$sqlresult=mysqli_query($con,$sql);

		$sdatestr = strtotime($sdate); 
		$edatestr = strtotime($edate);
		$datediff = $edatestr - $sdatestr;
		$duration = round($datediff / (60 * 60 * 24));
		if ($status=='Granted'){
			$sql1= "UPDATE leaveinfo SET ltaken=ltaken-".$duration." WHERE pid=$eid and type='$type'";
			$sql1result=mysqli_query($con,$sql1);

			$sql2="UPDATE leaveinfo SET lavailable=lavailable+".$duration." WHERE pid=$eid and type='$type'";
			$sql2result=mysqli_query($con,$sql2);
		}
	}
	

?>