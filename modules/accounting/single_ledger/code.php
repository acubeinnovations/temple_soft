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



if(isset($_POST['submit'])){


	if($_POST['lstledger'] > 0 ){
		$dataArray['ref_ledger'] = $_POST['lstledger'];
		$account->ref_ledger = $_POST['lstledger'];
		

	}
	
	
	if(isset($_POST['txtfromdate']) and trim($_POST['txtfromdate'])!=""){
		$dataArray['datefrom'] = $_POST['txtfromdate'];
		$datefrom = $_POST['txtfromdate'];
	}
	if(isset($_POST['txttodate']) and trim($_POST['txttodate'])!=""){
		$dataArray['dateto'] = $_POST['txttodate'];
		$dateto = $_POST['txttodate'];

	}else{
		$dataArray['dateto'] = $_POST['txtfromdate'];
		$dateto = $_POST['txtfromdate'];
	}

}

$account_list = $account->getAccountTransaction($pagination->start_record,$pagination->max_records,$dataArray);

if($account_list){
	$count_list = count($account_list);
	$pagination->total_records = $account->total_records;
	$pagination->paginate();
}


?>