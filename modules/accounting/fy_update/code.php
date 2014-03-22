<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$financial_year = new FinancialYear($myconnection);
$financial_year->connection = $myconnection;


//edit
if(isset($_GET['edt'])){
	$financial_year->id = $_GET['edt'];
	$financial_year->get_details();
	$submit_value = $CAP_update;
	
}else{
	
	$submit_value = $CAP_addnew;
}

//delete
if(isset($_GET['dlt'])){
	$financial_year->id = $_GET['dlt'];
	$financial_year->delete();
}

$financial_year->total_records=$pagination->total_records;

$financial_years = $financial_year->get_list_array_bylimit($pagination->start_record,$pagination->max_records);


if($financial_years <> false){
	$pagination->total_records = $financial_year->total_records;
	$pagination->paginate();
	$count_financial_years = count($financial_years);
}else{
	$count_financial_years = 0;
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
		$financial_year->fy_start	= $_POST['txtfystart'];
		$financial_year->fy_end		= $_POST['txtfyend'];
		$financial_year->fy_name    = $_POST['txtfyname'];
		$financial_year->status 	= $_POST['lststatus'];
		$financial_year->update();
		header("Location:".$current_url);
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errMSG;
	    header( "Location:".$current_url);
	    exit();
	}
}


?>