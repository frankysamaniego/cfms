<?php
	/*
		user account levels
			1  = Super Admin
			2  = Admin
			3  = Project
		user status
			1 = active
			2 = disabled
	*/
	require('include/dbcon.php');
	//print_r($_SESSION);
	if($_SESSION['loggedInType'] == 1){
		header('location:admin/');
	}else if($_SESSION['loggedInType'] == 2){
		header('location:admin/');
	}else if($_SESSION['loggedInType'] == 3){
		header('location:project/');
	}else{
		
	}
?>


<html lang="en">
<head>
	<title>CFMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="#">
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">	
	<link rel="stylesheet" type="text/css" href="google/fafa.css">	
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.js"></script>
	<style>
		@media only screen and (min-width: 600px) {
		/* For small screens: */
			
		}@media only screen and (min-width: 600px) {
		/* For tablets: */
			
		}
		@media only screen and (min-width: 769px) {
			/* For screens: higer than 768 px */
			.login_form{
				max-width:400px;
				margin:9% auto;
			}
		}
		.inputBoxContainer{
			border-left:1px solid #f1f1f1;
			border-bottom:1px solid #f1f1f1;
			border-right:1px solid #f1f1f1;
			padding-top:20px;
		}
		input[type="text"]:focus,input[type="password"]:focus{
			box-shadow:none !important;
			border-color:blue;
		}
	</style>
	<script src="js/actions.js"></script>
</head>
<body>
	<div class="w3-row" id="">
		<div class="w3-container login_form">
			<div class="w3-row-padding w3-padding-16 w3-light-grey w3-center">
				<!--<img src="img/logo.png" />-->
				<span class="w3-padding" >
					<i class="fa fa-sitemap fa-4x w3-card-2" style="border:2px dashed #fff;padding:10px 12px;;border-radius:50%;"></i>
				</span>
			</div>
			<div class="w3-row-padding w3-text-black inputBoxContainer" >
				<div id="status"></div>
				<form class="w3-container" action="javascript:void(0);" onsubmit="return login()">
					<div>
						<label>Username</label>
						<input class="w3-input" type="text" name="usName" id="usName" placeholder="Username"  required>
					</div>
					<div>
						<label>Password</label>
						<input class="w3-input" type="password"  name="pWord" id="pWord"  placeholder="Password" required>
					</div>
					<p>
						<button class="w3-button w3-section w3-block w3-teal w3-ripple"> Login </button>
					</p>
				</form>
			</div>
		</div>
	</div>
</body>
</html>