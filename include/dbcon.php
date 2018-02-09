<?php
	session_start();
	date_default_timezone_set("Asia/Manila");
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
	
	function getParticulars($x){
		global $mysqli;
		$sql = $mysqli->query("select * from particulars where voucherId='$x'");
			echo "<ul>";
		while($row = mysqli_fetch_assoc($sql)){
			
			echo "<li>".$row['particulars']." @ ".$row['amount']."</li>";
		}
			echo "</ul>";
	}
	function getParticularsTotal($x){
		global $mysqli;
		$sql = $mysqli->query("select * from particulars where voucherId='$x'");
			$total = 0;
		while($row = mysqli_fetch_assoc($sql)){
			$total = $total + $row['amount'];
		}
		return $total;
	}
	
	
	function getVoucherType($x){
		if($x == 1){
			return $type = "Cash";
		}else if($x == 2){
			return $type = "Check";
		}else{
			return $type = "Unknown";
		}
	}
?>