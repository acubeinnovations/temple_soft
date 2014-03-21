<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form data-abide target="_self" method="GET" action="<?php echo $current_url?>" name="frmsearch" id="frmsearch">
<div class="row" >
	<div class="medium-4 columns">
		<h3><?php echo $page_heading; ?></h3>
	</div>
	<?php if(isset($_GET['slno'])){?>
	<div class="text-right" style="margin-top:5px;">
		<a class="small button" href="<?php echo $new_url; ?>">New</a>
	</div>
	<?php }?>
</div>
	<fieldset>
 		

 		<!--<div class="row">
 			<div class="medium-6 columns">
    			<input type="text" name="search"  value="<?php  if(isset($_GET['search'])) { echo $_GET['search'];}?>"/>
    		</div>
    		<div class="medium-4 columns">
     	 		<input type="submit" name="submit" value="Search" class="small button" />
 			
 			</div>

 			

 		</div>-->

 	    
</form>
<?php if($count_list >0){?>

<table width="100%">
	<thead>
	<tr>
		<td width="5%">Voucher Number</td>
		<td width="10%">Date</td>
		<td width="30%">Narration</td>
		<td width="15%">From</td>
		<td width="15%">To</td>
		<td width="10%">Debit</td>
		<td width="10%">Credit</td>
		<td width="5%"></td>
	</tr>
	</thead>
	<tbody>
	<?php 
	$i=0;
	while($i < $count_list){
		$edit ="ac_generate_voucher.php?edt=".$account_list[$i]['account_id'];
		$delete ="ac_generate_voucher.php?dlt=".$account_list[$i]['account_id'];
		
	?>
	<tr>
		<td><?php echo $account_list[$i]['voucher_number']; ?></td>
		<td><?php echo $account_list[$i]['date']; ?></td>
		<td><?php echo $account_list[$i]['narration']; ?></td>
		<td><?php echo $ledger->ledgerName($account_list[$i]['account_from']); ?></td>
		<td><?php echo $ledger->ledgerName($account_list[$i]['account_to']); ?></td>
		<td><?php echo $account_list[$i]['account_debit']; ?></td>
		<td><?php echo $account_list[$i]['account_credit']; ?></td>
		<td>
			<div <?php if(isset($_GET['bid'])) echo 'style="display:none;"'?>>
			<a href="<?php echo $edit; ?>">Edit</a>/
			<a href="javascript:deleteVoucher(<?php echo $account_list[$i]['account_id']?>)">Delete</a>
			</div>
		</td>
	</tr>
	<?php $i++; }?>
	<tr>
		<td colspan="8"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>

<?php }?>

</fieldset>