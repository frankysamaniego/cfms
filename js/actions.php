<?php
	require("../include/dbcon.php");
	//PHP FUNCTIONS
	function getUserInfo($x){
		$userId = $x;
		$sql = "select * from users where id='$userId'";
		$result = $mysqli->query($sql);
		while($rows = $result->fetch_assoc()){
			$full_name = $rows['firstName'].' '.$rows['middleName'].' '.$rows['lastName'];
		}
		return ucwords($full_name);
	}
	
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	
	//POST REQUESTS
	if(isset($_POST['loginUser'])){
		$us = mysqli_real_escape_string($mysqli,$_POST['loginUser']);
		$pw = mysqli_real_escape_string($mysqli,$_POST['loginPw']);
		$sql = "select * from users where userName = '$us' and password='$pw' and status='1'";
		$sql1 = "select * from projects where projectCode = '$us' and projectPass='$pw' and status='1'";
		$result = $mysqli->query($sql);
		$result1 = $mysqli->query($sql1);
		if($result->num_rows > 0){
			while($rows = $result->fetch_assoc()){
				$_SESSION['loggedInType'] = $rows['accountType'];
				$_SESSION['loggedInId'] = $rows['id'];
			}
			echo $_SESSION['loggedInType'];
		}else if($result1->num_rows > 0){
			while($rows1 = $result1->fetch_assoc()){
				$_SESSION['loggedInId'] = $rows1['id'];
				$_SESSION['projectCode']= $rows1['projectCode'];
			}
			echo "3";
		}else{
			echo "User does not exists!";
		}
	}
	
	
	
	
	
	
	
	
	//reqest from project
	if(isset($_POST['itemBrandRequest'])){
		//unset($_SESSION['requests']);
		if(isset($_SESSION['requests'])){
			
		}else{
			$_SESSION['requests'] = array();
		}
		if(!in_array($_POST,$_SESSION['requests'])){
			array_push($_SESSION['requests'] ,$_POST);
		}
		print_r($_SESSION['requests']);
		/*print_r($_POST);
		$itemBrandRequest = $_POST['itemBrandRequest'];
		$itemTypeRequest = $_POST['itemTypeRequest'];
		$itemPriceRequest = $_POST['itemPriceRequest'];
		$itemQuantityRequest = $_POST['itemQuantityRequest'];
		print_r($_SESSION);
		$insert = $mysqli->query("insert into `request` values ('NULL','{$_SESSION['loggedInId']}','$itemBrandRequest','$itemTypeRequest','$itemQuantityRequest','$itemPriceRequest','','')") or die(mysqli_error());
		*/
	}
	
?>