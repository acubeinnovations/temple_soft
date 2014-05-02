<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$pooja= new Pooja($myconnection);
$pooja->connection=$myconnection;
$poojas = $pooja->get_array();

$vazhipadu=new Vazhipadu($myconnection);
$vazhipadu->connection=$myconnection;
if(isset($_SESSION[SESSION_TITLE.'userid']) && isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] != ADMINISTRATOR )
$vazhipadu->user_id = $_SESSION[SESSION_TITLE.'userid'];

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$vazhipadu->total_records=$pagination->total_records;

$data = array();

if(isset($_GET['submit'])){
	
	$vazhipadu->from_date =  $_GET['txtfrom'];
	$vazhipadu->to_date   = $_GET['txtto'];
	$vazhipadu->pooja_id = $_GET['lstpooja'];

}else{
	$vazhipadu->from_date =  date('d-m-Y',strtotime(CURRENT_DATE));
	$vazhipadu->to_date   = date('d-m-Y',strtotime(CURRENT_DATE));
}


$vazhipadu_list = $vazhipadu->get_array_by_limit($pagination->start_record,$pagination->max_records,$data);
$vazhipadu_total_list = $vazhipadu->get_all_array($data);

if($vazhipadu_list){
	$pagination->total_records = $vazhipadu->total_records;
	$pagination->paginate();
	$count = count($vazhipadu_list);
}else{
	$count = 0;
}


?>