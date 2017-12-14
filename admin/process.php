<?php
	session_start();
	if(isset($_GET['projectCode'])){
		$projectCode = $_GET['projectCode'];
		$projectName = $_GET['projectName'];
		$projectLoc = $_GET['projectLoc'];
		$projectInCharge = $_GET['projectInCharge'];
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		$projectPass = $_GET['projectPass'];
		//code to be executed after catching all the data from form
	}
?>