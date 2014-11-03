<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3><?php echo (isset($_GET['edt']))?"Edit Tax":"Add Tax";?></h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_taxs.php">List Tax</a>
		</div>
	</div>
</div>



<form id="frm-tax" name="frm-tax" method="POST" action="<?php echo $current_url;?>">
	<input type="hidden" value="<?php echo $tax->id;?>" name="hd_taxid" />
 	<fieldset>
 		<div class="row">
 			<div class="large-4 columns">
 				<label for="stock">Name</label>
 				<input type="text" name="txtname" id="txtname" value="<?php echo $tax->name;?>"/>
 			</div>

 			<div class="large-2 columns">
 				<label for="stock">Tax Rate in %</label>
 				<input type="text" name="txtrate" id="txtrate" value="<?php echo $tax->rate*100;?>"/>
 			</div>

 			<div class="large-3 columns">
 				<label for="stock">Status</label>
 				<?php echo populate_list_array("lststatus", $g_ARRAY_LIST_STATUS, 'id','name', $tax->status,$disable=false,false);?>
 			</div>

 			<div class="large-3 columns">
 				<input type="submit" name="submit" value="Save" class="tiny button"/>
 			</div>

 		</div>


 	</fieldset>
</form>

