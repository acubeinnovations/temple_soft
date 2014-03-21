<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form data-abide target="_self" method="POST" action="<?php echo $current_url?>" name="frmsearch" id="frmsearch">
<div class="row" >
	<div class="medium-4 columns">
		<h3>Search Ledger</h3>
	</div>
	<div class="text-right" style="margin-top:5px;">
		
	</div>
</div>
	<fieldset>
 		

 		<div class="row">
 			<div class="medium-4 columns">
 				<label for="ledger">Select Ledger</label>
    			<?php echo populate_list_array("lstledger", $ledgers, 'id','name', $account->ref_ledger,$disable=false);?>
    		</div>

    		<div class="medium-4 columns">
 				<label for="ledger">Enter Ledger</label>
    			<input type="text" name="txtledger" id="txtledger"  value="<?php echo $ledger_name; ?>"/>
    		</div>
    	</div>

    	<div class="row">
    		<div class="medium-4 columns">
 				<label for="ledger">Date From</label>
    			<input type="text" name="txtfromdate" id="txtfromdate"  value="<?php echo $datefrom;?>" class="mydatepicker"/>
    		</div>

    		<div class="medium-4 columns">
 				<label for="ledger">Date To</label>
    			<input type="text" name="txttodate" id="txttodate"  value="<?php echo $dateto;?>" class="mydatepicker"/>
    		</div>
    	</div>

    	<div class="row">
    		<div class="text-center">
				<input type="submit" name="submit" value="Search" class="small button" />
 			</div>
 		</div>
 	    
</form>

<?php if(isset($count_list)){?>
<table width="100%">
	<thead>
	<tr>
		<td width="10%">Voucher Number</td>
		<td width="10%">Date</td>
		<td width="30%">Narration</td>
		<td width="15%">From</td>
		<td width="15%">To</td>
		<td width="10%">Debit</td>
		<td width="10%">Credit</td>
	</tr>
	</thead>
	<tbody>
	<?php 
	$i=0;
	while($i < $count_list){
	?>
	<tr>
		<td><?php echo $account_list[$i]['voucher_number']; ?></td>
		<td><?php echo $account_list[$i]['date']; ?></td>
		<td><?php echo $account_list[$i]['narration']; ?></td>
		<td><?php echo $ledger->ledgerName($account_list[$i]['account_from']); ?></td>
		<td><?php echo $ledger->ledgerName($account_list[$i]['account_to']); ?></td>
		<td><?php echo $account_list[$i]['account_debit']; ?></td>
		<td><?php echo $account_list[$i]['account_credit']; ?></td>
	</tr>
	<?php $i++; }?>
	<tr>
		<td colspan="7"><?php  echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
	
<?php }?>




</fieldset>