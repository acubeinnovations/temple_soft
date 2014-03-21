<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<h3>Form Variables</h3>
<div class="text-right">
	<a href="ac_form_type.php" class="small button">Form Types</a>
</div>
<div class="medium-6 columns">
<form id="frm-formtype" name="frm-formtype" method="POST" action="<?php echo $current_url;?>">
<fieldset>
	<legend>Update Form Variables</legend>
			<div class="medium-8 columns">
				<label for="form-type">Variable Name</label>
				<input type="text" name="txtvariable" id="txtvariable" value="" />
			</div>

			<div class="medium-2 columns">
				<input type="submit" name="submit_variable" value="Submit"  class="small button"/>

			</div>

</fieldset>
 </form>
 </div>

 <div class="medium-6 columns">
 <fieldset>
	<legend>Form Variables</legend>
	<?php if($form_variables){?>
	<table width="100%">
		<thead>
			<td width="10%">SlNo</td>
			<td>Variable</td>
		</thead>
		<tbody>
		<?php $slno =0;
			foreach($form_variables as $variable){
				$slno++;
		?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $variable['description'];?></td>
		</tr>
		<?php }?>
			
		</tbody>
	</table>
	<?php }?>
</fieldset>
</div>