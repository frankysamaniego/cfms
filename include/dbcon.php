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
	
	function formatNumber($x){
		$d = getDate();
		$now = $d[0];
		$month = date('m',$now);
		$formattedNum = $month.''.sprintf('%08d', $x);
		return $formattedNum;
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
		$num = mysqli_num_rows($sql);
		if($num > 0){
				echo "<ul>";
					while($row = mysqli_fetch_assoc($sql)){
						
						echo "<li>".$row['particulars']." @ ".$row['amount']."</li>";
					}
				echo "</ul>";
		}else{
			$sql = $mysqli->query("select * from cashin where voucherId='$x'");
			if(mysqli_num_rows($sql) > 0){
				while($row = mysqli_fetch_assoc($sql)){
					return $row['particulars'];
				}
			}else{
				getProjParticulars($x);
			}
		}
	}
	function getProjParticulars($x){
		global $mysqli;
		$sql = $mysqli->query("select * from request where voucherId='$x'");
			echo "<ul>";
		while($row = mysqli_fetch_assoc($sql)){
			
			echo "<li>".$row['brand'].' ('.$row['type'].") @ ".$row['price']."</li>";
		}
			echo "</ul>";
	}
	function getParticularsTotal($x){
		global $mysqli;
		$sql = $mysqli->query("select * from particulars where voucherId='$x'");
		$total = 0;
		if(mysqli_num_rows($sql) > 0){
			while($row = mysqli_fetch_assoc($sql)){
				$total = $total + $row['amount'];
			}
			return $total;
		}else{
			return getProjParticularsTotal($x);
		}
	}
	function getProjParticularsTotal($x){
		global $mysqli;
		$sql = $mysqli->query("select * from request where voucherId='$x'");
			$total = 0;
		while($row = mysqli_fetch_assoc($sql)){
			$total = $total + ($row['price'] * $row['qty']);
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
	
	
	function getLastVoucherIda($x){
		global $mysqli;
		$sql = $mysqli->query("select * from vouchers where type='$x' and status='1' order by id desc");
		$c = mysqli_num_rows($sql);
		if($c > 0){
			while($row = mysqli_fetch_array($sql)){
				return $row['voucherNo'] + 1;
			}
		}else{
			return 1;
		}
		
	}

	function lastAprrovedVoucherNo(){
		global $mysqli;
		$sql = $mysqli->query("select * from vouchers where status='1' order by id desc limit 1");
		$c = mysqli_num_rows($sql);
		$now = getDate();
		$month  = date('m',$now[0]);
		$year  = date('Y',$now[0]);
		if($c > 0){
			while($row = mysqli_fetch_array($sql)){
				$monthFromDb = date('m',$row['requestDate']);
				$yearFromDb = date('Y',$row['requestDate']);
				
				if($yearFromDb == $year){
					if($monthFromDb == $monthFromDb){
						return $row['voucherNo'] + 1;
					}else{
						return 1;
					}
				}else{
					return 1;
				}
				//if()
			}
		}else{
			return 1;
		}
	}
	
	
	function getProjectName($x){
		global $mysqli;
		$sql = $mysqli->query("select * from projects where id='$x'");
		while($row = mysqli_fetch_array($sql)){
			return $row['projectName'];
		}
	}
	
	
	function getLastIdOfVoucher(){
		global $mysqli;
		$sql = $mysqli->query("select * from vouchers order by id desc limit 1");
		while($row = mysqli_fetch_array($sql)){
			return $row['id'];
		}
	}
	
	function getCashIn($x){
		global $mysqli;
		$sql = $mysqli->query("select * from cashin where voucherId='$x'");
		while($row = mysqli_fetch_assoc($sql)){
			return $row['amount'];
		}
	}
	
	function getLatestBal(){
		global $mysqli;
		$totalBal = 0;
		$sql = $mysqli->query("select * from balance order by id desc limit 1");
		while($row = mysqli_fetch_assoc($sql)){
			$totalBal = $totalBal + $row['balance'];
		}
		$query = $mysqli->query("select * from projects");
		while($r = mysqli_fetch_assoc($query)){
			$totalBal = $totalBal + $r['initialBudget'];
		}
		return $totalBal;
	}
	function getCompBal(){
		global $mysqli;
		$sql = $mysqli->query("select * from balance order by id desc limit 1");
		while($row = mysqli_fetch_assoc($sql)){
			return $row['balance'];
		}
	}
	function getLateseUp(){
		global $mysqli;
		$sql = $mysqli->query("select * from balance order by id desc limit 1");
		while($row = mysqli_fetch_assoc($sql)){
			return $row['dateupdated'];
		}
	}
	
	function getLastProjId(){
		global $mysqli;
		$sql = $mysqli->query("select * from projects order by id desc limit 1");
		while($row = mysqli_fetch_assoc($sql)){
			return $row['id'];
		}
	}
?>