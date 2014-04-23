<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

if(isset($_SESSION[SESSION_TITLE.'current_fy_id'])){
	$current_fy_id = $_SESSION[SESSION_TITLE.'current_fy_id'];
}else{
	$current_fy_id = gINVALID;
}


$financial_year = new FinancialYear($myconnection);
$financial_year->connection = $myconnection;

$filter = "status = '".FINANCIAL_YEAR_OPEN."'";
$open_fy_count = $financial_year->getCount($filter);


$mybalancesheet = new BalanceSheet($myconnection);


$mystock_register = new StockRegister($myconnection);
$mystock_register->connection = $myconnection;



//edit
if(isset($_GET['edt'])){
	$financial_year->id = $_GET['edt'];
	$financial_year->get_details();
	$submit_value = $CAP_update;
	
}else{
	
	$submit_value = $CAP_addnew;
}





//submit action
if(isset($_POST['submit'])){

	$errMSG = "";
	if($_POST['hdfyid'] >0){

	}else{
		if(trim($_POST['txtfystart']) == ""){
			$errMSG .= "Invalid start Date<br>";
		}
		if(trim($_POST['txtfyend']) == ""){
			$errMSG .= "Enter financial year end<br>";
		}
	}
	if(trim($_POST['txtfyname']) == ""){
		$errMSG .= "Enter financial year Name<br>";
	}

	if($errMSG == ""){

		$financial_year->id	= $_POST['hdfyid'];

		$validate = $financial_year->validate($_POST['txtfystart'],$_POST['txtfyend']);
		

		if($validate){
			
			$financial_year->fy_start	= $_POST['txtfystart'];
			$financial_year->fy_end		= $_POST['txtfyend'];
			$financial_year->fy_name    = $_POST['txtfyname'];
			$financial_year->status 	= FINANCIAL_YEAR_OPEN;
			$financial_year->update();
			header("Location:".$current_url);
		}else{
			
			$_SESSION[SESSION_TITLE.'flash'] = $financial_year->error_description;
		    header( "Location:".$current_url);
		    exit();
		}
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errMSG;
	    header( "Location:".$current_url);
	    exit();
	}
}


?>
