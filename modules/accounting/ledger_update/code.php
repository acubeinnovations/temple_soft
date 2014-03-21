<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}



$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$ledgers = $ledger->generateLedgerList();


$ledger_masters = $ledger->get_list_master_array();

if(isset($_POST['submit'])){
	
	if(trim($_POST['txtledger'])!="" && $_POST['lstmledger'] >0)
	{
		$ledger->ledger_sub_name	= $_POST['txtledger'];
		$ledger->ledger_id	= $_POST['lstmledger'];
		if(isset($_POST['lstsledger'])){
			$ledger->parent_sub_ledger_id		= $_POST['lstsledger'];
		}
		$ledger->fy_id =1;
		
		$ledger->update();
	}else{
		//do nothing
	}

	header("Location:".$current_url);
}


if(isset($_GET['master'])){
	
	$ledger->ledger_id = $_GET['master'];
	$json = $ledger->get_list_sub_array_with_masterid();
	if($json){
		echo json_encode($json);exit();
	}
	//print_r($sub_ledgers);exit();
	

}





?>