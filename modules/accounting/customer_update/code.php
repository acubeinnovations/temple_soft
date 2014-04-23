<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

//check current date with current financial year
$check =checkFinancialYear($_SESSION[SESSION_TITLE.'fy_status'],$_SESSION[SESSION_TITLE.'fy_start_date'],

$_SESSION[SESSION_TITLE.'fy_end_date']);
if(!$check){
	$_SESSION[SESSION_TITLE.'flash'] = "Please check Financial Year";
    header( "Location:index.php");
    exit();
}
//checking financial year ends





$pagination = new Pagination(10);

$customer=new Customer($myconnection);
$customer->connection=$myconnection;

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$fy_ledger_sub = new FyLedgerSub($myconnection);
$fy_ledger_sub->connection = $myconnection;

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();



//edit
if(isset($_GET['edt'])){

	$customer->customer_id = $_GET['edt'];
	$customer->get_details(); 
}


if(isset($_POST['submit'])){
	$errorMSG = "";

	//validation
	if(trim($_POST['txtname']) == ""){
		$errorMSG .= "Customer Name is required <br>";
	}
	if(trim($_POST['txtaddress']) == ""){
		$errorMSG .= "Customer Address is required <br>";
	}
	if(trim($_POST['txtmobile']) == ""){
		$errorMSG .= "Customer Mobile number is required <br>";
	}
	if(trim($_POST['txtemail']) != "" ){
		if(!filter_var($_POST['txtemail'], FILTER_VALIDATE_EMAIL)){
			$errorMSG .= "Invalid Email Id <br>";
		}
	}


	if(trim($errorMSG) != ""){//validation failed
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url);
        exit();
	}else{//validation true
		$customer->customer_id = $_POST['hd_customerid'];
		$customer->customer_name = $_POST['txtname'];
		if($customer->validate()){
			$ledger->ledger_sub_id = $customer->ledger_sub_id;
			$ledger->ledger_sub_name = $_POST['txtname'];
			$ledger->ledger_id = LEDGER_SUNDRY_CREDITORS;
			$ledger->fy_id = $account_settings->current_fy_id;
			
			$ledger_sub_id = $ledger->update();

			if($ledger_sub_id){
				//add ledger in fy_ledger_sub
				$fy_ledger_sub->ledger_sub_id = $ledger->ledger_sub_id;
				$fy_ledger_sub->update();
				
				//add customer
				$customer->ledger_sub_id = $ledger->ledger_sub_id;
				$customer->customer_name = $_POST['txtname'];
				$customer->customer_mobile = $_POST['txtmobile'];
				$customer->customer_address = $_POST['txtaddress'];
				$customer->customer_phone = $_POST['txtphone'];
				$customer->customer_fax = $_POST['txtfax'];
				$customer->customer_email = $_POST['txtemail'];
				$customer->customer_cst_number = $_POST['txtcstnumber'];
				$customer->customer_tin_number = $_POST['txttinnumber'];
				$update = $customer->update();
			}
			
			if($update){
				$_SESSION[SESSION_TITLE.'flash'] = "Success";
	        	header( "Location:ac_customers.php");
	        	exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] = "Failed";
		        header( "Location:".$current_url);
		        exit();
			}
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Invalid entry";
	        header( "Location:".$current_url);
	        exit();
		}
	}
	
}



?>