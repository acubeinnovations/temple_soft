<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$financial_year = new FinancialYear($myconnection);
$financial_year->connection = $myconnection;

$financial_year->id = $account_settings->current_fy_id;
$financial_year->get_details();

$financial_years = $financial_year->get_list_array();



if(isset($_POST['submit']) && $_POST['submit'] == "Save"){

	//update current financial year
	$account_settings->current_fy_id = $_POST['lstfy'];
	$account_settings->updateCurrentFY();
	$_SESSION[SESSION_TITLE.'flash'] = "Updated";
    header( "Location:".$current_url);
    exit();

}


?>