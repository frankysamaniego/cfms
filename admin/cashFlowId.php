<?php
	
	$compBal = getCompBal();
	$projectId = $_GET['cashFlowId'];
	function getProjectCost($x){
		global $mysqli;
		$sql = $mysqli->query("select * from projects where id='$x'");
		while($row = mysqli_fetch_assoc($sql)){
			return $row['projectCost'];
		}
	}
	$latestBalance = getProjectCost($projectId);
	
	$latestUpdateDate = getLateseUp();
?>

<div class="w3-row w3-padding-16">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-road fa-fx"></i> Project Cash Flow</h2><hr style="margin-top:0px;"/>
	<div class="w3-row">
		<table class="w3-table row-border w3-small stripped" id="cashFlow">
			<thead>
				<tr class="w3-borderbottom">
					<th>Date</th>
					<th>Payee</th>
					<th>Particulars</th>
					<th>Check #</th>
					<th>Voucher #</th>
					<th>Credit</th>
					<th>Debit</th>
					<th>Balance</th>
				</tr>
				<tr>
					<th colspan="7" style="text-align:center !important;">****** STARTING BALANCE ******</th>
					<th><?php echo number_format($compBal,2)?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = $mysqli->query("select * from vouchers where status='1' and `requesteeId`='$projectId' order by id asc");
					while($row = mysqli_fetch_assoc($sql)){
					if($row['requestDate'] >= $latestUpdateDate){
				?>
				<tr>
					<td><?php echo date('m/d/Y',$row['requestDate'])?></td>
					<td><?php echo $row['payee']?></td>
					<td><?php echo getParticulars($row['id']);?></td>
					<td><?php echo $row['checkNo'];?></td>
					<td><?php if($row['statusFlow'] !='in'){ echo formatNumber($row['voucherNo']);}?></td>
					<td><?php if($row['statusFlow'] == 'in'){
						$amountIn = getCashIn($row['id']);
						echo number_format($amountIn,2);
						$compBal = $compBal + $amountIn;
					}?></td>
					<td><?php
						if($row['statusFlow'] == 'out'){
							$totalPart =getParticularsTotal($row['id']);
							echo number_format(getParticularsTotal($row['id']),2);
							$compBal = $compBal-$totalPart;
						}else if($row['statusFlow'] == 'in'){
							$amountIn = getCashIn($id);
							echo number_format($amountIn,2);
						}
					?></td>
					<td><?php echo number_format($compBal,2);?></td>
				</tr>
					<?php }}?>
			</tbody>
		</table>
	</div>
</div>