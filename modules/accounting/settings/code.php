<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$ledger->ledger_id = LEDGER_CAPITAL_ACCOUNT;
$ledgers = $ledger->get_list_sub_array();


$financial_year = new FinancialYear($myconnection);
$financial_year->connection = $myconnection;

$financial_year->id = $account_settings->current_fy_id;
$financial_year->get_details();

$financial_years = $financial_year->get_list_array();



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
	if($errMSG == ""){
		//update current financial year
		$account_settings->current_fy_id = $_POST['lstfy'];
		$account_settings->default_capital = $_POST['lstledger'];
		$account_settings->update();
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