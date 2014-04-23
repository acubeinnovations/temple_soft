<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row" >
	<div class="medium-6 columns">
		<h3>Add Form Type</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a href="ac_form_types.php" class="tiny button">Form Types</a>
			<a href="ac_form_variable.php" class="tiny button">Form Variable</a>
		</div>
	</div>
</div>


<form id="frm-formtype" name="frm-formtype" method="POST" action="<?php echo $current_url;?>">
<input type="hidden" value="" name="hd_typeid" />
<fieldset>
	<legend>Update Form Type</legend>
		<div class="row">
			<div class="medium-4 columns">
				<label for="form-type">Form Name</label>
				<input type="text" name="txtname" id="txtname" value="" />
			</div>

			<div class="medium-4 columns">
				<label for="form-type">Form Variables</label>
				<?php echo populate_multiple_list_array("lstvariable", $form_variables, 'id','description',array(),$disable=false,false);?>
			</div>
			

			<div class="medium-3 columns">
				<input type="submit" name="submit" value="Add"  class="tiny button"/>

			</div>
		</div>

</fieldset>

 </form>

 
