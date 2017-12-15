<?php
	date_default_timezone_set("Asia/Manila");
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "cfms";
	$mysqli = new mysqli($servername, $username, $password,$db);
?>