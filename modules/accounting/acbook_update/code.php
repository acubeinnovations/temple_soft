<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$menu_item = new MenuItem($myconnection);
$menu_item->connection = $myconnection;

//check current date with current financial year
$check =checkFinancialYear($_SESSION[SESSION_TITLE.'fy_status'],$_SESSION[SESSION_TITLE.'fy_start_date'],$_SESSION[SESSION_TITLE.'fy_end_date']);
if(!$check){
	$_SESSION[SESSION_TITLE.'flash'] = "Please check Financial Year";
    header( "Location:index.php");
    exit();
}
//checking financial year ends

$pagination = new Pagination(10);

$acbook=new AcBook($myconnection);
$acbook->connection=$myconnection;

$acbook->total_records=$pagination->total_records;

$books = $acbook->get_list_array_bylimit($pagination->start_record,$pagination->max_records);

$acbook_ledgers = array();

if($books <> false){
	$pagination->total_records = $acbook->total_records;
	$pagination->paginate();
	$count_books = count($books);
}else{
	$count_books = 0;
}


//edit
if(isset($_GET['edt'])){
	$acbook->id = $_GET['edt'];
	$acbook->get_details();

	$acbook_ledgers = unserialize($acbook->ledgers);
	
}

if(isset($_GET['dlt'])){
	$acbook->id = $_GET['dlt'];
	$delete = $acbook->delete();
	if($delete){
		$_SESSION[SESSION_TITLE.'flash'] = "Book deleted";
        header( "Location:".$current_url);
        exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $acbook->error_description;
        header( "Location:".$current_url);
        exit();
	}
}


$ledger=new Ledger($myconnection);
$ledger->connection=$myconnection;

$ledgers = $ledger->get_list_array();
if(!$ledgers){
	$_SESSION[SESSION_TITLE.'flash'] = "No active ledgers";
    header( "Location:dashboard.php");
    exit();
}


if(isset($_POST['submit'])){

	

	$errorMSG = "";
	if(trim($_POST['txtname']) == ""){
		$errorMSG = "Book name is empty \n";
	}

	if(!isset($_POST['lstledger'])){
		echo $errorMSG = "Select Ledgers\n";
	}

	if(trim($errorMSG) == ""){
		$acbook->id = $_POST['hd_acbookid'];
		$acbook->name = $_POST['txtname'];
		$acbook->ledgers = $_POST['lstledger'];
//print_r($acbook->ledgers);exit();
		if($acbook->id > 0){
			$check = true;
		}else{
			$check = $acbook->validate();
		}

		if($check){

			$update = $acbook->update();

			if($update){

				$b_id = $update;
				//1. get book name
				$acbook->id = $b_id;
				$acbook->get_details();

				//2.get current menu's parent id
				$menu_parent = -1;
				if(isset($_SESSION[SESSION_TITLE.'pages'])){
					$page_id = array_search($this->page_name, $_SESSION[SESSION_TITLE.'pages']);
					if($page_id){
						$current_menu = $menu_item->get_filtered_row(array('page_id'=>$page_id));
						$menu_parent = $current_menu['parent_id'];
					}
				}
				//3.create new page with this voucher / get page id
				$my_page = new Pages($myconnection);
				$my_page->connection = $myconnection;
				$my_page->name = "ac_generated_vouchers";
				$my_page->route = "";
				$my_page->params = "bid=".$b_id;
				if($my_page->getPageId()){//update book
					$page_id = $my_page->id;
					$menu_item->page_id = $page_id;
					$menu_item->name = $acbook->name;
					$menu_item->update_with_page_id();

				}else{//new ac book
					$page_id = $my_page->update();
					if($page_id){
						//page access for administrator and finance
						$user_type_page = new UserTypePage($myconnection);
						$user_type_page->connection = $myconnection;
						$user_type_page->page_id = $page_id;
						$user_types = array(ADMINISTRATOR,FINANCE);
						$user_type_page->insert_batch_with_user_types($user_types);
						if(isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'user_type'] != ADMINISTRATOR){
								$user_page = new UserPage($myconnection);
								$user_page->connection = $myconnection;
								$user_page->user_id =$_SESSION[SESSION_TITLE.'userid'];
								$user_page->page_id = $page_id;
								$user_page->update();
						}
					}
					//update menu
					$user_session  = new UserSession($myconnection);
					$user_session->connection = $myconnection;
					$user_session->updatePageSession();

					//4.create new menu
					$menu_item->name = $acbook->name;
					$menu_item->parent_id = $menu_parent;
					$menu_item->page_id = $page_id;
					$menu_item->status = STATUS_ACTIVE;
					$menu_item->update();
				}

				$_SESSION[SESSION_TITLE.'flash'] = "Book udated successfully";
		        header( "Location:".$current_url);
		        exit();
		    }else{
		    	$_SESSION[SESSION_TITLE.'flash'] = "Failed to add Book";
		        header( "Location:".$current_url);
		        exit();
		    }
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $acbook->error_description;
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