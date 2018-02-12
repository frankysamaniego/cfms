<?php
	require("../include/dbcon.php");
	
	function numtowords($num){ 
			$decones = array( 
						'01' => "One", 
						'02' => "Two", 
						'03' => "Three", 
						'04' => "Four", 
						'05' => "Five", 
						'06' => "Six", 
						'07' => "Seven", 
						'08' => "Eight", 
						'09' => "Nine", 
						10 => "Ten", 
						11 => "Eleven", 
						12 => "Twelve", 
						13 => "Thirteen", 
						14 => "Fourteen", 
						15 => "Fifteen", 
						16 => "Sixteen", 
						17 => "Seventeen", 
						18 => "Eighteen", 
						19 => "Nineteen" 
						);
			$ones = array( 
						0 => " ",
						1 => "One",     
						2 => "Two", 
						3 => "Three", 
						4 => "Four", 
						5 => "Five", 
						6 => "Six", 
						7 => "Seven", 
						8 => "Eight", 
						9 => "Nine", 
						10 => "Ten", 
						11 => "Eleven", 
						12 => "Twelve", 
						13 => "Thirteen", 
						14 => "Fourteen", 
						15 => "Fifteen", 
						16 => "Sixteen", 
						17 => "Seventeen", 
						18 => "Eighteen", 
						19 => "Nineteen" 
						); 
			$tens = array( 
						0 => "",
						2 => "Twenty", 
						3 => "Thirty", 
						4 => "Forty", 
						5 => "Fifty", 
						6 => "Sixty", 
						7 => "Seventy", 
						8 => "Eighty", 
						9 => "Ninety" 
						); 
			$hundreds = array( 
						"Hundred", 
						"Thousand", 
						"Million", 
						"Billion", 
						"Trillion", 
						"Quadrillion" 
						); //limit t quadrillion 
			$num = number_format($num,2,".",","); 
			$num_arr = explode(".",$num); 
			$wholenum = $num_arr[0]; 
			$decnum = $num_arr[1]; 
			$whole_arr = array_reverse(explode(",",$wholenum)); 
			krsort($whole_arr); 
			$rettxt = ""; 
			foreach($whole_arr as $key => $i){ 
				if($i < 20){ 
					$rettxt .= $ones[$i]; 
				}
				elseif($i < 100){ 
					$rettxt .= $tens[substr($i,0,1)]; 
					$rettxt .= " ".$ones[substr($i,1,1)]; 
				}
				else{ 
					$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
					$rettxt .= " ".$tens[substr($i,1,1)]; 
					$rettxt .= " ".$ones[substr($i,2,1)]; 
				} 
				if($key > 0){ 
					$rettxt .= " ".$hundreds[$key]." "; 
				} 

			} 
			$rettxt = $rettxt." peso/s";

			if($decnum > 0){ 
				$rettxt .= " and "; 
				if($decnum < 20){ 
					$rettxt .= $decones[$decnum]; 
				}
				elseif($decnum < 100){ 
					$rettxt .= $tens[substr($decnum,0,1)]; 
					$rettxt .= " ".$ones[substr($decnum,1,1)]; 
				}
				$rettxt = $rettxt." centavo/s"; 
			} 
			return $rettxt;} 
	
	
	//print_r($_GET);
	$voucherId = hexdec($_GET['voucherid']);
	function formatNumber($x){
		$d = getDate();
		$now = $d[0];
		$month = date('m',$now);
		$formattedNum = $month.''.sprintf('%08d', $x);
		return $formattedNum;
	}
	
	$sql = $mysqli->query("select * from vouchers where id='$voucherId' and type='{$_GET['voucherType']}' and status ='1'");
	while($row = mysqli_fetch_assoc($sql)){
		$voucherNum = $row['voucherNo'];
		$idVoucher = $row['id'];
		$requestDate = $row['requestDate'];
		$payee = $row['payee'];
	}
if($_GET['voucherType'] == 1){
?>
<table border="1" width="900" style="border:1px solid #000; border-collapse:collapse;">
	<tr>
    	<td rowspan="2" width="600"></td>
        <td colspan="2">No: <?php echo formatNumber($voucherNum)?></td>
    </tr>
    <tr>
    	 
        <td colspan="2">Date:</td>
    </tr>
	<tr style="text-align:center;">
    	<td>PARTICULARS</td>
        <td width="150">AMOUNT</td>
        <td width="100">TOTAL</td>
    </tr>
	<?php
		$sql = $mysqli->query("select * from request where id='$voucherId'");
		while($row = mysqli_fetch_assoc($sql)){
	?>
    <tr>	
    	<td><?php echo $row['']?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>	
	<?php }?>
    <tr>
    	<td style="width:100px;"></td>
        <td></td>
        <td></td>
    </tr>
</table>
<table border="1" width="900" style="border:1px solid #000; border-collapse:collapse;">
	<tr>
    	<td width="200" style="text-align:center;">ACCOUNT TITLE</td>
        <td style="text-align:center;" width="300">DEBIT</td>
        <td style="text-align:center;" width="300">CREDIT</td>
        <td width="400" colspan="2">Pesos: <?php ?></td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">&nbsp; </td>
        <td style="text-align:center;"> </td>
        <td style="text-align:center;"> </td>
        <td width="400" colspan="2"> aaa</td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">&nbsp; </td>
        <td style="text-align:center;"> </td>
        <td style="text-align:center;"> </td>
        <td width="400">Bank: </td>
         <td width="400">Bank: </td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">&nbsp; </td>
        <td style="text-align:center;"> </td>
        <td style="text-align:center;"> </td>
        <td width="400"> </td>
         <td width="400">Bank: </td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">Prepared by:</td>
        <td style="text-align:center;" width="300">Certified Correct by:</td>
        <td style="text-align:center;" width="300">Approved by:</td>
        <td width="400" colspan="2" style="top:0px;"  >Received Payment by:<br /></td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">&nbsp; </td>
        <td style="text-align:center;"> </td>
        <td style="text-align:center;"> </td>
         <td style="text-align:center;" colspan="2"> </td>
         
    </tr>
</table>
<?php }else{
?>

<table border="1" width="900" style="border:1px solid #000; border-collapse:collapse;">
	<tr>
    	<td rowspan="2" width="600"><?php echo $payee;?></td>
        <td colspan="2">No: <?php echo formatNumber($voucherNum)?></td>
    </tr>
    <tr>
    	 
        <td colspan="2">Date: <?php echo date('m/d/Y',$requestDate)?></td>
    </tr>
	<tr style="text-align:center;">
    	<td>PARTICULARS</td>
        <td width="150">AMOUNT</td>
        <td width="20"></td>
    </tr>
	<?php
		$grandTotal = 0;
		$ss = $mysqli->query("select * from request where voucherId='$idVoucher'");
		if(mysqli_num_rows($ss) > 0){
		while($rr = mysqli_fetch_assoc($ss)){
			$total = $rr['price']*$rr['qty'];
			$a = explode(".",number_format($total,2));
			$toatlPrice = number_format($total,0);
			$grandTotal = $grandTotal + $total;
			$grandCents = explode(".",number_format($grandTotal,2));
			
	?>
		<tr>	
		<td rowspan="" align="center"><?php echo $rr['brand'].' / ('.$rr['qty'].'pc/s * '.$rr['price'].'/pc )';?></td>
			<td align="right"><?php echo $toatlPrice?> &nbsp;</td>
			<td align="left"><?php echo $a[1];?></td>
		</tr>
<?php }}else{
		$ss2 = $mysqli->query("select * from particulars where voucherId='$idVoucher'");
		while($rr = mysqli_fetch_assoc($ss2)){
		$total = $total + $rr['amount'];
		$a = explode(".",number_format($total,2));
		$toatlPrice = number_format($total,0);
		$grandTotal = $grandTotal + $total;
		$grandCents = explode(".",number_format($grandTotal,2));?>
		
		<tr>	
		<td rowspan="" align="center"><?php echo $rr['particulars'];?></td>
			<td align="right"><?php echo $toatlPrice?> &nbsp;</td>
			<td align="left"><?php echo $a[1];?></td>
<?php }}?>
		
    <tr>
    	<td style="width:100px;" style="text-align:right;" align="right">TOTAL</td>
        <td align="right"><?php echo number_format($grandTotal,0);?> &nbsp;</td>
        <td><?php echo $grandCents[1];?></td>
    </tr>
</table>
<table border="1" width="900" style="border:1px solid #000; border-collapse:collapse;">
	<tr>
    	<td width="200" style="text-align:center;">ACCOUNT TITLE</td>
        <td style="text-align:center;" width="300">DEBIT</td>
        <td style="text-align:center;" width="300">CREDIT</td>
        <td width="400" colspan="2"rowspan="2">Pesos: <?php echo numtowords($grandTotal).' Only';?></td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">&nbsp; </td>
        <td style="text-align:center;"> </td>
        <td style="text-align:center;"> </td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">&nbsp; </td>
        <td style="text-align:center;"> </td>
        <td style="text-align:center;"> </td>
        <td width="400">Bank: </td>
         <td width="400">Check No. </td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">&nbsp; </td>
        <td style="text-align:center;"> </td>
        <td style="text-align:center;"> </td>
        <td width="400"> </td>
         <td width="400"><?php echo $row['checkNo']?></td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">Prepared by:</td>
        <td style="text-align:center;" width="300">Certified Correct by:</td>
        <td style="text-align:center;" width="300">Approved by:</td>
        <td width="400" colspan="2" style="top:0px;"  >Received Payment by:<br /></td>
    </tr>
    <tr>
    	<td width="200" style="text-align:center;">&nbsp; </td>
        <td style="text-align:center;"> </td>
        <td style="text-align:center;"> <BR/>SALVADOR B. CHUA</td>
         <td style="text-align:center;" colspan="2"> </td>
         
    </tr>
</table>
<?php }?>