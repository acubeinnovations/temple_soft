<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form id="frm-fymaster" name="frm-fymaster" method="POST" action="<?php echo $current_url;?>">
<input type="hidden" value="<?php echo $financial_year->id;?>" name="hdfyid" />
 	<fieldset>
 		<legend>Add Financial Year </legend>

 			<div class="row">
	 			<div class="medium-2 columns">
	 				<label for="financial-year">Financial Year Start</label>
	 				<?php if(isset($_GET['edt'])) {?>
	 				<input type="text" name="txtfystart" id="fystart" value="<?php echo $financial_year->fy_start;?>" disabled/> 
	 				<?php }else{?>
	 				<input type="text" name="txtfystart" id="fystart" value="<?php echo $financial_year->fy_start;?>" class="mydatepicker"/>
	 				<?php }?>

	 			</div>
	 			<div class="medium-2 columns">
	 				<label for="financial-year">Financial Year End</label>
	 				<?php if(isset($_GET['edt'])) {?>
	 				<input type="text" name="txtfyend" id="fystart" value="<?php echo $financial_year->fy_end;?>" disabled/> 
	 				<?php }else{?>
	 				<input type="text" name="txtfyend" id="fyend" value="<?php echo $financial_year->fy_end;?>" class="mydatepicker"/>
	 				<?php }?>
	 			</div>
	 			<div class="medium-3 columns">
	 				<label for="financial-year">Financial Year Name</label>
	 				<input type="text" name="txtfyname" id="fyname" value="<?php echo $financial_year->fy_name;?>" />
	 			</div>

	 			<div class="medium-2 columns">
	 				<label for="financial-year">Closed</label>
	 				<select name="lststatus">
	 					<option value=1>No</option>
	 					<option value=0>Yes</option>
	 				</select>
	 			</div>

	 			<div class="medium-2 columns">
	 				<input type="submit" name="submit" value="<?php echo $submit_value;?>"  class="small button"/>

	 			</div>

 			</div>

 	</fieldset>
 </form>

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
		$slno = ($pagination->page_num*$pagination->max_records)+1;
	for($i=0; $i<$count_financial_years; $i++){
			
			$edit = $current_url."?edt=".$financial_years[$i]['fy_id'];
			$delete = $current_url."?dlt=".$financial_years[$i]['fy_id'];
	?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $financial_years[$i]['fy_start'];?></td>
			<td><?php echo $financial_years[$i]['fy_end'];?></td>
			<td><?php echo $financial_years[$i]['fy_name'];?></td>
			<td><?php echo $financial_years[$i]['fy_status'];?></td>
			<td>
				<a href="<?php echo $edit; ?>">Edit</a>
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