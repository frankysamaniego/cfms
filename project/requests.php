<?php
	//include("../include/dbcon.php");
?>


<div class="w3-row">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-road fa-fx"></i> Request Form</h2><hr style="margin-top:0px;"/>
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
				<button class="w3-button w3-white">Cancel</button>
			</div>
		</div>
	</form>
</div>
<div class="w3-row">
	<div class="w3-container">
		<table class="w3-table w3-table-stripped">
			<thead>
				<tr>
					<td></td>
				</tr>
			</thead>
		</table>
	</div>
</div>