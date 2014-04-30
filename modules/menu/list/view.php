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
					<input type="text" name="txtsearch"  value="<?php  if(isset($_GET['search'])) { echo $_GET['search'];}?>"/>				
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
		<td width="20%">Name</td>
		<td width="20%">Parent Menu</td>
		<td width="35%">Page</td>
		<td width="10%">Status</td>
		<td width="10%"></td>
	</tr>
	</thead>
	<tbody>
	<?php 
	$i =0;$slno = ($pagination->page_num*$pagination->max_records)+1;
	while($i<$count_menu){
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><?php echo $menu_list[$i]['name']?></td>
		<td><?php echo ($menu_list[$i]['parent_name'] != "")?$menu_list[$i]['parent_name']:"-"; ?></td>
		<td><?php echo ($menu_list[$i]['pageStr'] != "")?$menu_list[$i]['pageStr']:"-"; ?></td>
		<td><?php echo $g_ARRAY_STATUS[$menu_list[$i]['status']]; ?></td>
		<td>
			<a href="add_menu.php?id=<?php echo $menu_list[$i]['id'] ?>">edit</a>/
			<a href="javascript:deleteMenuItem(<?php echo $menu_list[$i]['id']?>)">delete</a>
		</td>
	</tr>
	<?php $i++;$slno++;}?>

	<tr>
		<td colspan="5"><?php  $pagination->pagination_style_numbers();?></td>
	</tr>

</table>
<?php }?>
