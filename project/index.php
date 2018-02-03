<?php
	require('../include/dbcon.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="#">
	<link rel="stylesheet" type="text/css" href="../css/style.css">	
	<link rel="stylesheet" type="text/css" href="../google/fafa.css">	
	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.js"></script>
	<script src="../js/actions.js"></script>
    <script>
    $(document).ready(function(){
		//setInterval(getData,3000);
	});
	
	function getData(){
		var notifData = $("#notifData").val();
			$.ajax({
				url:'getdata.php',
				type:'get',
				success:function(data){
					console.log(data);
					$('#notifRequest').html(data);
					$('#notifData').prop('value',data);
					if(data == notifData || notifData == ""){
						//donot play sound
						document.getElementById("sound").innerHTML="<audio><source src='notif.mp3' type='audio/mpeg'></audio>";
					}else{
						//play sound
						document.getElementById("sound").innerHTML="<audio autoplay><source src='notif.mp3' type='audio/mpeg'></audio>";
					}
				}
			});	
		}
		
		function removeSessionKey(x){
			$.ajax({
				url:'process.php',
				type:'post',
				cache:false,
				data:'delFromSession='+x,
				success:function(data){
					window.location.reload();
				}
			})
		}
		
		function submitRequest(){
			var aa = true;
			$.ajax({
				url:'process.php',
				type:'post',
				cache:false,
				data:'confirmRequest='+aa,
				success:function(data){
					console.log(data);
					if(data == "SUCCESS"){
						alert("Request complete!");
					}else{
						alert("Request error!!");
					}
					//window.location.reload();
				}
			})
		}
    </script>
	<style>
		.w3-bar-item:hover{
			background-color:#afd2d2 !important;
			font-weight:bold;
		}
		@media only screen and (min-width: 600px) {
		/* For small screens: */
			
		}@media only screen and (min-width: 600px) {
		/* For tablets: */
			
		}
		@media only screen and (min-width: 1025px) {
			/* For screens: higer than 768 px */
			#left_menu_container{
				margin:4% 5% 1%;
			}
		}
		@media only screen and (max-width: 768px) {
			/* For screens: higer than 768 px */
			#left_menu_container{
				margin:5% 0% 0%;
			}
		}
		.w3-pale-blue{
			background-color:#008cba !important;
		}
		.active{
			background-color:#008cba;
			color:#fff;
		}
	</style>
</head>
<body>
<div class="w3-top">
  <div class="w3-bar w3-pale-blue" style="letter-spacing:4px;border-bottom:solid 2px #f1f1f1;">
    <a href="#home" class="w3-bar-item w3-button">&nbsp;</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
		<div class="w3-right w3-hide-small">
			<a href="javascript:void(0);" class="w3-bar-item w3-button">Account Details <span id="notifRequest" class="w3-badge"></span></a>
			<a href="../include/logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out fa-fx"></i> Logout</a>
		</div>
	</div>
</div>	
<div class="w3-row" id="left_menu_container" style="">
	<div class="w3-container">
		<div class="w3-third" style="background-color:#fafafa;">
			<div class="w3-container w3-padding-16">
				<nav class="w3-bar-block w3-border w3-white w3-round" style="margin-left:20px;margin-right:20px;">
					<div class="w3-text-blue">
						<?php require('links.php');?>
					</div>
					
				</nav>
				<hr/>
				<div class="w3-row">
					<h3 class="w3-bottombar">Current Request</h3>
					<table class="w3-table w3-table-all w3-small" id="currentRequestTable">
						<thead>
							<tr>
								<th>Item</th>
								<th>Qtty.</th>
								<th>Price</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach($_SESSION['requests'] as $key=>$value){
							echo "<tr><td>".$value['itemBrandRequest']." </td><td> ".$value['itemQuantityRequest']."</td><td>".$value['itemPriceRequest']."</td><td><a href='javascript:void(0)' onclick='removeSessionKey(".$key.")'><span class='fa fa-remove'></span></a></td></tr>";
							}
						?>
						</tbody>
					</table>
					<br/>
					<button class="w3-btn w3-green w3-small w3-block" onclick="submitRequest()">Confirm Request</button>
				</div>
			</div>
		</div>
		<div class="w3-rest">
			<div class="w3-container w3-padding-16">
				<div class="w3-border w3-container w3-round w3-text-black">
                <div id="sound">
                	
                </div>
               
                <input type="hidden" id="notifData" value="">
					<?php
						if(isset($_GET['requests'])){
							require('requests.php');
						}else{
							require('home.php');
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>