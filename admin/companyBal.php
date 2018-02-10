<?php
	//include("../include/dbcon.php");
?>
<script>
function checkCheckNum(evt){
		var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;
          return true;
	}
	
function updateBalance(){
	var balance =$('#balance').val();
	$.ajax({
		url:'process.php',
		type:'post',
		data:'updateBal='+balance,
		success:function(data){
			if(data == 'SUCCESS'){
				alert("Balance Updated!");
				window.location.reload();
			}
		}
	})
}
</script>
<div class="w3-row">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-money fa-fx"></i> Company Balance</h2><hr style="margin-top:0px;"/>
	<div class="w3-row">
		<div class="w3-half w3-padding">
			<h4>Update Balance</h4>
			<hr/>
			<form class="w3-form w3-container " action="javascript:void(0);" onsubmit="return updateBalance()">
				<label>Current Balance:</label>
				<input type="text" class="w3-input w3-border w3-small" onkeypress="return checkCheckNum(event)" id="balance" name="balance" />
				<br/>
				<input type="submit" class="w3-button w3-green" value="Update Balance">
			</form>
		</div>
		<div class="w3-half w3-padding">
			<h4>Balance Update History</h4>
			<hr/>
			<table class="w3-table-all">
				<thead>
					<th>Date</th>
					<th>Balance</th>
				</thead>
				<tbody>
					<?php
						$sql = $mysqli->query("select * from balance order by id asc");
						while($row = mysqli_fetch_assoc($sql)){
					?>
					<tr>
						<td><?php echo date('m/d/Y',$row['dateupdated']);?></td>
						<td><?php echo number_format($row['balance'],2);?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	
	</div>
</div>