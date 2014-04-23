<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row" >
	<div class="medium-6 columns">
		<h3>List Items</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_stock.php">Add New</a>
		</div>
	</div>
</div>

<?php if($count_items > 0){?>

<table width="100%">
  	<thead>
	<tr>
		<td width="10%">Sl no</td>
		<td width="50%">Item Name</td>
		<td width="20%">Unit of Measure</td>
		<td>Edit / Delete</td>
	</tr>
	</thead>
	<tbody>
	<?php
		$slno = ($pagination->page_num*$pagination->max_records)+1;
		for($i=0; $i<$count_items; $i++){
			$edit = "ac_stock.php?edt=".$items[$i]['id'];
			$delete = "ac_stocks.php?dlt=".$items[$i]['id'];
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><?php echo $items[$i]['name'];?></td>
		<td><?php echo $items[$i]['uom'];?></td>
		<td><a href="<?php echo $edit; ?>">Edit</a> / <a href="javascript:deleteItem(<?php echo $items[$i]['id']?>)">Delete</a></td>
	</tr>
	<?php $slno++; }?>
	<tr>
		<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>
