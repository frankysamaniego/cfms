<?php
	require("../include/dbcon.php");
	$sql = $mysqli->query("SELECT * FROM `request` WHERE `status`=0");
	$num = mysqli_num_rows($sql);
	echo $num;
?>