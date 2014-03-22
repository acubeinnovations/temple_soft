<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$vazhipadu=new Vazhipadu($myconnection);
$vazhipadu->connection=$myconnection;

$vazhipadu->total_records=$pagination->total_records;

$data = array();


if(isset($_POST['submit'])){
	
	$data['from_date'] =  $_POST['txtfrom'];
	$data['to_date']   = $_POST['txtto'];

}else{
	$data['from_date'] =  date('d-m-Y',strtotime(CURRENT_DATE));
	$data['to_date']   = date('d-m-Y',strtotime(CURRENT_DATE));
}

if($vazhipadu->from_date == ""){
	$from_date = date('d-m-Y',strtotime(CURRENT_DATE));
}else{
	$from_date = date('d-m-Y',strtotime($vazhipadu->from_date));
}

if($vazhipadu->to_date == ""){
	$to_date = date('d-m-Y',strtotime(CURRENT_DATE));
}else{
	$to_date = date('d-m-Y',strtotime($vazhipadu->to_date));
}




//$vazhipadu_list = $vazhipadu->get_filter_array_by_limit($data,$pagination->start_record,$pagination->max_records);
$vazhipadu_list = $vazhipadu->get_array_by_limit($pagination->start_record,$pagination->max_records,$data);
$vazhipadu_total_list = $vazhipadu->get_array_by_limit($pagination->start_record,$vazhipadu->total_records,$data);


//print_r($vazhipadu_list);exit();

if($vazhipadu_list){
	$pagination->total_records = $vazhipadu->total_records;
	$pagination->paginate();
	$count = count($vazhipadu_list);
}else{
	$count = 0;
}


?>