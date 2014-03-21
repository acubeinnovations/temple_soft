<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<h3><?php echo $form_type->value;?></h3>
<div class="text-right">
	<a href="ac_form_type.php" class="small button">Form Types</a>
</div>

<form id="frm-formtype" name="frm-formtype" method="POST" action="<?php echo $current_url;?>">
<input type="hidden" value="<?php echo $form_type->id;?>" name="hd_typeid" />
<fieldset>

	<table width="50%">
		<thead>
		<tr>
			<td width="10%">SlNo</td>
			<td width="40%">Form Variable</td>
			
		</tr>
		</thead>

		<tbody>
			<?php if($form_type_variables){$slno=0;
				foreach($form_type_variables as $variable){$slno++;
			?>
			<tr>
				<td><?php echo $slno;?></td>
				<td><?php echo $variable['description'];?></td>
				
			</tr>

			<?php }}?>
				
		</tbody>

	</table>

	

</fieldset>

 </form>