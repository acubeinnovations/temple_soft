<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
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



$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$tax = new Tax($myconnection);
$tax->connection = $myconnection;

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$fy_ledger_sub = new FyLedgerSub($myconnection);
$fy_ledger_sub->connection = $myconnection;



if(isset($_GET['edt'])){
	$tax->id = $_GET['edt'];
	$tax->get_details();
	
}


if(isset($_POST['submit'])){

	$errorMSG = "";
	if(trim($_POST['txtname']) == ""){
		$errorMSG = "Tax name is empty \n";
	}

	if(trim($_POST['txtrate']) == ""){
		$errorMSG = "Enter tax rate\n";
	}
	
	if(trim($errorMSG) == ""){
		$tax->id = $_POST['hd_taxid'];
		$tax->name = $_POST['txtname'];
		if($tax->validate()){
			$ledger->ledger_sub_id = $tax->ledger_sub_id;
			$ledger->ledger_sub_name = $_POST['txtname'];
			$ledger->ledger_id = LEDGER_DUTIES_AND_TAXES;
			$ledger->fy_id = $account_settings->current_fy_id;

			$update = $ledger->update();
			if($update){
				//add ledger in fy_ledger_sub
				$fy_ledger_sub->ledger_sub_id = $ledger->ledger_sub_id;
				$fy_ledger_sub->update();

				//tax update
				$tax->ledger_sub_id = $ledger->ledger_sub_id;
				$tax->name = $_POST['txtname'];
				$tax->rate = $_POST['txtrate']/100;
				$tax->status = $_POST['lststatus'];
				$update = $tax->update();
			}
			if($update){
				$_SESSION[SESSION_TITLE.'flash'] = "Success";
		        header( "Location:".$current_url);
		        exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] = "Failed to add data";
		        header( "Location:".$current_url);
		        exit();
			}
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Data already exists";
	        header( "Location:".$current_url);
	        exit();
		}	
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url);
        exit();
	}
}


?>