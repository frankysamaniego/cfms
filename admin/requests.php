<div class="w3-row w3-padding-16">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-road fa-fx"></i> Project Requests</h2><hr style="margin-top:0px;"/>
	<div class="w3-bar w3-white">
    <button class="w3-bar-item w3-button tablink w3-blue" onclick="openCity(event,'pending')">Pending <span  class="notifData w3-small w3-badge w3-white" id="pendingNotif"></span></button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'approved')">Approved</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'declined')">Declined</button>
  </div>
  
  <div id="pending" class="w3-container city">
    <h4>Pending Requests</h4>
    <div class="w3-row w3-padding-16">
		<table class="w3-table w3-small row-border" id="requestTables">
			<thead>
				<tr class="w3-borderbottom">
					<th>Date of Request</th>
					<th>Payee</th>
					<th>Type</th>
					<th>Particulars</th>
					<th>Total Amount</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = $mysqli->query("select * from vouchers where vFrom ='1' and status = '0'");
					while($row = mysqli_fetch_assoc($query)){
				?>
				<tr>
					<td><?php echo date('m/d/Y',$row['requestDate']);?></td>
					<td><?php echo $row['payee']?></td>
					<td><?php echo getVoucherType($row['type'])?></td>
					<td><?php echo getProjParticulars($row['id']);?></td>
					<td><?php echo number_format(getProjParticularsTotal($row['id']),2);?></td>
					<td style="text-align:center">
						<a href="javascript:void(0);" onclick="approve(<?php echo $row['id']?>)" class=" w3-small"><i class="fa fa-check fa-1x"></i></a>
						<a href="javascript:void(0);" onclick="disaprove(<?php echo $row['id']?>)" class=" w3-small w3-text-red"><i class="fa fa-trash fa-1x"></i></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
  </div>

  <div id="approved" class="w3-container city" style="display:none">
      <h4>Approved Requests</h4>
    <table class="w3-table w3-small row-border" class="approvedTable" id="approvedaa">
			<thead>
				<tr class="w3-borderbottom">
					<th>Voucher No.</th>
					<th>Date of Request</th>
					<th>Payee</th>
					<th>Type</th>
					<th>Particulars</th>
					<th>Total Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = $mysqli->query("select * from vouchers where vFrom ='1' and status = '1'");
					while($row = mysqli_fetch_assoc($query)){
				?>
				<tr>
					<td><?php echo $row['voucherNo'];?></td>
					<td><?php echo date('m/d/Y',$row['requestDate']);?></td>
					<td><?php echo $row['payee']?></td>
					<td><?php echo getVoucherType($row['type'])?></td>
					<td><?php echo getProjParticulars($row['id']);?></td>
					<td><?php echo number_format(getProjParticularsTotal($row['id']),2);?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
  </div>

  <div id="declined" class="w3-container city" style="display:none">
    <h4>Disapproved Requests</h4>
    <table class="w3-table w3-small row-border" class="approvedTable" id="declinedData">
			<thead>
				<tr class="w3-borderbottom">
					<th>Date of Request</th>
					<th>Payee</th>
					<th>Type</th>
					<th>Particulars</th>
					<th>Total Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = $mysqli->query("select * from vouchers where vFrom ='1' and status = '2'");
					while($row = mysqli_fetch_assoc($query)){
				?>
				<tr>
					<td><?php echo date('m/d/Y',$row['requestDate']);?></td>
					<td><?php echo $row['payee']?></td>
					<td><?php echo getVoucherType($row['type'])?></td>
					<td><?php echo getProjParticulars($row['id']);?></td>
					<td><?php echo number_format(getProjParticularsTotal($row['id']),2);?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
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