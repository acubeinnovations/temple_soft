<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3>Add Financial Year</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_financial_years.php">List Financial Year</a>
		</div>
	</div>
</div>


<form id="frm-fymaster" name="frm-fymaster" method="POST" action="<?php echo $current_url;?>" data-abide >
<input type="hidden" value="<?php echo $financial_year->id;?>" name="hdfyid" />
	<?php if(isset($_GET['edt']) || $open_fy_count < 2){?>
 	<fieldset>
 			<div class="row">
	 			<div class="medium-3 columns">
	 				<label for="financial-year">Financial Year Start
		 				<?php if(isset($_GET['edt'])) {?>
		 				<input  name="txtfystart" id="fystart" value="<?php echo $financial_year->fy_start;?>" readonly requierd type="text"/> 
		 				<?php }else{?>
		 				<input  name="txtfystart" id="fystart" value="<?php echo $financial_year->fy_start;?>" class="fydatepicker" requierd type="text"/>
		 				<?php }?>
	 				</label>

	 			</div>
	 			<div class="medium-3 columns">
	 				<label for="financial-year">Financial Year End
	 				<?php if(isset($_GET['edt'])) {?>
	 				<input type="text" name="txtfyend" id="fyend" value="<?php echo $financial_year->fy_end;?>" class="fydatepicker" requierd /> 
	 				<?php }else{?>
	 				<input type="text"  name="txtfyend" id="fyend" value="<?php echo $financial_year->fy_end;?>" class="fydatepicker" requierd />
	 				<?php }?>
	 				</label>
	 			</div>
	 			<div class="medium-4 columns">
	 				<label for="financial-year">Financial Year Name<small>required</small>
	 				<input type="text" name="txtfyname" id="fyname" value="<?php echo $financial_year->fy_name;?>" required/>
	 				</label>
	 			</div>

	 			<div class="medium-2 columns">

	 				<input type="submit" name="submit" value="<?php echo $submit_value;?>"  class="tiny button"/>


	 			</div>

 			</div>

 	</fieldset>
 	<?php }else{?>
 	<fieldset>
 			<div class="row">
 				<div class="text-center">
 					Two opened financial years exist.
 				</div>
 			</div>
 	</fieldset>
 	<?php }?>
 </form>


