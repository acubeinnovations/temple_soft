<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

//get date values
$data = array();
$data['from_date'] = $data['to_date'] = date('d-m-Y',strtotime(CURRENT_DATE));
if(isset($_GET['txtfrom'])){
	$data['from_date'] =  $_GET['txtfrom'];
}
if(isset($_GET['txtto'])){
	$data['to_date'] = $_GET['txtto'];
}

$dateArray = array();
$from = date('d-m-Y', strtotime($data['from_date']));
$to = date('d-m-Y', strtotime($data['to_date']));
do{
	$dateArray[] = $from;
	$from = date('d-m-Y', strtotime($from . " +1 days"));

	
}while(strtotime($from) <= strtotime($to));


//---------------------------------------------------------------


//build table header row
$user= new User($myconnection);
$user->connection = $myconnection;
$counter_users = $user->get_counter_users();
$th=array();
$counter_num = 0;
if($counter_users){
	$counter_num = count($counter_users);
	$th[] = array('name'=>'date','value'=>"Date");
	foreach($counter_users as $counter){
		$name = 'counter'.$counter['id'];
		$th[] = array('name'=>$name,'value'=>$counter['username']);
	}
	$th[] = array('name'=>'account','value'=>"Account");
}
//--------------------------------------------------------------



$vazhipadu= new Vazhipadu($myconnection);
$vazhipadu->connection = $myconnection;


list($table_data,$table_footer) = $vazhipadu->get_counter_wise_collection($dateArray);



//echo "<pre>";
//print_r($table_data);
//echo "</pre>";
//exit;




?>
