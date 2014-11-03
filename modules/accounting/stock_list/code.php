<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$stock=new Stock($myconnection);
$stock->connection=$myconnection;

$stock_register = new StockRegister($myconnection);
$stock_register->connection=$myconnection;

$fy_year = new FinancialYear($myconnection);
$fy_year->connection = $myconnection;
$fy_year->id = $stock_register->current_fy_id;
$fy_year->get_details();

$stock->total_records=$pagination->total_records;

$items = $stock->get_list_array_bylimit($pagination->start_record,$pagination->max_records);
if($items <> false){
	$pagination->total_records = $stock->total_records;
	$pagination->paginate();
	$count_items = count($items);
}else{
	$count_items = 0;
}
$opening_qty = 0;
$opening_rate = false;
$stk_id = -1;


if(isset($_GET['dlt'])){
	$stock->item_id = $_GET['dlt'];
	$delete = $stock->delete();
	if($delete){
		$_SESSION[SESSION_TITLE.'flash'] = "Item deleted";
        header( "Location:".$current_url);
        exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $stock->error_description;
        header( "Location:".$current_url);
        exit();
	}
}




?>