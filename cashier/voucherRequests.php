<?php
	//print_r($_SESSION);
	$loggedId = $_SESSION['loggedInId'];
?>
<script>
	function cancelVoucher(x){
		var id = x;
		var cc =confirm("Are you sure to cancel request?");
		if(cc){
			$.ajax({
				url:'getParticulars.php',
				type:'post',
				data:'cancelVoucerRequestId='+id,
				success:function(data){
					if(data == "SUCCESS"){
						$('#todelCancel_'+id).fadeOut('slow');
					}else{
						
					}
				}
			});
		}else{
			
		}
		
	}
</script>
<div class="w3-row w3-padding-16">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-road fa-fx"></i> Voucher Requests</h2><hr style="margin-top:0px;"/>
	<div class="w3-bar w3-white">
    <button class="w3-bar-item w3-button tablink w3-blue" onclick="openCity(event,'approved')">Approved</button>
    <button class="w3-bar-item w3-button tablink " onclick="openCity(event,'pending')">Pending <span  class="notifData w3-small w3-badge w3-white" id="pendingNotif"></span></button>
  </div>
  
  <div id="pending" class="w3-container city" style="display:none">
    <div class="w3-row w3-padding-16">
		<table class="w3-table row-border w3-small stripped" id="requestTables">
			<thead>
				<tr class="w3-borderbottom">
					<th>Voucher No.</th>
					<th>Date of Request</th>
					<th>Payee</th>
					<th>Type</th>
					<th>Particulars</th>
					<th>Total Amount</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = $mysqli->query("select * from vouchers where requesteeId='$loggedId' and status='0'");
					while($row = mysqli_fetch_assoc($query)){
				?>
				<tr id="todelCancel_<?php echo $row['id']?>">
					<td><?php echo $row['voucherNo'];?></td>
					<td><?php echo date('m/d/Y',$row['projectId']);?></td>
					<td><?php echo ucwords($row['payee'])?></td>
					<td><?php echo getVoucherType($row['type'])?></td>
					<td><?php echo getParticulars($row['id'])?></td>
					<td><?php echo getParticularsTotal($row['id'])?></td>
					<td class="w3-center">
						<a href="javascript:void(0)" class="w3-text-red" onclick="cancelVoucher(<?php echo $row['id']?>)" alt="Cancel" title="Cancel"><i class="fa fa-remove"></i></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
  </div>

  <div id="approved" class="w3-container city" >
  <div class="w3-row w3-padding-16">
		<table class="w3-table row-border w3-small" class="approvedTable" id="approvedaa">
			<thead>
				<tr class="w3-borderbottom">
					<th>Voucher No.</th>
					<th>Date of Request</th>
					<th>Payee</th>
					<th>Type</th>
					<th>Particulars</th>
					<th>Total Amount</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = $mysqli->query("select * from vouchers where requesteeId='$loggedId' and status='1'");
					while($row = mysqli_fetch_assoc($query)){
				?>
				<tr id="todelCancel_<?php echo $row['id']?>">
					<td><?php echo $row['voucherNo'];?></td>
					<td><?php echo date('m/d/Y',$row['projectId']);?></td>
					<td><?php echo ucwords($row['payee'])?></td>
					<td><?php echo getVoucherType($row['type'])?></td>
					<td><?php echo getParticulars($row['id'])?></td>
					<td><?php echo getParticularsTotal($row['id'])?></td>
					<td class="w3-center">
						<a href="voucherPrint.php?requests=true&transId=<?php echo $row['id']?>&voucherType=<?php echo $row['type'];?>" class="w3-text-red" onclick="cancelVoucher(<?php echo $row['id']?>)" alt="Cancel" title="Cancel"><i class="fa fa-print"></i></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
  </div>
  </div>

</div>

<script>
	function openCity(evt, cityName) {
	  var i, x, tablinks;
	  x = document.getElementsByClassName("city");
	  for (i = 0; i < x.length; i++) {
		  x[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablink");
	  for (i = 0; i < x.length; i++) {
		  tablinks[i].className = tablinks[i].className.replace(" w3-blue", "");
	  }
	  document.getElementById(cityName).style.display = "block";
	  evt.currentTarget.className += " w3-blue";
	}
</script>
</div>