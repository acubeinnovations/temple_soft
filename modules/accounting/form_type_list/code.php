<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$form_type = new FormType($myconnection);
$form_type->connection = $myconnection;

$form_variable = new FormVariable($myconnection);
$form_variable->connection = $myconnection;

$form_variables = $form_variable->get_list_array();


$form_types = $form_type->get_list_array_bylimit($pagination->start_record,$pagination->max_records);
if($form_types <> false){
	$pagination->total_records = $form_type->total_records;
	$pagination->paginate();
	$count = count($form_types);
}else{
	$count = 0;
}




?>