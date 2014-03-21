<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row">
	<div class="large-4 columns">
	<?php echo $ledger->error_description;?>
	</div>
</div>


<div class="row">
	<?php if($ledgers <> false){?>
	<div class="medium-4 columns" id="ledger_list">
		<fieldset>
	 		<legend>List Ledgers </legend>
	 		<?php echo $ledgers; ?>
	 	</fieldset>
	</div>
	<?php }?>
	

	<div class="medium-8 columns">
		<form id="frm-ledger" name="frm-ledger" method="POST" action="<?php echo $current_url;?>">

		<fieldset>
	 		<legend>Add Ledger </legend>
	 		<div class="row">
	 			<div class="medium-8 columns">
	 				<label for="ledger">Ledger Name</label>
	 				<input type="text" name="txtledger" id="txtledger" value="<?php //echo $add_pooja->name;?>"/>
	 			</div>
	 			<div class="medium-8 columns">
	 				<label for="ledger">Ledger Master</label>
	 				<?php echo populate_list_array("lstmledger", $ledger_masters, 'id','name', '',$disable=false);?>
	 			</div>

	 			<div class="medium-8 columns" id="sub-ledger">
	 				
	 				
	 			</div>

	 		</div>

	 		<div class="row">
	 			<div class="medium-8 columns">
	 				<input class="small button"  value="submit" name="submit" type="submit"/>
	 			</div>
 			</div>

	 	</fieldset>
	 	</form>
		
	</div>
</div>
