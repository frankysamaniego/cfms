<?php
	session_start();
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
		$result = $mysqli->query($sql);
		if($result->num_rows > 0){
			while($rows = $result->fetch_assoc()){
				$_SESSION['loggedInType'] = $rows['accountType'];
				$_SESSION['loggedInId'] = $rows['id'];
			}
			echo $_SESSION['loggedInType'];
		}else{
			echo "User does not exists!";
		}
	}
	
?>