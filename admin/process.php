<?php
	include('../include/dbcon.php');
	session_start();
	if(isset($_GET['projectCode'])){
		$projectCode = $_GET['projectCode'];
		$projectName = $_GET['projectName'];
		$projectLoc = $_GET['projectLoc'];
		$projectInCharge = $_GET['projectInCharge'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$initialBudget=$_GET['initBudget'];
		$projectPass = $_GET['projectPass'];
		$projectCost = $_GET['projectCost'];
		//code to be executed after catching all the data from form
		$check = $mysqli->query("select * from projects where projectCode='$projectCode' and projectName='$projectName'");
		$num = mysqli_num_rows($check);
		if($num > 0){
			echo "Project Exists!";
		}else{
			//insert this new project
			$insert = $mysqli->query("insert into `projects` (projectCode,projectName,projectLocation,projectInCharge,startDate,endDate,projectPass,initialBudget,projectCost,status) values ('$projectCode','$projectName','$projectLoc','$projectInCharge','$startDate','$endDate','$projectPass','$initialBudget','$projectCost','1')") or die(mysqli_error());
			if($insert){
				echo "SUCCESS";
			} 
		}
	}
	
	if(isset($_POST['approveId'])){
		$id =$_POST['approveId'];
		$approve = $mysqli->query("update request set status='1' where id='$id'");
		if($approve){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
	}
	
	if(isset($_POST['disapproveId'])){
		$id = $_POST['disapproveId'];
		$disapprove = $mysqli->query("update request set status='2' where id='$id'");
		if($disapprove){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
	}
?>