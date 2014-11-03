<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row" >
	<div class="medium-6 columns">
		<h3>List Form Types</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a href="ac_form_type.php" class="tiny button">Add New</a>
		</div>
	</div>
</div>

 <?php if($count > 0){?>

 <table width="100%" align="center">
 	<thead>
 		<tr>
 			<td width="10%">SlNo</td>
 			<td width="30%">Form Name</td>
 			<td width="20%">Number Of Variables</td>
 			<td></td> 
 		</tr>
 		<?php 
 		$slno = ($pagination->page_num*$pagination->max_records)+1;
 		foreach($form_types as $form_type){?>
 		<tr>
 			<td><?php echo $slno; ?></td>
 			<td><?php echo $form_type['value']; ?></td>
 			<td><?php echo $form_type['value']; ?></td>
 			<td><a href="ac_form_type_variable.php?slno=<?php echo $form_type['id']; ?>"> view</a></td>
 		</tr>
 		<?php $slno++; }?>

 		<tr>
 			<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
 		</tr>
 	</thead>
 </table>
 <?php }?>
