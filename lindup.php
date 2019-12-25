<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome!</title>
	<link rel="stylesheet" href="css/linprocess.css">
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="js/linprocess.js"></script>
</head>
<body>
	<button type='button' class='btns' id='logout' onclick='window.location.href="login.php"'>Logout</button>;
	<?php
		session_start();

		$uname=$_SESSION['uname'];
		$pwd=$_SESSION['pwd'];


		$uname= stripcslashes($uname);
		$pwd = stripcslashes($pwd);

		$con=mysqli_connect("localhost", "root", "");
		mysqli_select_db($con,"login");


		$result = mysqli_query($con,"select * from login where uname= '$uname' and pwd= '$pwd'") or die("Failed to query database".mysqli_error());
		$row= mysqli_fetch_array($result);
		if ($row['uname'] == $uname && $row['pwd']== $pwd) { 
			echo "<h1 id='greeting'><u>Welcome," .$uname. "!</u></h1>";
			echo "<h2 id='h2lin'>Team Zenith</h2>";
			if ($row['admin']=='y'){
				$sql3="SELECT loginid from login where uname='$uname'";
				$result3=mysqli_query($con,$sql3);
				$row3=mysqli_fetch_assoc($result3);
				$loginid=$row3['loginid'];
				$_SESSION['loginid']=$loginid;
				$sql2="SELECT pid from hod where loginid=$loginid";
				$result2= mysqli_query($con,$sql2);
				$row2=mysqli_fetch_assoc($result2);
				$hodid=$row2['pid'];
				$_SESSION['hodid']=$hodid;
				echo " <button type='button' class='btns' id='profile' autofocus> Profile </button> ";
				echo " <button type='button' class='btns' id='empl'> Employees </button> ";
				echo " <button type='button' class='btns' id='leaves'> Leaves </button> ";

				echo "<div class='personal' id='personal'>";
				echo "<h1><u> PERSONAL INFO </u></h1>";
				$sqlpersonal= "SELECT * FROM PERSON WHERE pid=$hodid";
				$resultpersonal=mysqli_query($con,$sqlpersonal);
				$rowpersonal=mysqli_fetch_assoc($resultpersonal);
				echo "PERSON ID - ".$rowpersonal["pid"] ."<br>";
				echo "NAME - ".$rowpersonal["name"]."<br>";
				echo "AGE - ".$rowpersonal["age"]."<br>";
				echo "GENDER - ".$rowpersonal["gender"]."<br>";
				echo "PHONE NO - ".$rowpersonal["phno"]."<br>";
				echo "DEPARTMENT - ".$rowpersonal["dept"]."<br>";
				echo "SALARY - ".$rowpersonal["salary"]."<br>";
				echo "</div>";

				echo "<div class='table' id='emplinfo'>";
				$sql1 = "SELECT pid FROM employee where hodid=$hodid";
				$result1 = $con->query($sql1);
				echo "<table style='width:100%'>";
				echo "<tr>";
				echo "<th>Person ID</th>";
				echo "<th>Name</th>";
				echo "<th>Phone Number</th>";
				echo "<th>Salary</th>";
				echo "</tr>";
				if ($result1->num_rows > 0) {
				    while($row1 = $result1->fetch_assoc()) {
						echo "<tr>";
						echo "<td>". $row1["pid"]."</td>";
						$pid=$row1["pid"];
						$sql="SELECT * FROM PERSON WHERE pid=$pid";
						$result= mysqli_query($con,$sql);
						$row=mysqli_fetch_assoc($result);
						echo "<td>". $row["name"]."</td>";
						echo "<td>". $row["phno"]."</td>";
						echo "<td>". $row["salary"]."</td>";
						echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table>"; 
				echo "</div>";

				echo "<div class='table' id='leavetaken'>";
				$sql = "SELECT * FROM leaves where pidh=$hodid";
				$result = $con->query($sql);
				echo "<table style='width:100%'>";
				echo "<tr>";
				echo "<th>Leave ID</th>";
				echo "<th>Leave Type</th>";
				echo "<th>Start Date</th>";
				echo "<th>End Date</th>";
				echo "<th>Applied Date</th>";
				echo "<th>Reason</th>";
				echo "<th>Status</th>";
				echo "<th>Approve</th>";
				echo "<th>Rollback</th>";
				echo "</tr>";
				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>". $row["lid"]."</td>";
						echo "<td>". $row["ltype"]."</td>";
						echo "<td>". $row["sdate"]."</td>";
						echo "<td>". $row["edate"]."</td>";
						echo "<td>". $row["adate"]."</td>";
						echo "<td>". $row["reason"]."</td>";
						echo "<td>". $row["status"]."</td>";
						echo "<td><form method='post' action='approve.php'>";
						echo "<input type='submit' id='linbtn' value='Approve'>";
						echo "<input type='hidden' id='lid' name='lid' value='".$row["lid"]."'>";
						echo "<input type='hidden' id='status' name='status' value='".$row["status"]."'>";
						echo "<input type='hidden' id='sdate' name='sdate' value='".$row["sdate"]."'>";
						echo "<input type='hidden' id='type' name='type' value='".$row["ltype"]."'>";
						echo "<input type='hidden' id='edate' name='edate' value='".$row["edate"]."'>";
						echo "<input type='hidden' id='adate' name='adate' value='".$row["adate"]."'></form></td>";
						echo "<td><form method='post' action='rollback.php'>";
						echo "<input type='submit' id='linbtn' value='Rollback'>";
						echo "<input type='hidden' id='lid' name='lid' value='".$row["lid"]."'>";
						echo "<input type='hidden' id='status' name='status' value='".$row["status"]."'>";
						echo "<input type='hidden' id='type' name='type' value='".$row["ltype"]."'>";
						echo "<input type='hidden' id='sdate' name='sdate' value='".$row["sdate"]."'>";
						echo "<input type='hidden' id='edate' name='edate' value='".$row["edate"]."'>";
						echo "<input type='hidden' id='adate' name='adate' value='".$row["adate"]."'></form></td>";
						echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table>"; 
				echo "</div>";
			}else{
				$sql3="SELECT loginid from login where uname='$uname'";
				$result3=mysqli_query($con,$sql3);
				$row3=mysqli_fetch_assoc($result3);
				$loginid=$row3['loginid'];
				$_SESSION['loginid']=$loginid;

				$sql2="SELECT pid from employee where loginid=$loginid";
				$result2= mysqli_query($con,$sql2);
				$row2=mysqli_fetch_assoc($result2);
				$eid=$row2['pid'];
				$_SESSION['eid']=$eid;

				echo " <button type='button' class='btns' id='profile' autofocus> Profile </button> ";
				echo " <button type='button' class='btns' id='aleave'> Apply </button> ";
				echo " <button type='button' class='btns' id='sleave'> Leaves </button> ";
				echo " <button type='button' class='btns' id='rleave'> Remaining </button> ";
				echo " <button type='button' class='btns' id='salary'> Salary </button> ";

				echo "<div class='personal' id='personal'>";
				echo "<h1><u> PERSONAL INFO </u></h1>";
				$sqlpersonal= "SELECT * FROM PERSON WHERE pid=$eid";
				$resultpersonal=mysqli_query($con,$sqlpersonal);
				$rowpersonal=mysqli_fetch_assoc($resultpersonal);
				echo "PERSON ID - ".$rowpersonal["pid"] ."<br>";
				echo "NAME - ".$rowpersonal["name"]."<br>";
				echo "AGE - ".$rowpersonal["age"]."<br>";
				echo "GENDER - ".$rowpersonal["gender"]."<br>";
				echo "PHONE NO - ".$rowpersonal["phno"]."<br>";
				echo "DEPARTMENT - ".$rowpersonal["dept"]."<br>";
				echo "SALARY - ".$rowpersonal["salary"]."<br>";
				$sql4="SELECT pid FROM technician WHERE pid=$eid";
				$result4=mysqli_query($con,$sql4);
				$row4=mysqli_fetch_assoc($result4);
				if ($row4['pid']==$eid){
					$sql5="SELECT * FROM technician WHERE pid=$eid";
					$result5=mysqli_query($con,$sql5);
					$row5=mysqli_fetch_assoc($result5);
					echo "TECHNICIAN GRADE - ".$row5["tgrade"]."<br>";
				}
				$sql4="SELECT pid FROM intern WHERE pid=$eid";
				$result4=mysqli_query($con,$sql4);
				$row4=mysqli_fetch_assoc($result4);
				if ($row4['pid']==$eid){
					$sql5="SELECT * FROM intern WHERE pid=$eid";
					$result = $con->query($sql5);
					if ($result->num_rows > 0) {
				    	while($row = $result->fetch_assoc()) {
							echo "MENTOR ID - ".$row["mentorid"]."<br>";
						}
					}
				}
				$sql4="SELECT pid FROM devoloper WHERE pid=$eid";
				$result4=mysqli_query($con,$sql4);
				$row4=mysqli_fetch_assoc($result4);
				if ($row4['pid']==$eid){
					$sql5="SELECT * FROM devoloper WHERE pid=$eid";
					$result5=mysqli_query($con,$sql5);
					$row5=mysqli_fetch_assoc($result5);
					echo "DEVELOPER TYPE - ".$row5["dtype"]."<br>";
				}
				
				echo "</div>";	

				echo "<div id='applyleave'>";
				echo "<form class='box' id='leaveform' action='leave.php' method='POST'>";
     			echo "<h1>Fill in the Leave Form</h1>";
			    echo "<input type='text' id='ltype' name='ltype' placeholder='Leave Type'>";	
			    echo "<label for='sdate' id='labels'>From</label>";
			    echo "<input type='date' id='sdate' name='sdate'>";
			    echo "<label for='edate' id='labele'>To</label>";
			    echo "<input type='date' id='edate' name='edate'>";
			    echo "<input type='text' id='reason' name='reason' placeholder='Reason'>";
			    echo "<input type='submit' id='applybtn' value='Submit'>";
		        echo "</form>";
		        echo "</div>";	

				echo "<div class='table' id='leavetaken'>";
				$sql = "SELECT * FROM leaves where pide=$eid";
				$result = $con->query($sql);
				echo "<table style='width:100%'>";
				echo "<tr>";
				echo "<th>Leave ID</th>";
				echo "<th>Leave Type</th>";
				echo "<th>Start Date</th>";
				echo "<th>End Date</th>";
				echo "<th>Applied Date</th>";
				echo "<th>Reason</th>";
				echo "<th>Status</th>";
				echo "<th>Delete</th>";
				echo "</tr>";
				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>". $row["lid"]."</td>";
						echo "<td>". $row["ltype"]."</td>";
						echo "<td>". $row["sdate"]."</td>";
						echo "<td>". $row["edate"]."</td>";
						echo "<td>". $row["adate"]."</td>";
						echo "<td>". $row["reason"]."</td>";
						echo "<td>". $row["status"]."</td>";
						echo "<td><form method='post' action='delete.php'>";
						echo "<input type='submit' id='linbtn' value='Delete'>";
						echo "<input type='hidden' id='lid' name='lid' value='".$row["lid"]."'>";
						echo "<input type='hidden' id='status' name='status' value='".$row["status"]."'>";
						echo "<input type='hidden' id='type' name='type' value='".$row["ltype"]."'>";
						echo "<input type='hidden' id='sdate' name='sdate' value='".$row["sdate"]."'>";
						echo "<input type='hidden' id='edate' name='edate' value='".$row["edate"]."'>";
						echo "<input type='hidden' id='adate' name='adate' value='".$row["adate"]."'></form></td>";
						echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table>"; 
				echo "</div>";

				echo "<div class='table' id='leaveinfo'>";
				$sql = "SELECT type,ltaken,lavailable FROM leaveinfo where pid=$eid";
				$result = $con->query($sql);
				echo "<table style='width:100%'>";
				echo "<tr>";
				echo "<th>Type</th>";
				echo "<th>Taken</th>";
				echo "<th>Available</th>";
				echo "</tr>";
				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>". $row["type"]."</td>";
						echo "<td>". $row["ltaken"]."</td>";
						echo "<td>". $row["lavailable"]."</td>";
						echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table>"; 
				echo "</div>";

				echo "<div class='personal' id='salarycalc'>";
				echo "<h1><u>SALARY REPORT</u></h1>";
				$sql = "SELECT ltaken,lavailable FROM leaveinfo where pid=$eid";
				$result = $con->query($sql);
				$sum=0;
				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
						$sum=$row["ltaken"]+$sum;
				    }
				} else {
				    echo "0 results";
				}
				$extra=$sum-27;
				if ($extra<=0){
					echo "Leaves Limit not exceeded. Salary remains unaltered.<br>";
					echo "SALARY=".$rowpersonal["salary"];
				}else{
					echo "Leave limit exceeded. Warning! <br>";
					$original=$rowpersonal["salary"];
					$daily=round($original/30);
					echo "Number of Leaves exceeded = ".$extra."</br>";
					$cut=round($extra*$daily);
					echo "Salary Cut = ".$cut."<br>";
					$current=$original-$cut;
					echo "Current Salary = ".$current;
				}
				echo "</table>"; 
				echo "</div>";


			}			
		}else{
			echo "<h1>Failed to login!</h1>";
		}
	?>

</body>
</html>


