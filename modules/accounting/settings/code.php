<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$fy_ledger_sub = new FyLedgerSub($myconnection);
$fy_ledger_sub->connection = $myconnection;

$ledger->ledger_id = LEDGER_CAPITAL_ACCOUNT;
$ledgers = $ledger->get_list_sub_array();


$financial_year = new FinancialYear($myconnection);
$financial_year->connection = $myconnection;

$financial_year->id = $account_settings->current_fy_id;
$financial_year->get_details();

$financial_years = $financial_year->get_list_array_for_account_settings();



if(isset($_POST['submit']) && $_POST['submit'] == "Save"){

	$errMSG = "";
	if($_POST['lstfy'] >0){
	}else{
		$errMSG .= "Select Financial Year<br>";
	}
	if($_POST['lstledger'] >0){
	}else{
		$errMSG .= "Select Default Capital<br>";
	}

	if($_POST['organization'] == ""){
		$errMSG .= "Enter Organization Name<br>";
	}
	if($_POST['address'] == ""){
		$errMSG .= "Enter address<br>";
	}

	if($errMSG == ""){
		//update current financial year
		$account_settings->current_fy_id = $_POST['lstfy'];
		$account_settings->default_capital = $_POST['lstledger'];
		$account_settings->organization_name = $_POST['organization'];
		$account_settings->organization_address = $_POST['address'];
		$account_settings->update();
			
		$account_settings->getAccountSettings();
		
		$fy_ledger_sub->fy_id = $account_settings->current_fy_id;
		$fy_ledger_sub->ledger_sub_id = $account_settings->default_capital;
		$fy_ledger_sub->update();

		$account_settings->updateSessionValues();
		$_SESSION[SESSION_TITLE.'flash'] = "Updated";
	    header( "Location:".$current_url);
	    exit();		
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errMSG;
	    header( "Location:".$current_url);
	    exit();
	}
	

}


?>