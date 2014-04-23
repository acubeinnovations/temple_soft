<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$pagination = new Pagination(10);

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$tax = new Tax($myconnection);
$tax->connection = $myconnection;


$tax->total_records=$pagination->total_records;

$tax_list = $tax->get_list_array_bylimit($pagination->start_record,$pagination->max_records);
if($tax_list <> false){
	$pagination->total_records = $tax->total_records;
	$pagination->paginate();
	$count_tax = count($tax_list);
}else{
	$count_tax = 0;
}

if(isset($_GET['dlt'])){
	$tax->id = $_GET['dlt'];
	$tax->get_details();
	$ledger->ledger_sub_name = $tax->name;
	$ledger_sub_id = $ledger->getLedgerId();
	$delete = $tax->delete();
	if($delete){
		if($ledger_sub_id){
			$ledger->ledger_sub_id = $ledger_sub_id;
			$ledger->delete();
		}
	}
	header( "Location:".$current_url);
    exit();
	
}




?>