<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$vazhipadu=new Vazhipadu($myconnection);
$vazhipadu->connection=$myconnection;

$vazhipadu->total_records=$pagination->total_records;

$data = array();

if(isset($_GET['submit'])){
	$vazhipadu->vazhipadu_date =  $_GET['txtdate'];
}else{
	$vazhipadu->vazhipadu_date =  date('d-m-Y',strtotime(CURRENT_DATE));
}


$vazhipadu_list = $vazhipadu->get_filter_array_by_limit($pagination->start_record,$pagination->max_records,$data);

if($vazhipadu_list){
	$pagination->total_records = $vazhipadu->total_records;
	$pagination->paginate();
	$count = count($vazhipadu_list);
}else{
	$count = 0;
}


?>