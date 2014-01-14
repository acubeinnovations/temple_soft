<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
 ?>



 <form id="" name="" method="POST" action="">
 	<fieldset>
 		<legend>Add Pooja </legend>

 		<div class="row">
 			<div class="large-4 columns">
 			</div>
 		</div>

 		<div class="row">
 			<div class="medium-6 columns">
 				<label for="pooja">Pooja</label>
 				<input type="text" name="name" id="pooja" value="<?php echo $add_pooja->name;?>"/>
 			</div>
 		</div>

	<div class="row">
 			<div class="medium-6 columns">
 				<label for="rate">Rate</label>
 				<input type="text" name="rate" id="rate" value="<?php echo $add_pooja->rate;?>"/>
 				
 			</div>
 		</div>

 		<div class="row">
 			<div class= "medium-6 columns">
 				<label for="listpooja">Status <small>required</small></label>
				<?php echo populate_list_array("listpooja", $g_ARRAY_LIST_STATUS, 'id','name', $add_pooja->status_id,$disable=false);?>
 	
 			</div>
 		</div>

 		<div class="row">
 			<div class="medium-6 columns">
 				<input class="small button"  value="submit" name="submit" type="submit"/>
 				<input type="hidden" name="h_id" value="<?php echo $add_pooja->id; ?>" />

 			</div>
 		</div>

 	</fieldset>
 </form>

