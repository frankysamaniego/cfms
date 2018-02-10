<script>
function checkCheckNum(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	  if (charCode != 46 && charCode > 31 
		&& (charCode < 48 || charCode > 57))
		 return false;
	  return true;
}


function addCashIn(){
	var cashInPayee = $("#cashinPayee").val();
	var cashInProjectId = $("#cashInProjectId").val();
	var cashInAmount = $("#cashInAmount").val();
			
	$.ajax({
		url:'getParticulars.php',
		type:'post',
		data:'cashInPayee='+cashInPayee+'&cashInProjectId='+cashInProjectId+'&cashInAmount='+cashInAmount,
		success:function(data){
			console.log(data);
			if(data =="SUCCESS"){
				alert("Cash In Added");
				window.location.reload();
			}
		}
	})
}
</script>


<div class="w3-row w3-padding-16">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-money fa-fx"></i> Cash In</h2><hr style="margin-top:0px;"/>
	<div class="w3-row">
		<form class="w3-form w3-container" action="javascript:void(0);" method="post" onsubmit="return addCashIn()">
			<label>Payee</label>
			<input type="text" name="cashinPayee" id="cashinPayee" class="w3-input w3-border" required />
			<label>Particulars</label>
				<select class="w3-input w3-border" id="cashInProjectId" name="cashInProjectId" required />
					<option value="" selected disabled>Select Project</option>
					<?php
						$sql = $mysqli->query("select * from projects where status ='1'");
						while($row = mysqli_fetch_assoc($sql)){
					?>
						<option value="<?php echo $row['id']?>"><?php echo $row['projectName'].' @ '.$row['projectLocation']?></option>
					<?php }?>
				</select>
			<label>Amount</label>
			<input type="text" name="cashInAmount" id="cashInAmount" onkeypress="return checkCheckNum(event)" class="w3-input w3-border" required />
			<br/>
			<input type="submit" class="w3-button w3-block  w3-green" value="Submit Cash In">
		</form>
	</div>
</div>