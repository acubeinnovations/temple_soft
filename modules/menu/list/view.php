<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3>List Menu</h3>
	</div>
	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="add_menu.php">Add New</a>
		</div>
	</div>
</div>

<form data-abide target="_self" method="GET" action="<?php echo $current_url?>" name="frmsearch" id="frmsearch">
	<fieldset>
		<div class="row">
			<div class="medium-5 columns">
				<label for="menu">Menu Name
					<input type="text" name="search"  value="<?php  if(isset($_GET['search'])) { echo $_GET['search'];}?>"/>				
				</label>
			</div>
			<div class="medium-2 columns">
		 		<input type="submit" name="submit" value="Search" class="tiny button" />
		 	</div>
		 	
		</div>
	</fieldset>
    
</form>


<?php if($count_menu > 0){?>
			
<table width="100%">
	<thead>
	<tr>
		<td width="5%">SlNo</td>
		<td width="25%">Name</td>
		<td width="25%">Parent Menu</td>
		<td width="35%">Link Url</td>
		<td width="10%">Status</td>
	</tr>
	</thead>

	<tbody>
	<?php
	$i=0;$slno = 1;
	foreach($menu_list as $menu){
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><a href="add_menu.php?id=<?php echo $menu['id'] ?>"><?php echo $menu['name']?></a></td>
		<td><?php echo $menu['parent_id']; ?></td>
		<td><?php echo $menu['link_url']; ?></td>
		<td><?php echo $g_ARRAY_STATUS[$menu['status']]; ?></td>
	</tr>
	<?php $slno++;}?>

	<tr>
		<td colspan="5"><?php  $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>



