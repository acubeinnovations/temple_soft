<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3><?php echo (isset($_GET['id']))?"Edit Menu":"Add Menu"; ?></h3>
	</div>
	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="list_menu.php">List Menu</a>
		</div>
	</div>
</div>


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
				<label for="menu">Link Url 
					<input type="text" name="txturl" id="txturl" value="<?php echo $menu_item->link_url;?>"/>
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