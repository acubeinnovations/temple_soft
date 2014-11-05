<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$vazhipadu= new Vazhipadu($myconnection);
$vazhipadu->connection = $myconnection;

$user= new User($myconnection);
$user->connection = $myconnection;
$counter_users = $user->get_counter_users();

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

//build column data with amount 0
do{

	foreach($counter_users as $counter){
		$dateArray[$from][$counter['id']]['amount']= 0;
		$dateArray[$from][$counter['id']]['title']= $counter['username'];
	}
	
	
	$from = date('d-m-Y', strtotime($from . " +1 days"));

	
}while(strtotime($from) <= strtotime($to));

//---------------------------------------------------------------


//get table record for search
$table_data = $vazhipadu->get_counter_wise_collection($data);

//-----------------------------------------------------------------


//build table header row

$theader=array();
$tbody=array();
$tfooter=array();
/*$counter_num = 0;
if($counter_users){
	$counter_num = count($counter_users);
	$th[] = array('name'=>'date','value'=>"Date");
	foreach($counter_users as $counter){
		$name = 'counter'.$counter['id'];
		$th[] = array('name'=>$name,'value'=>$counter['username']);
	}
	$th[] = array('name'=>'account','value'=>"Account");
}*/
//--------------------------------------------------------------

foreach($table_data as $row){

	$dt = date('d-m-Y', strtotime($row['date']));
	$dateArray[$dt][$row['user_id']]['amount']= $row['amount'];

	
}


//build theader ,tbody and tfooter
$i=0;//table column counter

$row_count = count($dateArray);
$column_total = array();

foreach($dateArray as $date=>$tdata){

	$row_total = 0;
	$col = 0;

	if($i == 0){
		$theader[$col] = "Date";
		$tfooter[$col] = "Total";
	}
	$col++;

	$tbody[$i][]= $date;
	foreach($tdata as $counter_row){
		$tbody[$i][]= number_format($counter_row['amount'],2);
		if($i == 0)
			$theader[$col] = $counter_row['title'];
			
		
		$row_total += $counter_row['amount'];

		if(isset($tfooter[$col])){
			$tfooter[$col] = number_format($tfooter[$col] + $counter_row['amount'],2);
		}
		else{
			$tfooter[$col] = number_format($counter_row['amount'],2);
		}
	
		$col++;

	}
	
	$tbody[$i][]= number_format($row_total,2);

	if($i == 0)
		$theader[$col] = "Account";

	if(isset($tfooter[$col])){
		$tfooter[$col] = number_format($tfooter[$col] + $row_total,2);
	}
	else{
		$tfooter[$col] = number_format($row_total,2);
	}
	$col++;
			
	
	$i++;	
}




//echo "<pre>";
//print_r($dateArray);
//echo "</pre>";
//exit;




?>
