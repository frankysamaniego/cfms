<?php
	if(isset($_SESSION['payeeInfo']) || $_SESSION['particulars']){
		//echo "<pre>",print_r($_SESSION),"</pre>";
		unset($_SESSION['payeeInfo']);
		unset($_SESSION['particulars']);
	}else{
		if(isset($_POST['voucherPayee']) && isset($_POST['voucherType'])){
			$payee = addslashes($_POST['voucherPayee']);
			$type = addslashes($_POST['voucherType']);
			$_SESSION['payeeInfo'] = array("payee"=>$payee,"voucherType"=>$type);
		}
	}
?>



<script>
function addParticulars(){
	var particulars = $('#voucherParticulars').val();
	var particularAmount = $('#particularAmount').val();
	$.ajax({
		url:'getParticulars.php',
		type:'post',
		data:'particulars='+particulars+'&particularAmount='+particularAmount,
		success:function(data){
			console.log(data);
			if(data == 0){
				$('#confirmVoucher').prop('disabled',true);
			}else{
				$('#confirmVoucher').prop('disabled',false);
				$('#particulars tbody').html(data);
				$('#voucherParticulars').val('');
				$('#particularAmount').val('');
			}
			
		}
	});
}
function removeFromArray(x){
	$.ajax({
		url:'getParticulars.php',
		type:'post',
		data:'delFromArray='+x,
		success:function(data){
			if(data == 0){
				$('#confirmVoucher').prop('disabled',true);
				var aa = "<tr><td colspan='2' class='w3-center'>***** NOTHING *****</td></tr>";
				$('#particulars tbody').html(aa);
			}else{
				$('#confirmVoucher').prop('disabled',false);
				$('#particulars tbody').html(data);
			}
		}
	})
}


function confirmRequest(){
	var t = confirm("You are about to send request? Proceed?");
	var payee = $('#payeeee').val();
	var voucherType = $('#voucherTypeAdd').val();
	if(t){
		$.ajax({
			url:'getParticulars.php',
			type:'post',
			data:'confirmVoucherRequests='+1+'&payeeNameVoucher='+payee+'&voucherType='+voucherType,
			success:function(data){
				console.log(data);
				if(data == "SUCCESS"){
					alert('Vouncher is on pending for approval of the admin');
					window.location.reload();
				}else{
					
				}
			}
		})
	}else{
	}
}
</script>
<div class="w3-row w3-padding-16">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-money fa-fx"></i> Create Voucher</h2><hr style="margin-top:0px;"/>
	<div class="w3-row">
		<form <?php if(isset($_SESSION['payeeInfo'])){?>action="javascript:void(0);" onsubmit="return addParticulars()"<?php }else{?>action=""<?php }?> method="post">
			<div class="<?php if(isset($_SESSION['payeeInfo'])){?>w3-col s5<?php }else{echo "w3-row";}?> w3-padding">
				<?php
					if(!isset($_SESSION['payeeInfo'])){
				?>
				<label>Type</label>
				<select class="w3-input w3-border" name="voucherType" id="voucherType" required>
					<option selected disabled value="">Select Type of Voucher</option>
					<option value="1">Cash Voucher</option>
					<option value="2">Check Voucher</option>
				</select>
				<label>Payee</label>
				<input type="text" class="w3-input w3-small w3-border" name="voucherPayee" id="voucherPayee" required>
				
				<?php }
					if(isset($_SESSION['payeeInfo'])){
				?>
				<label>Particulars</label>
				<input type="text" class="w3-input w3-small w3-border" name="voucherParticulars" id="voucherParticulars" required >
				<label>Amount</label>
				<input type="number" class="w3-input w3-small w3-border" name="particularAmount" id="particularAmount" required>
				<?php }?>
				<br/>
				<?php
					if(!isset($_SESSION['payeeInfo'])){
				?>
					<button class="w3-button w3-green w3-small" >Proceed</button>
				<?php }else{?>
					<button class="w3-button w3-green w3-small" type="submit" >Add Particulars</button>
				<?php }?>
			</div><?php
				if(isset($_SESSION['payeeInfo'])){
			?>
			<div class="w3-rest w3-padding">
				<div class="w3-row">
					<table class="w3-table w3-small w3-border w3-striped">
						<thead class="w3-bottombar">
							<tr >
								<th>Payee: </th>
								<th><?php echo $_SESSION['payeeInfo']['payee'];?></th>
							</tr>
							<tr>
								<th>Voucher Type:</th>
								<th><?php echo getVoucherType($_SESSION['payeeInfo']['voucherType']);?></th>
							</tr>
						</thead>
					</table>
					<table class="w3-table w3-small w3-border w3-striped" id="particulars">
						<thead>
							<tr class="w3-green">
								<th>Particulars</th>
								<th class="w3-center">Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$total = 0;
							if(isset($_SESSION['particulars'])){
								//echo "<pre>",print_r($_SESSION['particulars']),"</pre>";
								foreach($_SESSION['particulars'] as $key => $value){
									$total = $total + $value['amount'];
							?>
								<tr>
									<td><?php echo $value['particulars']?></td>
									<td class="w3-center"><?php echo $value['amount']?> <a href="javascript:void(0);" class="w3-text-red w3-right" onclick=""><i class="fa fa-remove"></i></a></td>
								</tr>
							<?php }}else{?>
							<tr>
								<td class="w3-center" colspan="2">***** NOTHING *****</td>
							</tr>
							<?php }?>
							
						</tbody>
					</table><br/>
					</form>
					<input type="hidden" id="payeeee" value="<?php echo $_SESSION['payeeInfo']['payee']?>">
					<input type="hidden" id="voucherTypeAdd" value="<?php echo $_SESSION['payeeInfo']['voucherType']?>">
					<button class="w3-button w3-green w3-small" id="confirmVoucher" onclick="return confirmRequest();" disabled>Confirm</button>
				</div>
			</div>
			<?php }?>
			<div class="w3-row-padding w3-container">
				
			</div>
	</div>
</div>