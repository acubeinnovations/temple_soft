<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<h3>Add Menu</h3>
<form id="frmmenu" name="frmmenu" method="POST" action="" data-abide >
	<fieldset>
		<div class="row">
			<div class="medium-3 columns">
				<label for="menu">Name <small>required</small>
					<input type="text" name="txtname" id="txtname" value="<?php echo $menu_item->name;?>" required/>
				</label>
			</div>

			<div class="medium-3 columns">
				<label for="menu">Parent Menu <small>required</small>
					<?php echo populate_list_array("lstmenu", $menu_list, 'id','name', $menu_item->parent_id,$disable=false);?>
				</label>
			</div>
			<div class= "medium-2 columns">
 				<label for="listpooja">Status <small>required</small>
				<?php echo populate_list_array("lststatus", $g_ARRAY_LIST_STATUS, 'id','name', $menu_item->status,$disable=false,false);?>
 				</label>
 			</div>
 		
			<div class="medium-4 columns">
				<label for="menu">Link Url <small>required</small>
					<input type="text" name="txturl" id="txturl" value="<?php echo $menu_item->link_url;?>" required/>
				</label>
			</div>
		</div>
		
		<div class="row">
			<div class="text-center">
				<input class="tiny button"  value="submit" name="submit" type="submit"/>
				<input type="hidden" name="h_id" value="<?php echo $menu_item->id; ?>" />
			</div>
		</div>
	</fieldset>
</form>