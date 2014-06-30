<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row" >
	<div class="medium-6 columns">
		<h3>Daily Collection</h3>
	</div>
	<div class="medium-6 columns">
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
		<label for="name">Date
		<input class="mydatepicker" name="txtdate" id="" value="<?php echo $data['date'];?>" /></label>
	</div>

	<div class="medium-4 columns">
		<label for="listpooja"> Pooja
		<?php echo populate_list_array("lstpooja", $poojas, 'id','name',$data['pooja_id'],$disable=false,true);?>
		</label>
	</div>

	<div class="medium-2 columns">
		<input type="submit" class="tiny button" value="Search" name="submit">
	</div>

</div>
</fieldset>
</form>

<div class="medium-12 columns">
<?php if($daily_collection){?>
<div class="row" >
	<table width="100%" id="tbl-append">
		<thead>
			<tr>
				<td width="50%"><font size="3">Pooja</font></td>
				<td width="20%"><font size="3">Rate</font></td>
				<td width="30%"><font size="3">Amount</font></td>
			</tr>
		</thead>
		<tbody
			<?php 
			$i=0;$total_amount = 0;
			while($i<count($daily_collection)){
				$total_amount += $daily_collection[$i]['amount'];
			?>
			<tr>
				<td><font size="3"><?php echo $daily_collection[$i]['pooja_name']." (".$daily_collection[$i]['quantity'].")"; ?></font></td>
				<td><font size="3"><?php echo number_format($daily_collection[$i]['rate'],2); ?></font></td>
				<td><font size="3"><?php echo number_format($daily_collection[$i]['amount'],2); ?></font></td>
			</tr>
			<?php $i++;}?>
			<tr style="font-weight:bold;">
				<td align="right" colspan="2"><font size="3">Total</font></td>
				<td><font size="3"><?php echo number_format($total_amount,2);?></font></td>
			</tr>
			
		</tbody>
	</table>
</div>

<div class="row">
	<?php echo $pagination->pagination_style_numbers();?>
</div>
<?php }else{
	echo "No Records Found";
}?>
</div>

<?php ob_start();?>
<?php if($count > 0){?>
	<table width="100%">
		<tr>
			<td width="100%" align="center" valign="middle">
			<h3><?php echo $account_settings->organization_name; ?></h3></br>
			<?php echo $account_settings->organization_address; ?>
			</td>
		</tr>
	</table>

	<h3>Daily Collection</h3>
	<p>Date : <?php echo $data['date'];?></p>

	<div>
	<?php if($daily_collection_all){?>

	<table width="100%" id="tbl-append">
		<!--<thead>
			
		</thead>-->
		<tbody>
			<tr>
				<th width="50%" align="left"><font size="3">Pooja</font></th>
				<th width="20%" align="left"><font size="3">Rate</font></th>
				<th width="30%" align="left"><font size="3">Amount</font></th>
			</tr>

			<?php 
			$i=0;$total_amount = 0;
			while($i<count($daily_collection_all)){
				$total_amount += $daily_collection_all[$i]['amount'];
			?>
			<tr>
				<td><font size="3">
					<?php echo $daily_collection_all[$i]['pooja_name']."(".$daily_collection_all[$i]['quantity'].")"; ?>
				</font></td>
				<td><font size="3"><?php echo number_format($daily_collection_all[$i]['rate'],2); ?></font></td>
				<td><font size="3"><?php echo number_format($daily_collection_all[$i]['amount'],2); ?></font></td>
			</tr>
			<?php $i++;}?>
			<tr style="font-weight:bold;">
				<td align="right" colspan="2"><font size="3">Total</font></td>
				<td><font size="3"><?php echo number_format($total_amount,2);?></font></td>
			</tr>
			
		</tbody>

		

	</table>
<?php }?>
</div>

<?php }else{?>

<?php }?>
<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	//echo $print_content;
	
?>



		



