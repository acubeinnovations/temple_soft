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

//save form variable;
if(isset($_POST['submit_variable'])){
	$form_type_id = $_POST['hd_typeid'];
	$errorMSG = "";
	if(trim($_POST['txtvariable']) == ""){
		$errorMSG .= "Enter variable name";
	}

	if($errorMSG == ""){
		$form_variable->description = $_POST['txtvariable'];
		if($form_variable->validate()){
			$update = $form_variable->update();
			if($update){
			    header( "Location:".$current_url);
			    exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] = "Form variable not added";
			    header( "Location:".$current_url);
			    exit();
			}
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Variable already exists";
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