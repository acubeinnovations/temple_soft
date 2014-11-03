<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row" >
	<div class="medium-6 columns">
		<h3><?php echo (isset($_GET['edt']))?"Edit Customer":"Add Customer";?></h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a class="tiny button" href="ac_customers.php">List Customers</a>
		</div>
	</div>
</div>



<form name="frmcustomer" id="frmcustomer" action="<?php echo $current_url;?>" method="POST">
<input type="hidden" name="hd_customerid" value="<?php echo $customer->customer_id; ?>"/> 
	<fieldset>
 		
 		<div class="row">
	 		<div class="medium-4 columns">
				<label for="ledger">Name<span class="required">*</span></label>
				<input type="text" name="txtname" id="txtname" value="<?php echo $customer->customer_name;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Phone</label>
				<input type="text" name="txtphone" id="txtphone" value="<?php echo $customer->customer_phone;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Mobile<span class="required">*</span></label>
				<input type="text" name="txtmobile" id="txtmobile" value="<?php echo $customer->customer_mobile;?>"/>
			</div>
		
			
		</div>
		<div class="row">
			<div class="medium-4 columns">
				<label for="ledger">Address<span class="required">*</span></label>
				<textarea name="txtaddress"><?php echo $customer->customer_address;?></textarea>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Email</label>
				<input type="text" name="txtemail" id="txtemail" value="<?php echo $customer->customer_email;?>"/>
			</div>
	
			<div class="medium-4 columns">
				<label for="ledger">Fax</label>
				<input type="text" name="txtfax" id="txtfax" value="<?php echo $customer->customer_fax;?>"/>
			</div>
		</div>

		
		<div class="row">
			<div class="medium-4 columns">
				<label for="ledger">CST Number</label>
				<input type="text" name="txtcstnumber" id="txtcstnumber" value="<?php echo $customer->customer_cst_number;?>"/>
			</div>
		
			<div class="medium-4 columns">
				<label for="ledger">TIN Number</label>
				<input type="text" name="txttinnumber" id="txttinnumber" value="<?php echo $customer->customer_tin_number;?>"/>
			</div>
		</div>

		<div class="row">
			<div class="text-center">
				<input class="tiny button"  value="Save" name="submit" type="submit"/>
			</div>
		</div>
	

	</fieldset>

</form>

