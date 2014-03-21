<?php
if(!defined('CHECK_INCLUDED')){
	exit();
} 

$pooja= new Pooja($myconnection);
$pooja->connection=$myconnection;

$pagination = new Pagination(10);

if(isset($_POST['submit'])){
	if(trim($_POST['txtdate'])!=""){
		$pooja->vazhipadu_date = $_POST['txtdate'];
	}
}

$pooja_list = $pooja->get_vazhipadu_pooja_list($pagination->start_record,$pagination->max_records);

$pooja_total_list = $pooja->get_vazhipadu_pooja_list($pagination->start_record,$pooja->total_records);

if($pooja_list!=false){
	$pagination->total_records = $pooja->total_records;
	$pagination->paginate();
	$count_pooja=count($pooja_list);
}else{
	$count_pooja=0;
}







?>