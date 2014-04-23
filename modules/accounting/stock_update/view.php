<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3><?php echo (isset($_GET['edt']))?"Edit Item":"Add Item";?></h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_stocks.php">List Item</a>
		</div>
	</div>
</div>



<form id="frmitemadd" name="frmitemadd" method="POST" action="<?php echo $current_url;?>">
<input type="hidden" value="<?php echo $stock->item_id;?>" name="hd_itemid" />
 	<fieldset>
 		<div class="row">
 			<div class="medium-4 columns">
 				<label for="stock">Item name</label>
 				<input type="text" name="txtname" id="txtname" value="<?php echo $stock->item_name;?>"/>
 			</div>

 			<div class="medium-2 columns">
 				<label for="stock">Unit of Measure</label>
 				<?php echo populate_list_array("lstuom", $uom_list, 'id','value', $stock->uom_id,$disable=false);?>
 			</div>

 			<div class="medium-2 columns">
 				<label for="stock">Opening Quantity</label>
 				<input type="text" name="txtqty" id="txtqty" value="<?php echo $opening_qty;?>"/>
 				<input type="hidden" name="hd_stkid" value="<?php echo $stk_id;?>"/>
 			</div>
 			<div class="medium-2 columns">
 				<label for="stock">Unit Rate</label>
 				<input type="text" name="txtrate" id="txtrate" value="<?php if($opening_rate) echo $opening_rate;?>"/>
 			</div>

 			<div class="medium-2 columns">
 				<input type="submit" name="submit" value="Save" class="tiny button"/>
 			</div>

 		</div>

 	</fieldset>
</form>


