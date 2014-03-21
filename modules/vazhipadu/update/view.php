<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form id="form1" name="form1" method="POST" data-abide >
<input type="hidden" name="hd_moduleid" value="<?php echo MODULE_VAZHIPADU; ?>"/>

<div class="row" >
	<div class="medium-6 columns">
		<h3>Add Vazhipadu</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="small button" href="vazhipadu_register.php">Register</a>
		</div>
	</div>
</div>

<fieldset>

	<div class="row">
		<div class="medium-4 columns">
			<label for="listpooja"> Select pooja<small>required</small>
			<?php echo populate_list_array("listpooja", $array_vazhipadu, 'id','name',$add_vazhipadu->pooja_id,$disable=false,true);?>
			</label>
		</div>

		<div class="medium-2 columns">
			<label for="rate">Amount<small>required</small>
			<input type="text"  name="txtamount" id="txtamount" value="" readonly required/>
			</label>
			
		</div>

	
		<div class="medium-2 columns">
			<label for="name"> Date
			<input class="mydatepicker" name="txtdate" id="" value="<?php echo date('d-m-Y',strtotime(CURRENT_DATE));?>"/>
			</label>
		</div>

		

	</div>

	<div class="row">
		<div class="medium-2 columns">
			<label for="name"> Receipt Number :</label>
			
		</div>
	</div>

	<div class="row">
	<div class="medium-12 columns">
		<table width="70%" id="tbl-append">
			<thead>
				<tr>
					<td>Name</td>
					<td>Star</td>
					<td></td>
				</tr>
			<thead>
			<tbody
				<tr>
					<td><input  type="text" name="txtname" id="" value=""/></td>
					<td><?php echo populate_list_array("liststar", $array_star, 'id','name',$add_vazhipadu->star_id,$disable=false);?></td>
					<td><input type="hidden" name="txtage" id="txtage" value="" /><input type="button" name="button-add" value="Add" id="button-add"/></td>
				</tr>
				
			<tbody>

			

		</table>
	</div>
	</div>

	<div class="row" >

		<div class="medium-3 columns" >
			<input type="submit" name="submit" value="Save" />

			<input type="button" name="button-print" value="Print" />

			<input type="reset" name="button-cancel" value="Cancel" />
		</div>
		
	</div>




	
</fieldset>
</form>


