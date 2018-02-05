<?php
	//include("../include/dbcon.php");
?>

<div class="w3-row">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-road fa-fx"></i> Request Form</h2><hr style="margin-top:0px;"/>
	<?php
		if(!isset($_GET['edit'])){
	?>
		<form class="" onsubmit="return newRequest()" action="javascript:void(0);" method="post">
			<div id="status"></div>
			<p class="w3-small w3-text-red">* Required Fields</p>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-quarter w3-padding"><span class="">* Item Brand</span></div>
				<div class="w3-rest">
					<input type="text" class="w3-input w3-border" id="itemBrand" required />
				</div>
			</div>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-quarter w3-padding"><span class="">* Item Type</span></div>
				<div class="w3-rest">
					<input type="text" class="w3-input w3-border" id="itemType" required />
				</div>
			</div>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-quarter w3-padding"><span class="">* Item Price</span></div>
				<div class="w3-rest">
					<input type="number" class="w3-input w3-border" id="itemPrice" required />
				</div>
			</div>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-quarter w3-padding"><span class="">* Item Quantity</span></div>
				<div class="w3-rest">
					<input type="text" class="w3-input w3-border" id="itemQuantity" required />
				</div>
			</div>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-rest w3-right">
					<button class="w3-button w3-green" id="createBtn">Create</button>
					<input type="reset" class="w3-button w3-red" value="Reset">
				</div>
			</div>
		</form>
	<?php } if(isset($_GET['edit'])){
			$requestId = $_GET['edit'];
			$sessionId = $_SESSION['loggedInId'];
			$getInfo = $mysqli->query("select * from request where id='$requestId' and projectId='$sessionId'");
			while($row = mysqli_fetch_assoc($getInfo)){
		?>
		<form class="" id="updateRequest" onsubmit="return updateRequest('<?php echo $requestId?>')" action="javascript:void(0);" method="post">
			<div id="status"></div>
			<p class="w3-small w3-text-red">* Required Fields</p>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-quarter w3-padding"><span class="">* Item Brand</span></div>
				<div class="w3-rest">
					<input type="text" class="w3-input w3-border" value="<?php echo $row['brand']?>" id="itemBrand" name="itemBrand" required />
				</div>
			</div>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-quarter w3-padding"><span class="">* Item Type</span></div>
				<div class="w3-rest">
					<input type="text" class="w3-input w3-border" value="<?php echo $row['type']?>"  id="itemType"  name="itemType" required />
				</div>
			</div>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-quarter w3-padding"><span class="">* Item Price</span></div>
				<div class="w3-rest">
					<input type="number" class="w3-input w3-border" value="<?php echo $row['price']?>"  id="itemPrice" name="itemPrice" required />
				</div>
			</div>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-quarter w3-padding"><span class="">* Item Quantity</span></div>
				<div class="w3-rest">
					<input type="text" class="w3-input w3-border" value="<?php echo $row['qty']?>" id="itemQuantity" name="itemQuantity" required />
					<input type="hidden" class="w3-input w3-border" name="requestIdUpdate" id="requestIdUpdate" value="<?php echo $requestId?>"  required />
				</div>
			</div>
			<div class="w3-row-padding w3-padding-8">
				<div class="w3-rest w3-right">
					<button class="w3-button w3-green" id="createBtn">UPDATE</button>
					<a href="?requests=true" class="w3-button w3-red">CANCEL</a>
				</div>
			</div>
		</form>
	<?php }}?>
</div>
<hr/>
<div class="w3-row">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-list-ol fa-fx"></i> Recent Requests</h2><hr style="margin-top:0px;"/>
	<div class="w3-container">
		<table class="w3-table w3-table-stripped" id="requestTables">
			<thead>
				<tr class="w3-bottombar">
					<th>ID</th>
					<th>BRAND</th>
					<th>TYPE</th>
					<th>QUANTITY</th>
					<th>STATUS</th>
					<th>ACTION</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$userId = $_SESSION['loggedInId'];
				$projectCode = $_SESSION['projectCode'];
				$query = $mysqli->query("select * from request where projectId='$userId'");
				while($row = mysqli_fetch_assoc($query)){
			?>
				<tr>
					<td><?php echo $row['id'];?></td>
					<td><?php echo $row['brand'];?></td>
					<td><?php echo $row['type'];?></td>
					<td><?php echo $row['qty'];?></td>
					<td><?php echo getStatus($row['status']);?></td>
					<td>
						<?php
								if($row['status'] == 0){
						?>
							<a href="?requests=true&edit=<?php echo $row['id']?>" class="w3-button w3-amber w3-small" alt="Edit" title="Edit"><i class="fa fa-edit fa-1x"></i></a>
							<a href="javascript:void(0);" onclick="return delRequest(<?php echo $row['id']?>)" class="w3-button w3-red w3-small" alt="Delete" title="Delete"><i class="fa fa-trash fa-1x"></i></a>
						<?php }?>
					</td>
				</tr>
			<?php }?>
			</tbody>
		</table>
	</div>
</div>