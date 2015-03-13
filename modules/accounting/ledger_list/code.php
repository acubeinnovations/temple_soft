<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$pagination = new Pagination(10);
$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

//$ledgers = $ledger->generateLedgerList();

//$ledgers_list = $ledger->getLedgerTransaction();

$trans = new LedgerTrans($myconnection);
$trans->connection = $myconnection;

$ledgers_list = $trans->getLedgerTransaction();

echo "<pre>";print_r($ledgers_list);echo "</pre>";exit;


	
?>
