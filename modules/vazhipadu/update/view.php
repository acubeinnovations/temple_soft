<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form id="" name="form1" method="POST" >	
	<fieldset>
		<legend>Vazhipadu</legend>
		<div class="row">
		<div class="medium-3 columns">
			<input class="small button" name="addnew" id="addnew" value="Add new" type="button"/>
			<input type="hidden" name="count" value=1 id="count">
		</div>
	</div>


	<div class="row">
		<div class="medium-6 columns">
			<label for="name"> Date</label>
			<input class="mydatepicker" name="date" id="" value=""/>
		</div>
	</div>
	</br>
	
	<div id="load">
		<div id="default_row">
		<div class="row">
		<div class="medium-2 columns">
			<label for="name"> Name</label>
			<input type="text" name="name" id="" value=""/>
		</div>
		
		<div class="row">
		<div class="medium-2 columns">
			<label for="listpooja"> Select pooja</label>
			<?php echo populate_list_array("listpooja", $array_vazhipadu, 'id','name',$add_vazhipadu->pooja_id,$disable=false,true,'class=ratepooja');?>
		</div>


		<div class="row">
		<div class="medium-2 columns">
			<label for="rate">rate</label>
			<input type="text" name="rate" id="rate" value="<?php echo $add_vazhipadu->rate;?>" readonly/>
		</div>
	
		<div class="row">
		<div class="medium-2 columns">
			<label for="liststar"> Select Star</label>
			<?php echo populate_list_array("liststar", $array_star, 'id','name',$add_vazhipadu->star_id,$disable=false);?>
		</div>
			

	<div class="row">
	<div class="medium-2 columns">
			<label for="quantity">quantity</label>
			<input type="text" name="quantity" id="" value=""/>
	</div>

	<div class="row">
		<div class="medium-2 columns">
			<label for="name"> Date</label>
			<input class="mydatepicker" name="date" id="" value=""/>
		</div>
	</div>



	<!--<div class="row">
		<div class="medium-3 columns">
			<input class="small button" name="submit" id="" value="submit" type="submit"/>
			<input type="hidden" name="h_id" value=""/>
		</div>
	</div>-->
	
</div>
</div>




</fieldset>
</form>

