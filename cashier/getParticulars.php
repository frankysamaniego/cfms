<?php
	require("../include/dbcon.php");
	session_start();
	function getLastVoucherNo($x){
		global $mysqli;
		$sql = $mysqli->query("select * from vouchers where type='$x' order by id desc limit 1");
		if(mysqli_num_rows($sql) > 0){
			while($row = mysqli_fetch_assoc($sql)){
				return $row['voucherNo'];
			}
		}else{
			return "0";
		}
		
	}
	function getLastVoucherId(){
		global $mysqli;
		$sql = $mysqli->query("select * from vouchers order by id desc limit 1");
		if(mysqli_num_rows($sql) > 0){
			while($row = mysqli_fetch_assoc($sql)){
				return $row['id'];
			}
		}else{
			return "0";
		}
		
	}
	if(isset($_POST['particulars'])){
		$particulars = $_POST['particulars'];
		$particularAmount = $_POST['particularAmount'];
		if(!isset($_SESSION['particulars'])){
			$_SESSION['particulars'] = array();
		}
		array_push($_SESSION['particulars'],array("particulars"=>$particulars,"amount"=>$particularAmount));
		$total = 0;
		$arrCount = count($_SESSION['particulars']);
		if($arrCount>0){
			foreach($_SESSION['particulars'] as $key => $value){
				echo"<tr><td>".$value['particulars']."</td><td>".number_format($value['amount'],2)."<a href='javascript:void(0);' class='w3-text-red w3-right' onclick='removeFromArray(".$key.")'><i class='fa fa-remove'></i></a></td></tr>";
				$total = $total + $value['amount'];
			}
			echo "<tr><td class='w3-right'>TOTAL:</td><td><b>".number_format($total,2)."</b></td></tr>";
		}else{
			echo $arrCount;
		}
	}
	if(isset($_POST['delFromArray'])){
		$key = $_POST['delFromArray'];
		unset($_SESSION['particulars'][$key]);
		$total = 0;
		$arrCount = count($_SESSION['particulars']);
		if($arrCount>0){
			foreach($_SESSION['particulars'] as $key => $value){
				echo"<tr><td>".$value['particulars']."</td><td>".number_format($value['amount'],2)."<a href='javascript:void(0);' class='w3-text-red w3-right' onclick='removeFromArray(".$key.")'><i class='fa fa-remove'></i></a></td></tr>";
				$total = $total + $value['amount'];
			}
			echo "<tr><td class='w3-right'>TOTAL:</td><td><b>".number_format($total,2)."</b></td></tr>";
		}else{
			echo $arrCount;
		}
		
	}
	
	if(isset($_POST['payeeNameVoucher'])){
		$payee = $_POST['payeeNameVoucher'];
		$type = $_POST['voucherType'];
		$d = getDate();
		$now = $d[0];
		$requesteeId= $_SESSION['loggedInId'];
		$lastVoucher = getLastVoucherNo($type);
		$voucherNow = $lastVoucher + 1;
		//print_r($_SESSION);
		$c = count($_SESSION['particulars']);
		$counter = 0;
		$insert = $mysqli->query("insert into vouchers (requesteeId,voucherNo,requestDate,payee,type,status) values ('$requesteeId','$voucherNow','$now','$payee','$type','0')");
		if($insert){
			$lastVoucherId = getLastVoucherId();
			foreach($_SESSION['particulars'] as $key => $value){
				$particular = $value['particulars'];
				$amount = $value['amount'];
				$insertParticulars = $mysqli->query("insert into particulars (particulars,amount,voucherId) values ('$particular','$amount','$lastVoucherId')");
				if($insertParticulars){
					$counter++;
				}
			}
			if($counter == $c){
				echo "SUCCESS";
			}else{
				
			}
		}
		
	}
	
	
	
	if(isset($_POST['cancelVoucerRequestId'])){
		$id = $_POST['cancelVoucerRequestId'];
		$update = $mysqli->query("update vouchers set status='2' where id='$id'");
		if($update){
			echo "SUCCESS";
		}else{
			
		}
	}
?>