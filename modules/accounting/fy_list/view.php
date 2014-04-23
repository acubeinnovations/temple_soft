<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3>List Financial Year</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_financial_year.php">Add New</a>
		</div>
	</div>
</div>


<?php if($count_financial_years > 0){?>

<table width="100%">
	<thead>
		<tr>
			<td>Sl no</td>
			<td>Finacial Year Start</td>
			<td>Finacial Year End</td>
			<td>Finacial Year Name</td>
			<td>Closed</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	<?php 
		$closing_year = false;
		$closing_count = 0;
		
		$slno = ($pagination->page_num*$pagination->max_records)+1;
	for($i=0; $i<$count_financial_years; $i++){
			
			$edit = "ac_financial_year.php?edt=".$financial_years[$i]['fy_id'];
			$delete = $current_url."?dlt=".$financial_years[$i]['fy_id'];
			$close = $current_url."?cls=".$financial_years[$i]['fy_id'];

			if($financial_years[$i]['fy_id'] == $current_fy_id){
				$class="current_fy";
			}else{
				$class="";	
			}
	?>
		<tr class="<?php echo $class;?>">
			<td><?php echo $slno;?></td>
			<td><?php echo $financial_years[$i]['fy_start'];?></td>
			<td><?php echo $financial_years[$i]['fy_end'];?></td>
			<td><?php echo $financial_years[$i]['fy_name'];?></td>
			<td><?php echo $financial_years[$i]['fy_status'];?></td>
			<td>
				<?php if($last_record['id'] == $financial_years[$i]['fy_id'] and $financial_years[$i]['status'] == FINANCIAL_YEAR_OPEN ){?>
				<a href="<?php echo $edit; ?>">Edit</a>
				<?php }?>
				<?php  if($closing_year==false && ($count_financial_years - $closing_count) > 1 && $financial_years[$i]['status'] == FINANCIAL_YEAR_OPEN  ){ ?>
				<a href="javascript:closeFY(<?php echo $financial_years[$i]['fy_id']?>)" >Close</a>
				
				<?php 
						$closing_year=true; } $closing_count++; ?>
				<!--<a href="javascript:deleteFY(<?php echo $financial_years[$i]['fy_id']?>)" >Delete</a>-->
			</td>
		</tr>
	<?php $slno++; }?>
		<tr>
			<td colspan="6"><?php echo $pagination->pagination_style_numbers();?></td>
		</tr>
	</tbody>

</table>

<?php }?>
