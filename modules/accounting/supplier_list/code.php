<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$supplier=new Supplier($myconnection);
$supplier->connection=$myconnection;

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$suppliers = $supplier->get_list_array_bylimit($pagination->start_record,$pagination->max_records);

if($suppliers <> false){
	$pagination->total_records = $supplier->total_records;
	$pagination->paginate();
	$count_suppliers = count($suppliers);
}else{
	$count_suppliers = 0;
}


//delete
if(isset($_GET['dlt'])){
	$supplier->supplier_id = $_GET['dlt'];
	$delete = $supplier->delete();
	if($delete){
		$_SESSION[SESSION_TITLE.'flash'] = "supplier deleted";
        header( "Location:".$current_url);
        exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $supplier->error_description;
        header( "Location:".$current_url);
        exit();
	}
}





?>