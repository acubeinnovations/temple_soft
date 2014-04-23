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

if(isset($_GET['id'])){
	$pooja->id=$_GET['id'];
	$pooja->get_details();
	$ledger->ledger_sub_id = $pooja->ledger_sub_id;
	$ledger->get_details();
}


if(isset($_POST['submit'])){
	//validation 
	$errorMSG = "";
	if(trim($_POST['name']) == ""){
		$errorMSG .= "Pooja name required ";
	}
	if(trim($_POST['rate']) == ""){
		$errorMSG .= "Pooja rate required";
	}elseif(!filter_var($_POST['rate'], FILTER_VALIDATE_FLOAT)){
		$errorMSG .= "Invalid rate";
	}

	if($_POST['lstledger'] == '' || $_POST['lstledger'] == gINVALID){
		$errorMSG = "Ledger Not selected";
	}

	if($errorMSG == ""){
		$pooja->id=$_POST['h_id'];
		$pooja->name=$_POST['name'];
		if($pooja->validate()){
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
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $pooja->error_description;
	        header( "Location:".$current_url);
	        exit();
		}
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url);
        exit();
	}
	

}







?>