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
	if(isset($_POST['disableId'])){
		$id = $_POST['disableId'];
		$disable = $mysqli->query("update projects set status='0' where id='$id'");
		if($disable){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
		
	}
	if(isset($_POST['enableId'])){
		$id = $_POST['enableId'];
		$disable = $mysqli->query("update projects set status='1' where id='$id'");
		if($disable){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
		
	}
	if(isset($_POST['usersEnableId'])){
		$id = $_POST['usersEnableId'];
		$disable = $mysqli->query("update users set status='1' where id='$id'");
		if($disable){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
		
	}
	if(isset($_POST['usersDisableId'])){
		$id = $_POST['usersDisableId'];
		$disable = $mysqli->query("update users set status='0' where id='$id'");
		if($disable){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
		
	}
	
	if(isset($_POST['userDel'])){
		$id = $_POST['userDel'];
		$del = $mysqli->query("delete from users where id='$id'");
		if($del){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
	}
	if(isset($_POST['projectDel'])){
		$id = $_POST['projectDel'];
		$del = $mysqli->query("delete from projects where id='$id'");
		if($del){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
	}
	
	
	
	if(isset($_POST['saveToAccounts'])){
		$fname = $_POST['firstName'];
		$mname = $_POST['middleName'];
		$lname = $_POST['lastName'];
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$type = $_POST['newAccountType'];
		$sql = $mysqli->query("select * from users where userName='$userName' and password='$password'");
		$num = mysqli_num_rows($sql);
		if($num > 0){
			echo "DUPLICATE";
		}else{
			$insert  = $mysqli->query("insert into users (firstName,middleName,lastName,userName,accountType,password,status) values ('$fname','$mname','$lname','$userName','$type','$password','1')");
			if($insert){
				echo "SUCCESS";
			}
		}
		
	}
	
	
	
	if(isset($_POST['approveVoucerRequestId'])){
		$id = $_POST['approveVoucerRequestId'];
		$approve = $mysqli->query("update vouchers set status='1' where id='$id'");
		if($approve){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
	}
	
	
	if(isset($_POST['cancelVoucerRequestId'])){
		$id = $_POST['cancelVoucerRequestId'];
		$approve = $mysqli->query("update vouchers set status='2' where id='$id'");
		if($approve){
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
	}
?>