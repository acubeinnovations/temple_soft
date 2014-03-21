<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form id="" name="form1" method="POST" >
<div class="row" >
	<div class="medium-4 columns">
		<h3>Vazhipadu</h3>
	</div>

	<div class="text-right" style="margin-top:5px;">
		<a class="small button" href="vazhipadu.php">New</a>
	</div>
</div>

<fieldset>
<div class="row">		
	<div class="medium-2 columns">
		<label for="name"> From Date</label>
		<input class="mydatepicker" name="txtfrom" id="" value="<?php echo $from_date;?>"/>
	</div>

	<div class="medium-2 columns">
		<label for="name"> To Date</label>
		<input class="mydatepicker" name="txtto" id="" value="<?php echo $to_date;?>"/>
	</div>
	<div class="medium-2 columns">
		<input type="submit" class="small button" value="Search" name="submit">
	</div>

</div>
<?php if($count >0){?>
<div class="row">
	<table width="100%" id="tbl-append">
		<thead>
			<tr>
				<td width="10%">Voucher Number</td>
				<td width="20%">Date</td>
				<td>Pooja Details</td>
				<td width="15%">Amount</td>
			</tr>
		</thead>
		<tbody
			<?php 
			$i=0;$total_amount = 0;
			while($i<$count){
			?>
		<tr>
			<td><?php echo $vazhipadu_list[$i]['vazhipadu_rpt_number']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['vazhipadu_date']; ?></td>
			<td>
				<?php echo $vazhipadu_list[$i]['pooja_name']; 
				if($vazhipadu_list[$i]['details']){
				?>
				<table width="100%">
					<thead>
					<tr>
						<td width="50%">Name</td>
						<td width="30%">Star</td>
						<td width="20%">Amount</td>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($vazhipadu_list[$i]['details'] as $details) {?>
							<tr>
								<td><?php echo $details['name'];?></td>
								<td><?php echo $details['star'];?></td>
								<td><?php echo $vazhipadu_list[$i]['unit_rate']; ?></td>
								
							</tr>
						<?php }?>
					</tbody>
				</table>
				<?php }?>
				
			</td>
			<td><?php echo number_format($vazhipadu_list[$i]['amount'],2); ?></td>

		</tr>
		<?php $total_amount+=$vazhipadu_list[$i]['amount'];$i++;}?>
		<tr>
			<td colspan="3" align="right" style="font-weight:bold;">Total</td>
			<td><?php echo $total_amount;?></td>
		</tr>
			
		</tbody>

		

	</table>
</div>

<div class="row">
	<?php echo $pagination->pagination_style_numbers();?>
</div>

<?php }?>		



		
</fieldset>
</form>


