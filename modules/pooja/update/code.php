<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

//check current date with current financial year
$check =checkFinancialYear($_SESSION[SESSION_TITLE.'fy_status'],$_SESSION[SESSION_TITLE.'fy_start_date'],$_SESSION[SESSION_TITLE.'fy_end_date']);
if(!$check){
	$_SESSION[SESSION_TITLE.'flash'] = "Please check Financial Year";
    header( "Location:index.php");
    exit();
}
//checking financial year ends





$pooja=new Pooja($myconnection);
$pooja->connection=$myconnection;

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;
$ledger->ledger_id = LEDGER_DIRECT_INCOME;
$ledger_masters = $ledger->get_list_master_array();
$ledgers = $ledger->get_list_sub_array();



$fy_ledger_sub = new FyLedgerSub($myconnection);
$fy_ledger_sub->connection = $myconnection;

$account=new Account($myconnection);
$account->connection=$myconnection;

$transMSG = ""; //variable for check pooja name can edit or not

if(isset($_GET['id'])){

	$pooja->id=$_GET['id'];
	$pooja->get_details();
	$ledger->ledger_sub_id = $pooja->ledger_sub_id;
	$ledger->get_details();

	//---------------------------------------------------------------------------------------------------------

	/*if we edit a pooja check the following steps

	1.pooja ledger exists in ledger sub table
		a) if not skip the following
		b) if pooja ledger exists then go to step 2
	2.check account master table with this ledger ,any transaction exists
		a) if yes , u have no permission to edit pooja name and can edit amount
		b) if no, u can edit that pooja name and amount

	*/
	
	$pooja_ledger = $pooja->getPoojaLedger($_GET['id']);

	if($pooja_ledger){//check for accounts transaction exists

		if($account->transactionExists($pooja_ledger)){
			$transMSG = "This pooja transaction exists. You can not edit pooja name";	
		}	
		
	}
	//---------------------------------------------------------------------------------------------------------
}


if(isset($_POST['submit'])){

	if($pooja->validate($_POST)){

		$pooja->id=$_POST['h_id'];
		$pooja->name=$_POST['name'];
		
		$ledger->ledger_sub_id = $pooja->ledger_sub_id;
		$ledger->ledger_sub_name = $_POST['name'];
		$ledger->parent_sub_ledger_id = $_POST['lstledger'];
		$ledger_update = $ledger->update();

		if($ledger_update){
			//add ledger in fy_ledger_sub
			$fy_ledger_sub->ledger_sub_id = $ledger->ledger_sub_id;
			$fy_ledger_sub->update();

			//update pooja
			$pooja->name=$_POST['name'];
			$pooja->ledger_sub_id = $ledger->ledger_sub_id;
			$pooja->rate=$_POST['rate'];
			$pooja->status_id=$_POST['listpooja'];
			$pooja->update();
			$_SESSION[SESSION_TITLE.'flash'] = "Pooja added successfully";
			header("Location:poojas.php");
			
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Failed to update pooja";
	        header( "Location:".$current_url);
	        exit();
		}
		

	}else{//show validation error
		$_SESSION[SESSION_TITLE.'flash'] = $pooja->error_description;
        header( "Location:".$current_url);
        exit();
	}
	

}







?>