<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}


?>

<div class="row" >
	<div class="medium-4 columns">
		<h3>Pooja Register</h3>
	</div>
<div class="medium-8 columns">
	<div class="text-right" style="margin-top:5px;">
		<input type="button" class="small button" value="print" id="button-print"/>
	</div>
	</div>
</div>

<form id="frmpooja" name="frmpooja" method="POST" action="<?php echo $current_url;?>">
	<fieldset>
		<div class="row">
			<div class="medium-4 columns">
				<label>Pooja Date</label>
				<input type="text" class="mydatepicker" name="txtdate" id="txtdate" value="<?php echo date('d-m-Y',strtotime($pooja->vazhipadu_date));?>"/>
			</div>
			<div class="medium-6 columns">
				<input type="submit" name="submit" value="Filter" class="small button"/>
			</div>
			
		</div>
	</fieldset>
</form>

<div class="row">
<div class="medium-12 columns">
<?php if($count_pooja > 0){?>
	<table width="100%">
		<thead>
		<tr>
			<td width="10%">Slno</td>
			<td width="45%">Pooja Details</td>
			<td width="15%">Unit Rate</td>
			<td width="15%">Qty</td>
			<td width="15%">Total</td>
		</tr>
		</thead>
		<tbody>
		<?php 
			$i=0;$slno = ($pagination->page_num*$pagination->max_records)+1;
			while($i<$count_pooja){
		?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $pooja_list[$i]['name']?></td>
			<td><?php echo $pooja_list[$i]['rate']?></td>
			<td><?php echo $pooja_list[$i]['quantity']?></td>
			<td><?php echo $pooja_list[$i]['total']?></td>
		</tr>
		<?php
				$i++;$slno++;
			}
		?>
		<tr>
			<td width="10%"></td>
			<td width="45%"><strong>Total</strong> </td>
			<td width="15%"> </td>
			<td width="15%"></td>
			<td width="15%"></td>
		</tr>
		<tr>
			<td colspan="5"><?php  $pagination->pagination_style_numbers();?></td>
		</tr>
		</tbody>
	</table>
<?php }else{?>
	No Records Found;
<?php }?>

</div>
</div>

<?php ob_start();?>
<div id="print_content" >
	<?php if(count($pooja_total_list) > 0){?>
	<table width="100%">
		<thead>
		<tr>
			<td width="10%">Slno</td>
			<td width="50%">Pooja Details</td>
			<td width="15%">Unit Rate</td>
			<td width="10%">Qty</td>
			<td >Total</td>
		</tr>
		</thead>
		<tbody>
		<?php 
			$i=0;$slno = 1;
			while($i<count($pooja_total_list)){
		?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $pooja_total_list[$i]['name']?></td>
			<td><?php echo $pooja_total_list[$i]['rate']?></td>
			<td><?php echo $pooja_total_list[$i]['quantity']?></td>
			<td><?php echo $pooja_total_list[$i]['total']?></td>
		</tr>
		<?php
				$i++;$slno++;
			}
		?>
		
		</tbody>
	</table>
<?php }else{?>
	No Records Found;
<?php }?>
</div>
<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	//echo $print_content;
	
?>