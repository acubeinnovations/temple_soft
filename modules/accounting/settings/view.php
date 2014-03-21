<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form id="frmsettings" name="frmsettings" action="<?php echo $current_url;?>" method="POST">

<div class="row">
	<div class="large-4 columns">
	
	</div>
</div>

<div class="row">
	<fieldset>
 		<legend>Settings </legend>

 		<div class="row">
 			<div class="medium-5 columns">
 				<label for="ledger">Financial Year(Current Fy : <?php echo $financial_year->fy_name; ?>)</label>
 				<?php echo populate_list_array("lstfy", $financial_years, 'fy_id','fy_name', '',$disable=false);?>
 			</div>
 			
 		</div>

 		<div class="row">
 			<div class="medium-5 columns">
 				<input class="small button"  value="Save" name="submit" type="submit"/>
 			</div>
 		</div>

 	</fieldset>
</div>

</form>