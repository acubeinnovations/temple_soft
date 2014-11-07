<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row" >
	<div class="medium-6 columns">
		<h3>Monthly Consolidate</h3>
	</div>
	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<input type="button" class="tiny button" value="print" id="button-print"/>
		</div>
	</div>
</div>


<form id="" name="form1" method="GET" >
	<fieldset>
	<div class="row">		
		<div class="medium-3 columns">
			<label for="name"> From Date
			<input class="mydatepicker" name="txtfrom" id="" value="<?php echo $data['from_date'];?>" /></label>
		</div>

		<div class="medium-3 columns">
			<label for="name"> To Date
			<input class="mydatepicker" name="txtto" id="" value="<?php echo $data['to_date'];?>" /></label>
		</div>


		<div class="medium-2 columns">
			<input type="submit" class="tiny button" value="Search" name="submit">
		</div>

	</div>
	</fieldset>
</form>



<?php ob_start();?>

	<table width="100%" class="print-head">
		<tr>
			<td width="100%" align="center" valign="middle">
			<h3><?php echo $account_settings->organization_name; ?></h3></br>
			<?php echo $account_settings->organization_address; ?>
			</td>
		</tr>
	</table>

	<h3>Monthly Consolidate</h3>
	<p>Date : <?php echo ($data['from_date'] == $data['to_date'])?$data['from_date']:$data['from_date']." To ".$data['to_date'];?></p>
	

	<div>
		<?php print_monthly_table($theader,$tbody,$tfooter,array('id'=>'tbl-append','width'=>'100%'));?>
	</div>

<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	echo $print_content;
	
?>



		



