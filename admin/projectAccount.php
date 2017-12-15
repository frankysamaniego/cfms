<script>
function enable(y){
	document.getElementById("tdToggle_"+y).innerHTML = "Enabled";
	document.getElementById("disable_"+y).style.display = "inline";
	document.getElementById("enable_"+y).style.display = "none";
}

function disable(x){
	document.getElementById("tdToggle_"+x).innerHTML = "Disabled";
	document.getElementById("disable_"+x).style.display = "none";
	document.getElementById("enable_"+x).style.display = "inline";
}

function delete_(x,id){
	var con = confirm("Are you sure to delete the project?");
	if(con == true){
		document.getElementById("trDel_"+id).style.display="none";
	}else{
		
	}
}
</script>
<div class="w3-row">
	<div class="w3-row">
		<div class="w3-col s8 m8 l8">
		<h3 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-folder-open-o fa-fx"></i> Project Accounts</h3>
		</div>
		<div class="w3-rest">
		<input type="text" class="w3-right w3-small w3-border w3-input" style="margin-top:20px" onchange="searchAccount()" placeholder="Search" />
		</div>
		<hr style="margin-top:5px;"/>
	</div>
	<div class="w3-row">
		<table class="w3-table w3-small w3-striped">
			<thead>
				<tr class="w3-bottombar w3-hover" style="font-weight:bold;">
					<td>Project Code</td>
					<td>Project Location</td>
					<td>In-Charge</td>
					<td>Account Status</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<tr id="trDel_1">
					<td>Pj01</td>
					<td>Polangui</td>
					<td>Mian</td>
					<td id="tdToggle_1">Enabled</td>
					<td>
						<button class="w3-red w3-button w3-small" style="padding:4px 10px;"  onclick="return disable(1)" id="disable_1"><i class="fa fa-ban fa-lg"></i></button>
						<button class="w3-green w3-button w3-small" style="padding:4px 10px;display:none;" onclick="return enable(1)" id="enable_1"><i class="fa fa-check fa-lg"></i></button>
						<button class="w3-green w3-button w3-small" style="padding:4px 10px;"onclick="return delete_(this,'1')"><i class="fa fa-trash fa-lg"></i></button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


