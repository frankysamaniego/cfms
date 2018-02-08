<?php
	require("../include/dbcon.php");
session_start();
	function getLastVoucherNo(){
		
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
	
	if(isset($_POST['confirmVoucherRequests'])){
		$payee = $_SESSION['payeeInfo']['payee'];
		$type = $_SESSION['payeeInfo']['voucherType'];
		$d = getDate();
		$now = $d[0];
		$requesteeId= $_SESSION['loggedInId'];
		$lastVoucher = getLastVoucherNo();
		
		//$insert = $mysqli->query("")
	}
?>