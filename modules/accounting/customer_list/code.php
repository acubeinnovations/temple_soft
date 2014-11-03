<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$customer=new Customer($myconnection);
$customer->connection=$myconnection;

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$customers = $customer->get_list_array_bylimit($pagination->start_record,$pagination->max_records);

if($customers <> false){
	$pagination->total_records = $customer->total_records;
	$pagination->paginate();
	$count_customers = count($customers);
}else{
	$count_customers = 0;
}


//delete
if(isset($_GET['dlt'])){
	$customer->customer_id = $_GET['dlt'];
	$delete = $customer->delete();
	if($delete){
		$_SESSION[SESSION_TITLE.'flash'] = "Customer deleted";
        header( "Location:".$current_url);
        exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $customer->error_description;
        header( "Location:".$current_url);
        exit();
	}
}




?>