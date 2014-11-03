<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row" >
	<div class="medium-6 columns">
		<h3>List Supplier</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_supplier.php">Add New</a>
		</div>
	</div>
</div>



<?php if($count_suppliers > 0){?>

<table width="100%">
  	<thead>
	<tr>
		<td width="6%">Sl no</td>
		<td width="40%">Supplier</td>
		<td width="15%">Phone Number</td>
		<td >Contact Person</td>
		<td width="11%"></td>
	</tr>
	</thead>
	<tbody>
	<?php
		$slno = ($pagination->page_num*$pagination->max_records)+1;
		for($i=0; $i<$count_suppliers; $i++){
			$edit = "ac_supplier.php?edt=".$suppliers[$i]['supplier_id'];
			$delete = "ac_suppliers.php?dlt=".$suppliers[$i]['supplier_id'];
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><?php echo $suppliers[$i]['supplier_name']."<br/>".$suppliers[$i]['supplier_address'];?></td>
		<td><?php echo $suppliers[$i]['supplier_phone'];?></td>
		<td>
			<?php echo $suppliers[$i]['contact_person'];?>
			<span style="font-size:11px;">
			<?php
				echo ($suppliers[$i]['contact_mobile']!="")?"<br/>Mobile :".$suppliers[$i]['contact_mobile']:"";
				echo ($suppliers[$i]['contact_email']!="")?"<br/>Email :".$suppliers[$i]['contact_email']:"";
			?>
			</span>
		</td>
		<td><a href="<?php echo $edit; ?>">Edit</a> / <a href="javascript:deleteSupplier(<?php echo $suppliers[$i]['supplier_id']?>)">Delete</a></td>
	</tr>
	<?php $slno++; }?>
	<tr>
		<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>