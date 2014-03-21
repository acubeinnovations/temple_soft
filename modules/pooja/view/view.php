<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form data-abide target="_self" method="GET" action="<?php echo $current_url?>" name="frmsearch" id="frmsearch">
	<fieldset>
 		<legend>Search by Pooja: </legend>

 		<div class="row">
 			<div class="medium-5 columns">
    			<input type="text" name="search"  value="<?php  if(isset($_GET['search'])) { echo $_GET['search'];}?>"/>
    		</div>
    		<div class="medium-2 columns">
     	 		<input type="submit" name="submit" value="Search" class="small button" />
     	 	</div>

 			<div class="text-right">
 			<a href="pooja.php" class="small button">Add New</a>
 				<a href="pooja_register.php" class="small button">Register</a>
 			</div>

 		</div>
 	</fieldset>
    
</form>

      


	
 		
  <table width="100%">
  		<thead>
	<tr>
		<td ></td>
		<td>Sl no</td>
		<td>name</td>
		<td>Rate</td>
		<td>Status</td>

	</tr>
		</thead>

<?php
	if($array_poojas==false){

?>
	<tr>
		<td>No Records found</td>
	</tr>
	<?php } else { 
		$i=0;
		while($i<$count_poojas){
		?>

<tr>
	<td>
		<td><?php echo $array_poojas[$i]['id']?></td>
		<td><a href="pooja.php?id=<?php echo $array_poojas[$i]['id'] ?>"><?php echo $array_poojas[$i]['name']?></td>
		<td><?php echo $array_poojas[$i]['rate']?></td>
		<td><?php if(isset($g_ARRAY_STATUS[$array_poojas[$i]['status_id']])){ echo $g_ARRAY_STATUS[$array_poojas[$i]['status_id']];}?></td>

	
</tr>
<?php
$i++;
}
}
?>

<tr>
	<td colspan="6">
<?php  $pagination->pagination_style_numbers();?>
</td>
</tr>



</table>
</fieldset>


