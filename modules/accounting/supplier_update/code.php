<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$supplier=new Supplier($myconnection);
$supplier->connection=$myconnection;

$ledger=new Ledger($myconnection);
$ledger->connection=$myconnection;

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$suppliers = $supplier->get_list_array_bylimit($pagination->start_record,$pagination->max_records);

if($suppliers <> false){
	$pagination->total_records = $supplier->total_records;
	$pagination->paginate();
	$count_suppliers = count($suppliers);
}else{
	$count_suppliers = 0;
}

//edit
if(isset($_GET['edt'])){

	$supplier->supplier_id = $_GET['edt'];
	$supplier->get_details(); 
}
//delete
if(isset($_GET['dlt'])){
	$supplier->supplier_id = $_GET['dlt'];
	$delete = $supplier->delete();
	if($delete){
		$_SESSION[SESSION_TITLE.'flash'] = "supplier deleted";
        header( "Location:".$current_url);
        exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $supplier->error_description;
        header( "Location:".$current_url);
        exit();
	}
}


if(isset($_POST['submit'])){
	$errorMSG = "";

	//validation
	if(trim($_POST['txtname']) == ""){
		$errorMSG .= "supplier Name is required \n";
	}
	if(trim($_POST['txtaddress']) == ""){
		$errorMSG .= "supplier Address is required \n";
	}
	if(trim($_POST['txtphone']) == ""){
		$errorMSG .= "supplier Phone number is required \n";
	}
	if(!filter_var($_POST['txtemail'], FILTER_VALIDATE_EMAIL)){
		$errorMSG .= "Invalid Email Id \n";
	}
	

	if(trim($errorMSG) != ""){//validation failed
		$_SESSION[SESSION_TITLE.'flash'] = "Please fill all required fields";
        header( "Location:".$current_url);
        exit();
	}else{//validation true
		$supplier->supplier_phone = $_POST['txtphone'];
		if(!$supplier->validate()){
			$supplier->supplier_id = $_POST['hd_supplierid'];
			$supplier->supplier_name = $_POST['txtname'];
			$supplier->supplier_address = $_POST['txtaddress'];
			$supplier->supplier_fax = $_POST['txtfax'];
			$supplier->contact_person = $_POST['txtperson'];
			$supplier->contact_mobile = $_POST['txtmobile'];	
			$supplier->contact_email = $_POST['txtemail'];
			$supplier->supplier_cst_number = $_POST['txtcstnumber'];
			$supplier->supplier_tin_number = $_POST['txttinnumber'];

			if($supplier->supplier_id > 0){
				$supplier->get_details();
				$ledger->ledger_sub_name = $supplier->supplier_name;
				$ledger_sub_id = $ledger->getLedgerId();
			}else{
				$ledger_sub_id = false;
			}

			$update = $supplier->update();
			if($update){

				if($ledger_sub_id){
					$ledger->ledger_sub_id = $ledger_sub_id;
				}
				$ledger->ledger_sub_name = $_POST['txtname'];
				$ledger->ledger_id = LEDGER_SUNDRY_DEBITORS;
				$ledger->fy_id = $account_settings->current_fy_id;

				$ledger->update();

				$_SESSION[SESSION_TITLE.'flash'] = "Success";
	        	header( "Location:".$current_url);
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