<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
//check current date with current financial year
$check =checkFinancialYear($_SESSION[SESSION_TITLE.'fy_status'],$_SESSION[SESSION_TITLE.'fy_start_date'],

$_SESSION[SESSION_TITLE.'fy_end_date']);
if(!$check){
	$_SESSION[SESSION_TITLE.'flash'] = "Please check Financial Year";
    header( "Location:index.php");
    exit();
}
//checking financial year ends

$form_type = new FormType($myconnection);
$form_type->connection = $myconnection;

$form_variable = new FormVariable($myconnection);
$form_variable->connection = $myconnection;

$form_variables = $form_variable->get_list_array();


if(isset($_GET['slno'])){
	$form_type->id = $_GET['slno'];
	$form_type->get_details();
}




if(isset($_POST['submit'])){
	$errorMSG = "";
	if(trim($_POST['txtname']) == ""){
		$errorMSG = "Enter form name";
	}

	if($errorMSG != ""){
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
	    header( "Location:".$current_url);
	    exit();
	}else{
		$form_type->value = $_POST['txtname'];
		$form_type->form_variables = $_POST['lstvariable'];

		$update = $form_type->update();
		if($update){
			$_SESSION[SESSION_TITLE.'flash'] = "Form Type added";
		    header( "Location:".$current_url);
		    exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Error found";
		    header( "Location:".$current_url);
		    exit();
		}
	}
}






?>