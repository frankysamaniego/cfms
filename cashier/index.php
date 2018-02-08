<?php
	include("../include/dbcon.php");
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
	<script src="../js/dataTables.jqueryui.js"></script>
	<script src="../js/dataTables.jqueryui.min.js"></script>
	<script src="../js/datatables.js"></script>
	<script src="../js/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
    <script>
    $(document).ready(function(){
		//getData();
		//setInterval(getData,3000);
		
		 $('#requestTables').DataTable({
			 ordering: false,
			 select: false,
		 });
		 $('#approvedaa').DataTable({
			 ordering: false,
			 select: false,
		 });
	});
	
	
	
	function approve(x){
		var id = x;
		$.ajax({
			url:'process.php',
			type:'post',
			data:'approveId='+id,
			success:function(data){
				console.log(data);
				if(data == 'SUCCESS'){
					alert("Request Approved!")
					window.location.reload();
				}else{
					alert("Error!");
				}
			}
		})
	}
	
	
	function disaprove(x){
		var id =x;
		$.ajax({
			url:'process.php',
			type:'post',
			data:'disapproveId='+id,
			success:function(data){
				console.log(data);
				if(data  == "SUCCESS"){
					alert("Request Declined!");
					window.location.reload();
				}else{
					alert("Error!");
				}
			}
		})
	}
	
	
	
	
	
	function getData(){
		var notifData = $("#notifData").val();
			$.ajax({
				url:'getdata.php',
				type:'get',
				success:function(data){
					console.log(data);
					$('#notifRequest').html(data);
					$('#pendingNotif').html(data);
					$('#notifData').prop('value',data);
					if(data == notifData || notifData == "" || data < notifData){
						//donot play sound
						document.getElementById("sound").innerHTML="<audio><source src='notif.mp3' type='audio/mpeg'></audio>";
					}else{
						//play sound
						document.getElementById("sound").innerHTML="<audio autoplay><source src='notif.mp3' type='audio/mpeg'></audio>";
					}
				}
			});	
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
			<a href="javascript:void(0);" class="w3-bar-item w3-button">Account Details </a>
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
			</div>
		</div>
		<div class="w3-rest">
			<div class="w3-container w3-padding-16">
				<div class="w3-border w3-container w3-round w3-text-black">
                <div id="sound">
                	
                </div>
               
                <input type="hidden" id="notifData" value="">
					<?php
						if(isset($_GET['newProj'])){
							require('newProj.php');
						}else if(isset($_GET['projectAccount'])){
							require('projectAccount.php');
						}else if(isset($_GET['requests'])){
							require('requests.php');
						}else if(isset($_GET['compAccounts'])){
							require('compAccounts.php');
						}else if(isset($_GET['cashFlow'])){
							require('cashFlow.php');
						}else if(isset($_GET['voucher'])){
							require('voucher.php');
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