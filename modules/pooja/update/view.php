<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
 ?>

 <form id="" name="" methord="POST" action="">
 	<fieldset>
 		<legend>Add Pooja </legend>
 		<div class="row">
 			<div class="large-4 columns">
 			</div>
 		</div>

 		<div class="row">
 			<div class="large-4 columns">
 				<label for="pooja">pooja</label>
 				<input type="text" name="name" id="pooja" value=""/>
 			</div>
 		</div>

	<div class="row">
 			<div class="large-4 columns">
 				<label for="rate">rate</label>
 				<input type="text" name="rate" id="rate" value=""/>
 			</div>
 		</div>

 		<div class="row">
 			<div class="large-3 columns">
 				<input class="small button"  value="submit" name="submit" type="submit"/>
 				<input type="hidden" name="status_id" value="<?php //echo $add_pooja->h_id; ?>" />
 			</div>
 		</div>

 	</fieldset>
 </form>

