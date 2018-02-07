<div class="w3-row w3-padding-16">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-road fa-fx"></i> Project Requests</h2><hr style="margin-top:0px;"/>
	<div class="w3-bar w3-white">
    <button class="w3-bar-item w3-button tablink w3-blue" onclick="openCity(event,'approved')">Approved</button>
    <button class="w3-bar-item w3-button tablink " onclick="openCity(event,'pending')">Pending <span  class="notifData w3-small w3-badge w3-white" id="pendingNotif"></span></button>
  </div>
  
  <div id="pending" class="w3-container city" style="display:none">
    <div class="w3-row w3-padding-16">
		<table class="w3-table w3-small" id="requestTables">
			<thead>
				<tr class="w3-borderbottom">
					<th>Project Code</th>
					<th>Project In-Charge</th>
					<th>Brand</th>
					<th>Type</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = $mysqli->query("select * from request where status='0'");
					while($row = mysqli_fetch_assoc($query)){
				?>
				<tr>
					<td><?php echo getProjectCode($row['projectId']);?></td>
					<td><?php echo getIncharge($row['projectId']);?></td>
					<td><?php echo $row['brand']?></td>
					<td><?php echo $row['type']?></td>
					<td><?php echo $row['price']?></td>
					<td><?php echo $row['qty']?></td>
					<td><?php echo $row['qty'] * $row['price']?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
  </div>

  <div id="approved" class="w3-container city" >
  <div class="w3-row w3-padding-16">
    <table class="w3-table w3-small" class="approvedTable" id="approvedaa">
			<thead>
				<tr class="w3-borderbottom">
					<th>Project Code</th>
					<th>Project In-Charge</th>
					<th>Brand</th>
					<th>Type</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
					<th>Print</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = $mysqli->query("select * from request where status='1'");
					while($row = mysqli_fetch_assoc($query)){
				?>
				<tr>
					<td><?php echo getProjectCode($row['projectId']);?></td>
					<td><?php echo getIncharge($row['projectId']);?></td>
					<td><?php echo $row['brand']?></td>
					<td><?php echo $row['type']?></td>
					<td><?php echo $row['price']?></td>
					<td><?php echo $row['qty']?></td>
					<td><?php echo $row['qty'] * $row['price']?></td>
					<td>
						<div class="w3-dropdown-hover">
							<a href="javascript:void(0);" class="w3-btn"><i class="fa fa-print fa-lg"></i></a>
							<div class="w3-dropdown-content w3-bar-block  w3-border" style="margin-left: -180px !important;margin-top: -30px !important;">
							  <a href="?requests=true&transId=<?php echo $row['id']?>&voucherType=1" class="w3-bar-item w3-button">Cash Voucher</a>
							  <a href="?requests=true&transId=<?php echo $row['id']?>&voucherType=2" class="w3-bar-item w3-button">Check Voucher</a>
							</div>
						  </div>
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