<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form id="form1" name="form1" method="POST" data-abide >
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
			<input type="text"  name="txtamount" id="txtamount" value="" readonly required/>
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
				<input type="text"  name="txtqty" id="txtqty" value="" />
			</label>
		</div>
	

	</div>


	<div class="row">
		
	</div>

	<div class="row">
	<div class="medium-12 columns" id="dv-dtls">
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
					<td><input type="hidden" name="txtage" id="txtage" value="" /><input type="button" name="button-add" value="Add" id="button-add" class="tiny secondary button" /></td>
				</tr>
				
			<tbody>

			

		</table>
	</div>
	</div>

	<div class="row" >

		<div class="medium-5 columns" >
			<input type="submit" name="submit" value="Submit" class="tiny button" />

			<input type="button" name="button-print" value="Print" class="tiny button" />

			<input type="reset" id="button-cancel" name="button-cancel" value="Cancel" class="tiny button" />
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
		<td width="184" style="line-height: 17px !important;"><?php echo $add_vazhipadu->pooja_description; ?></td>
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
					$total += $vazhipadu_details[$i]['rate'];
				?>
				<tr height="10px"> 
					<td width="184" valign="bottom"><?php echo $vazhipadu_details[$i]['name']	;?></td>
					<td width="96" valign="bottom"><?php echo $vazhipadu_details[$i]['star']; ?></td>
					<td width="110" valign="bottom" align="center"><?php echo $vazhipadu_details[$i]['rate']; ?></td>
					
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
					<td width="110" align="center" valign="top"><?php echo $total;?></td>

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


