<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>


<div class="row" >
	<div class="medium-4 columns">
		<h3>Vazhipadu Register</h3>
	</div>
<div class="medium-8 columns">
	<div class="text-right" style="margin-top:5px;">
		<a class="tiny button" href="vazhipadu.php">New</a>
		<input type="button" class="tiny button" value="print" id="button-print"/>
	</div>
	</div>
</div>

<form id="" name="form1" method="GET" >
	<fieldset>
		<div class="row">		
			<div class="medium-2 columns">
				<label for="name"> From Date
				<input class="mydatepicker" name="txtfrom" id="" value="<?php echo $vazhipadu->from_date;?>" /></label>
			</div>

			<div class="medium-2 columns">
				<label for="name"> To Date
				<input class="mydatepicker" name="txtto" id="" value="<?php echo $vazhipadu->to_date;?>" /></label>
			</div>

			<div class="medium-2 columns">
				<label for="listpooja"> Pooja
				<?php echo populate_list_array("lstpooja", $poojas, 'id','name',$vazhipadu->pooja_id,$disable=false,true);?>
				</label>
			</div>
			<?php if(isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] == ADMINISTRATOR){?>
			<div class="medium-2 columns">
				<label for="listpooja"> Users
				<?php echo populate_list_array("lstuser", $users, 'id','name',$vazhipadu->user_id,$disable=false,true);?>
				</label>
			</div>
			<?php }?>

			<div class="medium-2 columns">
				<input type="submit" class="tiny button" value="Search" name="submit">
			</div>

		</div>
	</fieldset>
</form>

<div class="medium-12 columns">
<?php if(isset($count)){?>
<div class="row">

	<table width="100%" id="tbl-append">
		<thead>
			<tr>
				<td width="8%">Voucher Number</td>
				<td width="10%">Date</td>
				<td width="30%">Pooja</td>
				<td>Name</td>
				<td width="15%">Star</td>
				<td width="15%">Quantity</td>
				<td width="10%">Amount</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=0;$total_amount = 0;
			while($i<$count){
			?>
		<tr>
			<td>
			<?php echo printVoucherNumber($vazhipadu_list[$i]['vazhipadu_rpt_number'],$voucher_number_array); ?>
			</td>
			<td><?php echo $vazhipadu_list[$i]['vazhipadu_date']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['pooja_name']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['name']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['star_name']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['quantity']; ?></td>
			<td><?php echo number_format($vazhipadu_list[$i]['amount'],2); ?></td>
		</tr>
		<?php $total_amount+=$vazhipadu_list[$i]['unit_rate']*$vazhipadu_list[$i]['quantity'];$i++;}?>
		<tr style="font-weight:bold;">
			<td colspan="6" align="right" >Total</td>
			<td><?php echo number_format($total_amount,2);?></td>
		</tr>
			
		</tbody>

		

	</table>


	</div>
</div>
<div class="medium-12 columns">
<div class="row">
	<?php echo $pagination->pagination_style_numbers();?>
</div></div>

<?php }else{?>		
<div class="medium-12 columns">
<div class="text-center">
No Records Found
</div>
</div>

<?php }?>





<?php ob_start();?>
<table width="100%">
		<tr>
			<td width="100%" align="center" valign="middle">
<h3><?php echo $account_settings->organization_name; ?></h3></br>
<?php echo $account_settings->organization_address; ?>
</td>
		</tr>
		</table>
<h3>Vazhipadu Register</h3>
<p>Date : <?php echo ($vazhipadu->from_date == $vazhipadu->to_date)?$vazhipadu->from_date:$vazhipadu->from_date." - ".$vazhipadu->to_date;?></p>
<div>
<?php if($vazhipadu_total_list){?>

<table width="100%" id="tbl-append">
		<thead>
			<tr>
				<td width="8%"><font size="3">Voucher Number</font></td>
				<td width="10%"><font size="3">Date</font></td>
				<td width="30%"><font size="3">Pooja</font></td>
				<td><font size="3">Name</font></td>
				<td width="15%"><font size="3">Star</font></td>
				<td width="15%"><font size="3">Quantity</font></td>
				<td width="10%"><font size="3">Amount</font></td>
			</tr>
		</thead>
		<tbody
			<?php 
			$i=0;$total_amount = 0;
			while($i<count($vazhipadu_total_list)){
			?>
		<tr>
			<td><font size="3"><?php echo $vazhipadu_total_list[$i]['vazhipadu_rpt_number']; ?></font></td>
			<td><font size="3"><?php echo $vazhipadu_total_list[$i]['vazhipadu_date']; ?></font></td>
			<td><font size="4"><?php echo $vazhipadu_total_list[$i]['pooja_name']; ?></font></td>
			<td><font size="3"><?php echo $vazhipadu_total_list[$i]['name']; ?></font></td>
			<td><font size="3"><?php echo $vazhipadu_total_list[$i]['star_name']; ?></font></td>
			<td><font size="3"><?php echo $vazhipadu_total_list[$i]['quantity']; ?></font></td>
			<td><font size="3"><?php echo number_format($vazhipadu_total_list[$i]['amount'],2); ?></font></td>
		</tr>
		<?php $total_amount+=$vazhipadu_total_list[$i]['unit_rate']*$vazhipadu_total_list[$i]['quantity'];$i++;}?>
		<tr style="font-weight:bold;">
			<td colspan="6" align="right" ><font size="3">Total</font></td>
			<td><font size="3"><?php echo number_format($total_amount,2);?></font></td>
		</tr>
			
		</tbody>

		

	</table>
<?php }?>
</div>
<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	//echo $print_content;
	
?>



		



