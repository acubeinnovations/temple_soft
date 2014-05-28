<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$account=new Account($myconnection);
$account->connection=$myconnection;

$pooja= new Pooja($myconnection);
$pooja->connection=$myconnection;
$poojas = $pooja->get_array();

// voucher details
$voucher=new Voucher($myconnection);
$voucher->connection=$myconnection;
$voucher->module_id = MODULE_VAZHIPADU;
$voucher_details = $voucher->get_details_with_moduleid();

$vazhipadu=new Vazhipadu($myconnection);
$vazhipadu->connection=$myconnection;
$data = array();
if(isset($_SESSION[SESSION_TITLE.'userid']) && isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] != ADMINISTRATOR ){
	$data['user_id'] = $_SESSION[SESSION_TITLE.'userid'];
}
$data['date'] =  date('d-m-Y',strtotime(CURRENT_DATE));
$data['pooja_id'] = -1;

if(isset($_GET['txtdate'])){
	$data['date'] =  $_GET['txtdate'];
}
if(isset($_GET['lstpooja'])){
	$data['pooja_id'] = $_GET['lstpooja'];
}

$pooja->voucher_id = $voucher->voucher_id;

$daily_collection = $pooja->get_pooja_collection_limit($data,$pagination->start_record,$pagination->max_records);

$daily_collection_all = $pooja->get_pooja_collection($data);


if($daily_collection){
	$pagination->total_records = $pooja->total_records;
	$pagination->paginate();
	$count = count($daily_collection);
}else{
	$count = 0;
}


?>