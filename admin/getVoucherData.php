<?php
	require("../include/dbcon.php");
	//$requestNum = $mysqli->query("SELECT * FROM `request` WHERE `status`='0' ");
	$check = $mysqli->query("select * from vouchers where status = '0' and vFrom != '1'");
	$num = mysqli_num_rows($check);
	
	//$requestNum = $mysqli->query("select * from request where status = '0'");;
	//$mysqli->query("select * from projects where projectCode='$projectCode' and projectName='$projectName'");
	//echo $sql;
	//$num = mysqli_num_rows($requestNum);
	echo $num;
?>