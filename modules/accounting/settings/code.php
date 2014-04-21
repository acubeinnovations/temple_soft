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

	if($_POST['organization'] == ""){
		$errMSG .= "Enter Organization Name<br>";
	}
	if($_POST['address'] == ""){
		$errMSG .= "Enter address<br>";
	}

	if($errMSG == ""){
		//check current date is between fy dates
		$financial_year->id = $_POST['lstfy'];
		$financial_year->get_details();
		if(strtotime(CURRENT_DATE) > strtotime($financial_year->fy_start) and  strtotime(CURRENT_DATE) < strtotime($financial_year->fy_end)){
			//update current financial year
			$account_settings->current_fy_id = $_POST['lstfy'];
			$account_settings->default_capital = $_POST['lstledger'];
			$account_settings->organization_name = $_POST['organization'];
			$account_settings->organization_address = $_POST['address'];
			$account_settings->update();
			
			$account_settings->getAccountSettings();
			//echo $account_settings->default_capital;exit();
			//add ledger in fy_ledger_sub
			$fy_ledger_sub->ledger_sub_id = $account_settings->default_capital;
			$fy_ledger_sub->update();

			$financial_year->id = $account_settings->current_fy_id;
			$_SESSION[SESSION_TITLE.'fy_start_date'] = date('d-m-Y',strtotime($financial_year->fy_start));
			$_SESSION[SESSION_TITLE.'fy_end_date'] = date('d-m-Y',strtotime($financial_year->fy_end)); 
			$_SESSION[SESSION_TITLE.'flash'] = "Updated";
		    header( "Location:".$current_url);
		    exit();
			
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Invalid Financial Year";
		    header( "Location:".$current_url);
		    exit();
		}
		
		
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errMSG;
	    header( "Location:".$current_url);
	    exit();
	}
	

}


?>