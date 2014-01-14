<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
 ?>



 <form id="" name="" method="POST" action="">
 	<fieldset>
 		<legend>Add Star </legend>

 		<div class="row">
 			<div class="large-4 columns">
 			</div>
 		</div>

 		<div class="row">
 			<div class="medium-6 columns">
 				<label for="star">Star </label>
 				<input type="text" name="name" id="star" value="<?php  echo $add_star->name;?>"/>
 			</div>
 		</div>

 		<div class="row">
 			<div class= "medium-6 columns">
 				<label for="liststar">Status <small>required</small></label>
				<?php echo populate_list_array("liststar", $g_ARRAY_LIST_STATUS, 'id','name', $add_star->status_id,$disable=false);?>
 	
 			</div>
 		</div>

 		<div class="row">
 			<div class="medium-6 columns">
 				<input class="small button"  value="submit" name="submit" type="submit"/>
 				<input type="hidden" name="h_id" value="<?php echo $add_star->id; ?>" />

 			</div>
 		</div>

 	</fieldset>
 </form>

