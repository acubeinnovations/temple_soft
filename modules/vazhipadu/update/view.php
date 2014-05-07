<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form id="form-vazhipadu" name="form-vazhipadu" method="POST" data-abide >
<input type="hidden" name="hd_moduleid" value="<?php echo $voucher->module_id; ?>"/>

<div class="row" >
	<div class="medium-6 columns">
		<h3>Add Vazhipadu</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="vazhipadu_register.php">Register</a>
			<a class="tiny button" href="vazhipadu_bookings.php">Advance Bookings</a>
		</div>
	</div>
</div>

<fieldset>
	<input type="hidden" name="hd_rpt_no" id="hd_rpt_no" value="<?php echo $voucher_number;?>"/>

	<!--<div class="row">
		<div class="medium-3 columns">
			<label for="name">
			<input type="text" name="txtrpt" id="txtrpt" value="Receipt Number : <?php echo $voucher_number;?>" readonly/>
			
		</div>
	</div>-->

	<div class="row">
		<div class="medium-4 columns">
			<label for="listpooja"> Select pooja<small>required</small>
			<?php echo populate_list_array("listpooja", $array_vazhipadu, 'id','name',$add_vazhipadu->pooja_id,$disable=false,true);?>
			</label>
		</div>

		<div class="medium-2 columns">
			<label for="rate">Amount<small>required</small>
			<input type="text"  name="txtamount" id="txtamount" value="<?php echo $add_vazhipadu->amount;?>" readonly required/>
			<input type="hidden" name="hd_ledger_id" id="hd_ledger_id" value=""/>
			</label>
			
		</div>
		<div class="medium-2 columns">
			<label for="name"> Date
			<input class="mydatepicker"  name="txtdate" id="txtdate" value="<?php echo date('d-m-Y',strtotime(CURRENT_DATE));?>"/>
			</label>
		</div>

		<div class="medium-2 columns">
			<label for="name">	
				<input type="checkbox" name="chk_qty" id="chk_qty" > Quantity
				<input type="text"  name="txtqty" id="txtqty" value="<?php echo ($txtquantity)?$txtquantity:'';?>" />
			</label>
		</div>
	

	</div>


	<div class="row">
		
	</div>

	<div class="row">
	<div class="medium-12 columns" id="dv-dtls">
		<table width="83%" id="tbl-append">
			<thead>
				<tr>
					<td width="40%">Name</td>
					<td width="35%">Star</td>
					<td width="5%">Quantity</td>
					<td width="3%"></td>
				</tr>
			<thead>
			<tbody
				<tr>
					<td><input  type="text" name="txtname" id="" value=""/></td>
					<td><?php echo populate_list_array("liststar", $array_star, 'id','name',$add_vazhipadu->star_id,$disable=false);?></td>
					<td><input  type="text" name="txtquantity" id="" value="1"/></td>
					<td><input type="hidden" name="txtage" id="txtage" value="" /><input type="button" name="button-add" value="Add" id="button-add" class="tiny secondary button" /></td>
				</tr>

				<?php if($vazhipadu_details_cn){
						foreach($vazhipadu_details_cn as $row){
							$hiddenStr = $row['name'].'_'.$row['star_id'].'_'.$row['quantity'];

				?>
				<tr class="new_rows">
					<td>
						<?php echo $row['name'];?>
						<input type="hidden" class="hide-rows" name="hd_row[]" value="<?php echo $hiddenStr;?>">
					</td>
					<td><?php echo $row['star'];?></td>
					<td><?php echo $row['quantity'];?></td>
					<td></td>
				</tr>
				<?php }
				}?>
				
			<tbody>

			

		</table>
	</div>
	</div>

	<div class="row" >

		<div class="medium-5 columns" >
			<input type="submit" name="submit" id="btn-submit" value="<?php echo $submit_value;?>" class="tiny button" />

			<!--<input type="button" name="button-print" value="Print" class="tiny button" />-->

			<input type="reset" id="button-cancel" name="button-cancel" value="Cancel" class="tiny button" />

			<input type="button" name="button-continue" id="button-continue" value="Continue" class="tiny button" />

			<input type="hidden" value="0" name="hd_continue" id="hd_continue" />
		</div>
		
	</div>




	
</fieldset>
</form>
<?php if($vazhipadu_details){?>
<?php ob_start(); ?>
<style> 
table tr td{
line-height: 2px !important;
}
</style>
<table width="420px" cellspacing="0" cellpadding="0" >

	<tr style="height:40px !important;">
		<td width="184" style="line-height: 17px !important;"><?php echo $add_vazhipadu->pooja_description; ?> (<?php echo $variable['total_quantity'];?>)</td>
		<td width="96" >&nbsp;</td>
		<td width="110" style="line-height: 6px !important;" valign="top" align="center">

			<?php echo $add_vazhipadu->vazhipadu_rpt_number; ?><br/><br/>
			<?php echo date("d-m-Y");?>
		</td>
	</tr>

	<tr>
		<td   colspan="3" height="95px">
			
			<table width="420px" style="min-height:95px !important;">
				<?php $i=0;$total = 0;$j=4;
				while($i<count($vazhipadu_details)){
					$total += $vazhipadu_details[$i]['amount'];
					
				?>
				<tr height="10px"> 
					<td width="184" valign="bottom"><?php echo $vazhipadu_details[$i]['name']	;?></td>
					<td width="96" valign="bottom"><?php echo $vazhipadu_details[$i]['star']; ?></td>
					<td width="110" valign="bottom" align="center"><?php echo $vazhipadu_details[$i]['amount']; ?></td>
					
				</tr>
				<?php $i++;$j--;}?>
				<?php for($k=0; $k < $j; $k++){?>
				<tr height="5px">
					<td colspan="3"></td>
				</tr>
				<?php }?>
	    	</table>
	    	
		</td>
	</tr>

	<tr height="5px">
	<td width="184" >&nbsp;</td>
					<td width="96">&nbsp;</td>
					<td width="110" align="center" valign="top"><?php echo $variable['total_amount'];?></td>

	</tr>

	<tr height="5px">
		 <td align="right" valign="top"><?php echo $add_vazhipadu->vazhipadu_date; ?></td>
		<td  colspan="2"></td>
	</tr>
</table>



<?php 
$print_content = ob_get_contents();
ob_end_clean();
//echo $print_content;?>

	<?php }?>


