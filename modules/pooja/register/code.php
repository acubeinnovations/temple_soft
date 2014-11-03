<?php
if(!defined('CHECK_INCLUDED')){
	exit();
} 

$pooja= new Pooja($myconnection);
$pooja->connection=$myconnection;
$poojas = $pooja->get_array();


$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$pagination = new Pagination(10);

if(isset($_GET['submit'])){
	
	$pooja->from_date =  $_GET['txtfrom'];
	$pooja->to_date   = $_GET['txtto'];
	$pooja->id = $_GET['lstpooja'];

}else{
	$pooja->from_date =  date('d-m-Y',strtotime(CURRENT_DATE));
	$pooja->to_date   = date('d-m-Y',strtotime(CURRENT_DATE));
}

if(isset($_SESSION[SESSION_TITLE.'userid']) && isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] != ADMINISTRATOR ){
	$user_id = $_SESSION[SESSION_TITLE.'userid'];
}else{
	$user_id = -1;
}


list($pooja_list,$variable1) = $pooja->get_vazhipadu_pooja_list($pagination->start_record,$pagination->max_records,$user_id);


list($pooja_total_list,$variable2) = $pooja->get_all_vazhipadu_pooja_list($user_id);

if($pooja_list!=false){
	$pagination->total_records = $pooja->total_records;
	$pagination->paginate();
	$count_pooja=count($pooja_list);
}else{
	$count_pooja=0;
}







?>