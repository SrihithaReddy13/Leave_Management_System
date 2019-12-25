<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type='text/css' href="css/details.css">
	<!--<script type="text/javascript" src="js/details.js"></script>-->
	<title>Register</title>
</head>
<body>
	
	<?php 
		$con=mysqli_connect("localhost", "root", "");
		mysqli_select_db($con,"login");
		$type=$_POST['type'];
		
		echo "<h2 id='h2lin'>Team Zenith</h2>";
		echo "<div id='regform'>";
		echo "<form class='box' id='regdetbox' method='POST' accept-charset='utf-8'>";
		echo "<h1>Personal Info</h1>";
		echo "<h4>Please fill in the details below</h4>";
		echo "<input type='hidden' id='type' name='type' value='".$type."'>";
		echo "<input type='text' name='name' placeholder='Name'>";
		echo "<input type='text' id='user' name='user' placeholder='Username'>";	
		echo "<input type='password' id='pass' name='pass' placeholder='Password'>";
		echo "<input type='password' id='confpass' name='confpass' placeholder='Confirm Password'>";
		echo "<input type='radio' id='gender' name='gender' value='gender'><span>Male</span>";
		echo "<input type='radio' id='gender' name='gender' value='gender' checked><span>Female</span>";
		echo "<input type='number' name='phno' placeholder='Phone Number' min='7000000000' max='9999999999'>";
		echo "<input type='number' name='age' placeholder='Age' min='20' max='80'>";
		echo "<input type='text' name='dept' placeholder='Department'>";
		echo "<input type='number' name='salary' placeholder='Salary' min='10000'>";
		if ($type=='HOD'){
			echo "<input type='date' name='hodsince' placeholder='Started as HOD on'>"; 
		}
		if($type=='Intern')
		{
			echo "<input type='number' name='mentorid1' placeholder='ID of first mentor'> ";
			echo "<input type='number' name='mentorid2' placeholder='ID of second mentor'> ";
			echo "<input type='number' name='noofweeks' placeholder='Duration of Internship'>";
		}
        if($type=='Technician')
		{
		   echo "<input type='number' name='tgrade' placeholder='Technician Grade'> ";	
		}
		if($type=='Developer')
		{
		   echo "<input type='text' name='dtype' placeholder='Developer Type'> ";	
		}
		echo "<input type='submit' id='subdetbtn' value='Submit' formaction='regprocess.php'>";
		echo "<input type='submit' id='cancelbtn' value='Cancel' formaction='login.php'>";
		echo "</form>";
		echo "</div>";
	?>
</body>
</html>
