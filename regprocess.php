<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type='text/css' href="css/regprocess.css">
	<title>Register</title>
</head>
<body>
	<h2 id="h2lin">Team Zenith</h2>;
	<h1>Welcome!</h1>
	<form class="box" action="login.php" method="get" accept-charset="utf-8">
	<h4>You have registered the user. Click below to login.</h4>
	<input type="submit" id="linbtn" value="Login">
	</form>
	<?php
		$con=mysqli_connect("localhost", "root", "");
		mysqli_select_db($con,"login");

		$uname = $_POST['user'];
		$pwd= $_POST['pass'];
		$cpwd= $_POST['confpass'];
		$type=$_POST['type'];
		$loginid=rand(1100,9999);

		$uname= stripcslashes($uname);
		$pwd = stripcslashes($pwd);
		$cpwd = stripcslashes($cpwd);
		$type = stripcslashes($type);
		if ($type=='HOD'){
			$hod='y';
		}else{
			$hod='n';
		}

		#Confirm pwd and pwd should match

		$sql = "INSERT INTO login (loginid, uname, pwd,admin) VALUES (?,?,?,?)";
		$stmt = mysqli_prepare($con,$sql);
		$stmt->bind_param("ssss", $loginid, $uname , $pwd , $hod);
		$stmt->execute();

		$name = $_POST['name'];
		$phno= $_POST['phno'];
		$dept = $_POST['dept'];
		$age= $_POST['age'];
		$gender=$_POST['gender'];
		$salary=$_POST['salary'];
		$pid=rand(11000,99999);

		if ($gender == 'Male'){
			$gender='M';
		}else{
			$gender='F';
		}
		$name=stripcslashes($name);
		$sql = "INSERT INTO person (pid, name, age,gender,phno,salary,dept) VALUES (?,?,?,?,?,?,?)";
		$stmt = mysqli_prepare($con,$sql);
		$stmt->bind_param("sssssss", $pid, $name, $age, $gender, $phno, $salary, $dept );
		$stmt->execute();

		if ($hod=='y'){
			$hodsince=$_POST['hodsince'];
			$sql= "INSERT INTO hod(pid,loginid,noofemp,hodsince) VALUES (?,?,?,?)";
			$noofemp=0;
			$stmt = mysqli_prepare($con,$sql);
			$stmt->bind_param("ssss",$pid,$loginid,$noofemp,$hodsince);
			$stmt->execute();
		}else{
			$sql2= "SELECT pid FROM hod WHERE pid IN (SELECT pid FROM person WHERE dept='$dept')";
			$sql2result=mysqli_query($con,$sql2);
			$sql2row=mysqli_fetch_assoc($sql2result);
			$hodid=$sql2row['pid'];
			$sql3= "INSERT INTO employee(pid,loginid,hodid) VALUES(?,?,?)";
			$stmt2 = mysqli_prepare($con,$sql3);
			$stmt2->bind_param("sss",$pid,$loginid,$hodid);
			$stmt2->execute();
			$sql4= "UPDATE hod SET noofemp=noofemp+1";
			$sql4result=mysqli_query($con,$sql4);
			$sqlli1= "INSERT INTO leaveinfo(pid,type,ltaken,lavailable) VALUES(?,?,?,?)";
			$stmtli1 = mysqli_prepare($con,$sqlli1);
			$ltype='Casual';
			$ltaken=0;
			$lavailable=12;
			$stmtli1->bind_param("ssss",$pid,$ltype,$ltaken,$lavailable);
			$stmtli1->execute();
			$sqlli2= "INSERT INTO leaveinfo(pid,type,ltaken,lavailable) VALUES(?,?,?,?)";
			$stmtli2 = mysqli_prepare($con,$sqlli2);
			$ltype='Medical';
			$ltaken=0;
			$lavailable=15;
			$stmtli2->bind_param("ssss",$pid,$ltype,$ltaken,$lavailable);
			$stmtli2->execute();
			if ($gender=='F'){
				$sqlli3= "INSERT INTO leaveinfo(pid,type,ltaken,lavailable) VALUES(?,?,?,?)";
				$stmtli3 = mysqli_prepare($con,$sqlli3);
				$ltype='Maternity';
				$ltaken=0;
				$lavailable=90;
				$stmtli3->bind_param("ssss",$pid,$ltype,$ltaken,$lavailable);
				$stmtli3->execute();
			}

			if ($type=='Intern'){	
				$mentorid1=$_POST['mentorid1'];
				$mentorid2=$_POST['mentorid2'];
				$noofweeks=$_POST['noofweeks'];
				$sql5= "INSERT INTO intern(pid,mentorid,noofweeks) VALUES(?,?,?)";
				$stmt3=mysqli_prepare($con,$sql5);
				$stmt3->bind_param("sss",$pid,$mentorid1,$noofweeks);
				$stmt3->execute();
				$sql6= "INSERT INTO intern(pid,mentorid,noofweeks) VALUES(?,?,?)";
				$stmt4=mysqli_prepare($con,$sql6);
				$stmt4->bind_param("sss",$pid,$mentorid2,$noofweeks);
				$stmt4->execute();
			}
			if ($type=='Technician'){
				$tgrade=$_POST['tgrade'];
				$sql5="INSERT INTO technician(pid,tgrade) VALUES (?,?)";
				$stmt3=mysqli_prepare($con,$sql5);
				$stmt3->bind_param("ss",$pid,$tgrade);
				$stmt3->execute();
			}
			if ($type=='Developer'){
				$dtype=$_POST['dtype'];
				$sql5="INSERT INTO devoloper(pid,dtype) VALUES (?,?)";
				$stmt3=mysqli_prepare($con,$sql5);
				$stmt3->bind_param("ss",$pid,$dtype);
				$stmt3->execute();
			}
		}
		

	?>
</body>
</html>
