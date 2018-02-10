<div class="w3-row w3-padding-16">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-road fa-fx"></i> Project Requests</h2><hr style="margin-top:0px;"/>
	<div class="w3-bar w3-white">
    <button class="w3-bar-item w3-button tablink w3-blue" onclick="openCity(event,'approved')">Approved</button>
    <button class="w3-bar-item w3-button tablink " onclick="openCity(event,'pending')">Pending <span  class="notifData w3-small w3-badge w3-white" id="pendingNotif"></span></button>
    <button class="w3-bar-item w3-button tablink " onclick="openCity(event,'printedV')">Printed <span  class="notifData w3-small w3-badge w3-white" id=></span></button>
  </div>
  
  <div id="pending" class="w3-container city" style="display:none">
    <div class="w3-row w3-padding-16">
		<table class="w3-table w3-small row-border" id="requestTables">
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
					$query = $mysqli->query("select * from vouchers where vFrom ='1' and status = '0'");
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
  <div id="printedV" class="w3-container city" style="display:none">
    <div class="w3-row w3-padding-16">
		<table class="w3-table w3-small row-border" id="printedVoucher">
			<thead>
				<tr class="w3-borderbottom">
					<th>Date of Request</th>
					<th>Payee</th>
					<th>Type</th>
					<th>Particulars</th>
					<th>Total Amount</th>
					<th>Reprint</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = $mysqli->query("select * from vouchers where vFrom ='1' and checkNo !='' and status = '1'");
					while($row = mysqli_fetch_assoc($query)){
				?>
				<tr>
					<td><?php echo date('m/d/Y',$row['requestDate']);?></td>
					<td><?php echo $row['payee']?></td>
					<td><?php echo getVoucherType($row['type'])?></td>
					<td><?php echo getProjParticulars($row['id']);?></td>
					<td><?php echo number_format(getProjParticularsTotal($row['id']),2);?></td>
					<td><a class="w3-text-blue" target="_new" href="voucherPrint.php?voucherType=<?php echo $row['type']?>&voucherid=<?php echo dechex($row['id'])?>"><i class=" fa fa-print fa-lg"></i></a></td>
					
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
  </div>

  
  
  
  
  
  <div id="approved" class="w3-container city" >
  <div class="w3-row w3-padding-16">
    <table class="w3-table w3-small row-border" class="approvedTable" id="approvedaa">
			<thead>
				<tr class="w3-borderbottom">
					<th>Voucher No.</th>
					<th>Date of Request</th>
					<th>Payee</th>
					<th>Type</th>
					<th>Particulars</th>
					<th>Total Amount</th>
					<th>Print</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = $mysqli->query("select * from vouchers where vFrom ='1' and checkNo='' and status = '1'");
					while($row = mysqli_fetch_assoc($query)){
				?>
				<tr>
					<td><?php echo $row['voucherNo'];?></td>
					<td><?php echo date('m/d/Y',$row['requestDate']);?></td>
					<td><?php echo $row['payee']?></td>
					<td><?php echo getVoucherType($row['type'])?></td>
					<td><?php echo getProjParticulars($row['id']);?></td>
					<td><?php echo number_format(getProjParticularsTotal($row['id']),2);?></td>
					<td>
						<!--<a class="w3-text-blue" target="_new" href="voucherPrint.php?voucherType=<?php echo $row['type']?>&voucherid=<?php echo dechex($row['id'])?>"><i class=" fa fa-print fa-lg"></i></a>-->
						<a href="javacsript:void(0);" onclick="document.getElementById('checkNoModal_<?php echo $row['id']?>').style.display='block'" ><i class=" fa fa-print fa-lg"></i></a>
					</td>
				</tr>
				
				<div id="checkNoModal_<?php echo $row['id']?>" class="w3-modal">
					 <div class="w3-modal-content w3-card-4 w3-animate-opacity" style="width:400px;">
					  <header class="w3-container w3-blue"> 
					   <span onclick="document.getElementById('checkNoModal_<?php echo $row['id']?>').style.display='none'" 
					   class="w3-button w3-blue w3-small w3-display-topright">&times;</span>
					   <h4>Please Provide the check Number</h4>
					  </header>
					  <div class="w3-row">
						<div class="w3-container w3-padding">
							<form class="w3-form " action="javascript:void(0);" onsubmit="updateVoucherWithCheckNum(<?php echo $row['id']?>)" method="post">
								<label>Check Number:</label>
								<input type="text" name="checkNum_<?php echo $row['id']?>" class="w3-input w3-border checkNumBox" onkeypress="return checkCheckNum(event)" id="checkNum_<?php echo $row['id']?>" autocomplete="off" required>
								<input type="hidden" name="checkType_<?php echo $row['id']?>" id="checkType_<?php echo $row['id']?>" value="<?php echo $row['type']?>">
								<input type="hidden" name="voucher_id_<?php echo $row['id']?>" id="voucher_id_<?php echo $row['id']?>" value="<?php echo dechex($row['id'])?>">
								<br/>
								<input type="submit"  class="w3-button w3-block w3-green" value="Submit Check Number" name="checkCnum">
							</form>
						</div>
					  </div>
					 </div>
					</div>

					</div>

				
				
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