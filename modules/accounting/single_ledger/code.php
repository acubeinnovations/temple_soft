<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);
$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$account = new Account($myconnection);
$account->connection = $myconnection;

$ledgers = $ledger->get_list_array();

$datefrom = "";
$dateto = "";
$ledger_name = "";

$dataArray = array();



if(isset($_GET['submit'])){

	if($_GET['lstledger'] > 0 ){
		$dataArray['ref_ledger'] = $_GET['lstledger'];
		$account->ref_ledger = $_GET['lstledger'];	

	}
	
	
	if(isset($_GET['txtfromdate']) and trim($_GET['txtfromdate'])!=""){
		$dataArray['datefrom'] = $_GET['txtfromdate'];
		$datefrom = $_GET['txtfromdate'];
	}
	if(isset($_GET['txttodate']) and trim($_GET['txttodate'])!=""){
		$dataArray['dateto'] = $_GET['txttodate'];
		$dateto = $_GET['txttodate'];

	}else{
		$dataArray['dateto'] = $_GET['txtfromdate'];
		$dateto = $_GET['txtfromdate'];
	}

	$account_list = $account->getAccountTransaction($pagination->start_record,$pagination->max_records,$dataArray);

if($account_list){
	$count_list = count($account_list);
	$pagination->total_records = $account->total_records;
	$pagination->paginate();
}

	

}






?>