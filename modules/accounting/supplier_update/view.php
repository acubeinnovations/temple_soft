<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3><?php echo (isset($_GET['edt']))?"Edit supplier":"Add supplier";?></h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_suppliers.php">List Supplier</a>
		</div>
	</div>
</div>



<form name="frmsupplier" id="frmsupplier" action="<?php echo $current_url;?>" method="POST">
<input type="hidden" name="hd_supplierid" value="<?php echo $supplier->supplier_id; ?>"/> 
	<fieldset>	
 		<div class="row">
	 		<div class="medium-4 columns">
				<label for="ledger">Name<span class="required">*</span></label>
				<input type="text" name="txtname" id="txtname" value="<?php echo $supplier->supplier_name;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Address<span class="required">*</span></label>
				<textarea name="txtaddress"><?php echo $supplier->supplier_address;?></textarea>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Phone<span class="required">*</span></label>
				<input type="text" name="txtphone" id="txtphone" value="<?php echo $supplier->supplier_phone;?>"/>
			</div>
		
			
		</div>
		<div class="row">
			
			<div class="medium-4 columns">
				<label for="ledger">Contact Person</label>
				<input type="text" name="txtperson" id="txtperson" value="<?php echo $supplier->contact_person;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Contact Mobile</label>
				<input type="text" name="txtmobile" id="txtmobile" value="<?php echo $supplier->contact_mobile;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Contact Email Id</label>
				<input type="text" name="txtemail" id="txtemail" value="<?php echo $supplier->contact_email;?>"/>
			</div>
	
		</div>

		
		<div class="row">

			<div class="medium-4 columns">
				<label for="ledger">Fax</label>
				<input type="text" name="txtfax" id="txtfax" value="<?php echo $supplier->supplier_fax;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">CST Number</label>
				<input type="text" name="txtcstnumber" id="txtcstnumber" value="<?php echo $supplier->supplier_cst_number;?>"/>
			</div>
		
			<div class="medium-4 columns">
				<label for="ledger">TIN Number</label>
				<input type="text" name="txttinnumber" id="txttinnumber" value="<?php echo $supplier->supplier_tin_number;?>"/>
			</div>
		</div>

		<div class="row">
			<div class="text-center">
				<input class="tiny button"  value="Save" name="submit" type="submit"/>
			</div>
		</div>
	

	</fieldset>

</form>

