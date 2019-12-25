
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
	<h4>You have successfully applied for leave. Click below to return to your profile.</h4>
	<input type="submit" id="linbtn" value="Profile">
	</form>
</body>
</html>



<?php
	#include 'linprocess.php';
	session_start();
	$loginid= $_SESSION['loginid'];
	$pide= $_SESSION['eid'];
	$con=mysqli_connect("localhost", "root", "");
	mysqli_select_db($con,"login");

	$sql2= "SELECT hodid FROM employee WHERE pid=$pide";
	$sql2result=mysqli_query($con,$sql2);
	$sql2row=mysqli_fetch_assoc($sql2result);
	$pidh=$sql2row['hodid'];
	$ltype = $_POST['ltype'];
	$sdate= $_POST['sdate'];
	$edate= $_POST['edate'];
	$reason= $_POST['reason'];
	$lid=rand(0000,9999);
	$now = new DateTime();
	$adate= $now->format('Y-m-d');
	$status='Pending';
	
	$sql = "INSERT INTO leaves (lid,ltype, sdate, edate , adate, reason, status, pide,pidh) VALUES (?,?,?,?,?,?,?,?,?)";
	$stmt = mysqli_prepare($con,$sql);
	$stmt->bind_param("sssssssss", $lid, $ltype,$sdate,$edate,$adate,$reason,$status,$pide,$pidh);
	$stmt->execute();

?>