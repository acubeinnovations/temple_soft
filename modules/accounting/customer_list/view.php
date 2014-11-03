<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3>List Customer</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_customer.php">Add New</a>
		</div>
	</div>
</div>





<?php if($count_customers > 0){?>

<table width="100%">
  	<thead>
	<tr>
		<td width="10%">Sl no</td>
		<td width="40%">Customer</td>
		<td width="30%">Contact number</td>
		<td>Edit / Delete</td>
	</tr>
	</thead>
	<tbody>
	<?php
		$slno = ($pagination->page_num*$pagination->max_records)+1;
		for($i=0; $i<$count_customers; $i++){
			$edit = "ac_customer.php?edt=".$customers[$i]['customer_id'];
			$delete = $current_url."?dlt=".$customers[$i]['customer_id'];
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><?php echo $customers[$i]['customer_name']."<br/>".$customers[$i]['customer_address'];?></td>
		<td><?php echo $customers[$i]['customer_mobile'];?></td>
		<td><a href="<?php echo $edit; ?>">Edit</a> / <a href="javascript:deleteCustomer(<?php echo $customers[$i]['customer_id']?>)">Delete</a></td>
	</tr>
	<?php $slno++; }?>
	<tr>
		<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>