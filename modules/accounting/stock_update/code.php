<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$stock=new Stock($myconnection);
$stock->connection=$myconnection;

$stock_register = new StockRegister($myconnection);
$stock_register->connection=$myconnection;

$fy_year = new FinancialYear($myconnection);
$fy_year->connection = $myconnection;
$fy_year->id = $stock_register->current_fy_id;
$fy_year->get_details();

$stock->total_records=$pagination->total_records;

$items = $stock->get_list_array_bylimit($pagination->start_record,$pagination->max_records);
if($items <> false){
	$pagination->total_records = $stock->total_records;
	$pagination->paginate();
	$count_items = count($items);
}else{
	$count_items = 0;
}

//edit
if(isset($_GET['edt'])){
	$stock->item_id = $_GET['edt'];
	$stock->get_details();
	
}
if(isset($_GET['dlt'])){
	$stock->item_id = $_GET['dlt'];
	$delete = $stock->delete();
	if($delete){
		$_SESSION[SESSION_TITLE.'flash'] = "Item deleted";
        header( "Location:".$current_url);
        exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $stock->error_description;
        header( "Location:".$current_url);
        exit();
	}
}


$uom=new Uom($myconnection);
$uom->connection=$myconnection;

$uom_list = $uom->get_list_array();

if(isset($_POST['submit'])){

	$errorMSG = "";
	if(trim($_POST['txtname']) == ""){
		$errorMSG = "Item name is empty \n";
	}

	if($_POST['lstuom'] <= 0){
		$errorMSG = "Select unit of measure\n";
	}

	if(trim($errorMSG) == ""){
		$stock->item_id = $_POST['hd_itemid'];
		$stock->item_name = $_POST['txtname'];
		$stock->uom_id = $_POST['lstuom'];

		if($stock->item_id > 0){
			$check = true;
		}else{
			$check = $stock->validate();
		}

		if($check){
			$update = $stock->update();
			if($update){
				if($_POST['txtqty'] > 0){
					$stock->get_details();
					$stock_register->item_id = $stock->item_id;
					$stock_register->quantity = $_POST['txtqty'];
					$stock_register->input_type = INPUT_PURCHASE;
					$stock_register->date = $fy_year->fy_start;
					$stock_register->update();
				}

				$_SESSION[SESSION_TITLE.'flash'] = "Item udated successfully";
		        header( "Location:".$current_url);
		        exit();
		    }else{
		    	$_SESSION[SESSION_TITLE.'flash'] = "Failed to add item";
		        header( "Location:".$current_url);
		        exit();
		    }
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $stock->error_description;
	        header( "Location:".$current_url);
	        exit();
		}
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = "Please fill the required fields";
        header( "Location:".$current_url);
        exit();
	}
}

?>