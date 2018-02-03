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
	
	if(isset($_POST['delFromSession'])){
		$id = $_POST['delFromSession'];
		unset($_SESSION['requests'][$id]);
	}
	if(isset($_POST['confirmRequest'])){
		$arr_count = count($_SESSION['requests']);
		$counter = 0;
		foreach($_SESSION['requests'] as $key => $value){
			$itemBrandRequest = $value['itemBrandRequest'];
			$itemTypeRequest = $value['itemTypeRequest'];
			$itemPriceRequest = $value['itemPriceRequest'];
			$itemQuantityRequest = $value['itemQuantityRequest'];
			//print_r($_SESSION);
			$insert = $mysqli->query("insert into `request` values ('NULL','{$_SESSION['loggedInId']}','$itemBrandRequest','$itemTypeRequest','$itemQuantityRequest','$itemPriceRequest','','')") or die(mysqli_error());
			$counter++;
		}
		if($arr_count == $counter){
			echo "SUCCESS";
		}
	}
?>



