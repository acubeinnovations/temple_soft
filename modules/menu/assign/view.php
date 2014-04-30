<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<h3>Assign Menu</h3>
<form id="frmmenu" name="frmmenu" method="POST" action="" data-abide >
	<fieldset>
		<div class="row">
			<div class="medium-4 columns">
				<label for="menu">User<small>required</small>
					<?php echo populate_list_array("lstuser", $users, 'id','username', '',$disable=false);?>
				</label>
			</div>
		</div>

		<div class="row">
			<div class="medium-4 columns" id="dv-pages">
				<label for="menu">Pages<small>required</small>
				<?php echo populate_multiple_list_array("lstpage", $pages, 'id','nameStr', array(),$disable=false,false);?>
			</div>
			<div class="medium-2 columns text-center">
				<input type="button" value="Add" id="button-add" class="secondary tiny button" style="margin-top:30px;" />
				<input type="button" value="Remove" id="button-remove" class="secondary tiny button" style="margin-top:30px;" />
			</div>
			<div class="medium-4 columns" id="dv-user-pages">
				<label for="menu">User Pages<small>required</small>
				<?php echo populate_multiple_list_array("lstuserpages", $user_pages, 'id','nameStr', $user_pages,$disable=false,false);?>
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