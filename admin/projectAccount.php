<script>
function enable(y){
	
	$.ajax({
		url:'process.php',
		type:'post',
		data:'enableId='+y,
		success:function(data){
			console.log(data);
			if(data == "SUCCESS"){
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
		data:'disableId='+x,
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
			data:'projectDel='+id,
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
<div class="w3-row w3-padding-16">
	<div class="w3-row">
		<div class="w3-col s8 m8 l8">
		<h3 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-folder-open-o fa-fx"></i> Project Accounts</h3>
		</div>
		<div class="w3-rest">
		<input type="text" class="w3-right w3-small w3-border w3-input" onkeyup="search()" style="margin-top:20px" id="toSearch" placeholder="Search Project Code" />
		</div>
		<hr style="margin-top:5px;"/>
	</div>
	<div class="w3-row">
		<table class="w3-table w3-small w3-striped" id="searchTable">
			<thead>
				<tr class="w3-bottombar w3-hover" style="font-weight:bold;">
					<th>Project Code</th>
					<th>Project Location</th>
					<th>In-Charge</th>
					<th>Account Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = $mysqli->query("select * from projects");
					while($row = mysqli_fetch_assoc($sql)){
				?>
				<tr id="trDel_<?php echo $row['id']?>">
					<td><?php echo $row['projectCode'];?></td>
					<td><?php echo $row['projectLocation'];?></td>
					<td><?php echo $row['projectInCharge'];?></td>
					<td id="tdToggle_<?php echo $row['id'];?>"><?php echo getProjStatus($row['status']);?></td>
					<td>
					<?php if($row['status'] == 1){?>
						<button class="w3-red w3-button w3-small" style="padding:4px 10px;"  onclick="return disable(<?php echo $row['id']?>)" id="disable_<?php echo $row['id']?>"><i class="fa fa-ban fa-lg"></i></button>
					<?php }else{?>
						<button class="w3-green w3-button w3-small" style="padding:4px 10px;" onclick="return enable(<?php echo $row['id']?>)" id="enable_<?php echo $row['id']?>"><i class="fa fa-check fa-lg"></i></button>
					<?php }?>
						<button class="w3-green w3-button w3-small" style="padding:4px 10px;"onclick="return delete_(this,'<?php echo $row['id']?>')"><i class="fa fa-trash fa-lg"></i></button>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>


