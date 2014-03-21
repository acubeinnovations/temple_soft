<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<h3>Search by Star</h3>
<form id="" name ="form1" method="post" >

	<fieldset>
 		
 		<div class="row">
 			<div class="medium-6 columns">
    	<input type="text" name="search"  value="<?php  if(isset($_GET['search'])) { echo $_GET['search'];}?>"/>
     	 <input type="submit" name="submit" value="Search" class="small button" />
			<a href="star.php" class="small secondary button">Add New Star</a>
 			
 			</div>
 		</div>
 	</fieldset>
	<table width="100%">
  	<thead>

	<tr>
		<td width="10%">Sl no</td>
		<td>Star name</td>
		<td>Status</td>
	</tr>
		</thead>

		<?php if($array_stars==false){?>

		<tr>
			<td>No Records Found</td>
		</tr>

		<?php } else { 
			$i=0;
			$slno = ($pagination->page_num*$pagination->max_records)+1;
			while($i<$stars_count){
			
			?>

			<tr>
				<td><?php echo $slno; ?></td>
				<td><a href="star.php?id=<?php echo $array_stars[$i]['id'] ?>"><?php echo $array_stars[$i]['name'];  ?></td>
				<td><?php if(isset($g_ARRAY_STATUS[$array_stars[$i]['status_id']])){ echo $g_ARRAY_STATUS[$array_stars[$i]['status_id']];}?></td>
			</tr>

			<?php 
			$i++;
			$slno++;

		}
		}
			?>


<tr>
	<td colspan="3">
		<?php  $pagination->pagination_style_numbers();?>
	</td>
</tr>
</table>
</form>