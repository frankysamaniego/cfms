	<?php
	date_default_timezone_set("Asia/Manila");
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "cfms";
	$mysqli = new mysqli($servername, $username, $password,$db);
	
	function getStatus($x){
		$stat = "";
		if($x == 0){
			$stat = "Pending";
		}else if($x == 1){
			$stat = "Approved";
		}else if($x == 3){
			$stat = "Declined";
		}else{
			$stat = "Undefined";
		}
		return $stat;
	}
	
	
	
	
	function getProjectCode($x){
		global $mysqli;
		$result = $mysqli->query("select * from projects where id='$x'");
		while($row = mysqli_fetch_assoc($result)){
			return $row['projectCode'];
		}
	}
	function getIncharge($x){
		global $mysqli;
		$result = $mysqli->query("select * from projects where id='$x'");
		while($row = mysqli_fetch_assoc($result)){
			return $row['projectInCharge'];
		}
	}
	
	function getProjStatus($x){
		if($x == 1){
			return $stat = "Enabled";
		}else{
			return $stat = "Disabled";
		}
	}
	function getAccountType($x){
		if($x == 1){
			return $type="Admin";
		}else if($x == 2){
			return $type = "Cashier";
		}else{
			return $type="Undefined";
		}
	}
?>