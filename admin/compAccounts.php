<script>
function enable(y){
	$.ajax({
		url:'process.php',
		type:'post',
		data:'usersEnableId='+y,
		success:function(data){
			console.log(data);
			if(data == "SUCCESS"){
				window.location.reload();
			}
		}
	});
}

function saveNewAccount(){
	var data = $('#newAccountForm').serializeArray();
	$.ajax({
		url:'process.php',
		type:'post',
		data:data,
		success:function(data){
			console.log(data);
			if(data == "SUCCESS"){
				alert("Account added!");
				window.location.reload();
			}
		}
	});
}



function disable(x){
	/*document.getElementById("tdToggle_"+x).innerHTML = "Disabled";
	document.getElementById("disable_"+x).style.display = "none";
	document.getElementById("enable_"+x).style.display = "inline";*/
	$.ajax({
		url:'process.php',
		type:'post',
		data:'usersDisableId='+x,
		success:function(data){
			console.log(data);
			if(data == "SUCCESS"){
				window.location.reload();
			}
		}
	});
}
function delete_(x,id){
	var con = confirm("Are you sure to delete the user?");
	//alert(id);
	if(con == true){
		$.ajax({
			url:'process.php',
			type:'post',
			data:'userDel='+id,
			success:function(data){
				if(data == "SUCCESS"){
					document.getElementById("trDel_"+id).style.display="none";
				}
			}
		});
	}else{
		
	}
}
</script>

<div id="newAccountModal" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content w3-card-4" style="max-width:500px;">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('newAccountModal').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h4><i class="fa fa-user"></i> Account Information</h4>
      </header>
      <div class="w3-container w3-padding-16">
        <form class="w3-form" id="newAccountForm" action="javascript:void(0);" method="post" onsubmit="return saveNewAccount()">
			<label>First Name</label>
			<input class="w3-input w3-border w3-small" type="text" name="firstName" id="firstName" placeholder="First Name" required />
			<label>Middle Name</label>
			<input class="w3-input w3-border w3-small" type="text"  name="middleName" id="middleName" placeholder="Middle Name" required >
			<label>Last Name</label>
			<input class="w3-input w3-border w3-small" name="lastName" id="lastName" placeholder="Last Name"  type="text" required />
			<label>Username</label>
			<input class="w3-input w3-border w3-small" type="text" name="userName" id="userName" placeholder="Username" required />
			<label>Password</label>
			<input class="w3-input w3-border w3-small" type="password" name="password" id="password" required />
			<input class="w3-input w3-border w3-small" type="hidden" name="saveToAccounts" id="saveToAccounts" value="true" />
			<label>Account Type</label>
			<select class="w3-input w3-border w3-small" name="newAccountType" id="newAccountType" required>
				<option selected value="" disabled>Please select account type</option>
				<option value="1">Admin</option>
				<option value="2">Cashier</option>
			</select>
			<br/>
			<input type="submit" class="w3-button w3-small w3-green w3-block" value="Submit">
		</form>
      </div>
    </div>
</div>




<div class="w3-row w3-padding-16">
	<div class="w3-row">
		<h2 class="w3-left" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-group fa-fx"></i> Company Accounts</h2><button class="w3-button w3-right w3-small w3-blue" style="margin-top:30px;" onclick="document.getElementById('newAccountModal').style.display='block'"><i class="fa fa-user" ></i> New Account</button></div><hr style="margin-top:0px;"/>
	<div class="w3-row">
		<table class="w3-table w3-striped w3-hoverable w3-small">
			<thead>
				<tr class="w3-blue">
					<th>Username</th>
					<th>Full Name</th>
					<th>Account Type</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = $mysqli->query("select * from users");
					while($row = mysqli_fetch_assoc($sql)){
				?>
					<tr id="trDel_<?php echo $row['id']?>">
						<td><?php echo $row['userName']?></td>
						<td><?php echo ucwords($row['firstName'].' '.$row['middleName'].' '.$row['lastName'])?></td>
						<td><?php echo getAccountType($row['accountType'])?></td>
						<td><?php echo getProjStatus($row['status'])?></td>
						<td>
						<?php if($row['status'] == 1){?>
							<button class="w3-red w3-button w3-small" style="padding:4px 10px;"  onclick="return disable(<?php echo $row['id']?>)" id="disable_<?php echo $row['id']?>"><i class="fa fa-ban fa-lg"></i></button>
						<?php }else{?>
							<button class="w3-green w3-button w3-small" style="padding:4px 10px;" onclick="return enable(<?php echo $row['id']?>)" id="enable_<?php echo $row['id']?>"><i class="fa fa-check fa-lg"></i></button>
						<?php }?>
							<button class="w3-green w3-button w3-small" style="padding:4px 10px;"onclick="return delete_(this,<?php echo $row['id']?>)"><i class="fa fa-trash fa-lg"></i></button>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>