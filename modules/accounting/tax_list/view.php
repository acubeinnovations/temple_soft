<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3>List Tax</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_tax.php">Add New</a>
		</div>
	</div>
</div>


<?php if($count_tax > 0){?>

<table width="100%">
  	<thead>
	<tr>
		<td width="10%">Sl no</td>
		<td width="50%">Name</td>
		<td width="20%">Tax rate(%)</td>
		<td>Status</td>
	</tr>
	</thead>
	<tbody>
	<?php
		$slno = ($pagination->page_num*$pagination->max_records)+1;
		for($i=0; $i<$count_tax; $i++){
			$edit = "ac_tax.php?edt=".$tax_list[$i]['id'];
			$delete = "ac_taxs.php?dlt=".$tax_list[$i]['id'];
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><?php echo $tax_list[$i]['name'];?></td>
		<td><?php echo $tax_list[$i]['rate']*100;?></td>
		<td><a href="<?php echo $edit; ?>">Edit</a> / <a href="javascript:deleteTax(<?php echo $tax_list[$i]['id']?>)">Delete</a></td>
	</tr>
	<?php $slno++; }?>
	<tr>
		<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>
