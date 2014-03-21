<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);
$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$ledgers = $ledger->generateLedgerList();

$ledgers_list = $ledger->getLedgerTransaction();


$account = new Account($myconnection);
$account->connection = $myconnection;


$datefrom = "";
$dateto = "";
$ledger_name = "";

$account_list = $account->getAccountTransaction($pagination->start_record,$pagination->max_records);

if($account_list){
	$count_list = count($account_list);
	$pagination->total_records = $account->total_records;
	$pagination->paginate();
}
	
?>