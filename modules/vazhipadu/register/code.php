<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$user=new User($myconnection);
$user->connection=$myconnection;
$users = $user->get_array_for_list();


// voucher details
$voucher=new Voucher($myconnection);
$voucher->connection=$myconnection;
$voucher->module_id = MODULE_VAZHIPADU;
$voucher_details = $voucher->get_details_with_moduleid();
$voucher_number_array = $voucher->get_number_attributes($voucher->voucher_id);
//------------------------------------------------------------------------------

$pooja= new Pooja($myconnection);
$pooja->connection=$myconnection;
$poojas = $pooja->get_array();

$vazhipadu=new Vazhipadu($myconnection);
$vazhipadu->connection=$myconnection;


$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$vazhipadu->total_records=$pagination->total_records;

$data = array();

if(isset($_SESSION[SESSION_TITLE.'userid']) && isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] != ADMINISTRATOR ){
		$vazhipadu->user_id = $_SESSION[SESSION_TITLE.'userid'];
}elseif(isset($_GET['lstuser']) && $_GET['lstuser'] > 0){
	$vazhipadu->user_id = $_GET['lstuser'];
}

if(isset($_GET['submit'])){
	
	$vazhipadu->from_date =  $_GET['txtfrom'];
	$vazhipadu->to_date   = $_GET['txtto'];
	$vazhipadu->pooja_id = $_GET['lstpooja'];

	


}else{
	$vazhipadu->from_date =  date('d-m-Y',strtotime(CURRENT_DATE));
	$vazhipadu->to_date   = date('d-m-Y',strtotime(CURRENT_DATE));
	
}


//print columns 
if(!isset($_GET['lstpooja']) || $_GET['lstpooja'] == gINVALID){
	$cols = array('Voucher Number'=>array('width'=>10),
			'Booking Date'=>array('width'=>10),
			'Date'=>array('width'=>10),
			'Pooja'=>array('width'=>20),
			'Name'=>array('width'=>20),
			'Star'=>array('width'=>15),
			'Qty.'=>array('width'=>5),
			'Amt'=>array('width'=>10)
			);
	
}else{
	$pooja->id = $_GET['lstpooja'];
	$pooja->get_details();
	
	$cols = array('Name'=>array(),
			'Star'=>array('width'=>15),
			'Qty.'=>array('width'=>10),
			'Amt'=>array('width'=>10)
			);
}




$vazhipadu_list = $vazhipadu->get_array_by_limit($pagination->start_record,$pagination->max_records,$data);
list($vazhipadu_total_list,$grand_total) = $vazhipadu->get_all_array($data);

if($vazhipadu_list){
	$pagination->total_records = $vazhipadu->total_records;
	$pagination->paginate();
	$count = count($vazhipadu_list);
}else{
	$count = 0;
}




?>
