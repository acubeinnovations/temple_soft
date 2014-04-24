<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<h3>Assign Menu</h3>
<form id="frmmenu" name="frmmenu" method="POST" action="" data-abide >
	<fieldset>
		<div class="row">
			<div class="medium-5 columns">
				<label for="menu">User<small>required</small>
					<?php echo populate_list_array("lstuser", $users, 'id','username', '',$disable=false);?>
				</label>
			</div>
		</div>

		<?php if($menu_list){?>
		<div class="row">
			<div class="medium-12 columns">
				<?php echo printTree($menu_list);?>
			</div>
		</div>
		<?php }?>
		
		<div class="row">
			<div class="text-center">
				<input class="tiny button"  value="submit" name="submit" type="submit"/>
				<input type="hidden" name="h_id" value="<?php echo $menu_item->id; ?>" />
			</div>
		</div>
	</fieldset>
</form>