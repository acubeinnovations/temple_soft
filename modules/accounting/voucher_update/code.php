<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}



//check current date with current financial year
$check =checkFinancialYear($_SESSION[SESSION_TITLE.'fy_status'],$_SESSION[SESSION_TITLE.'fy_start_date'],$_SESSION[SESSION_TITLE.'fy_end_date']);
if(!$check){
	$_SESSION[SESSION_TITLE.'flash'] = "Please check Financial Year";
    header( "Location:index.php");
    exit();
}
//checking financial year ends

$form_type = new FormType($myconnection);
$form_type->connection = $myconnection;
$form_types = $form_type->get_list_array();


$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();


$voucher = new Voucher($myconnection);
$voucher->connection = $myconnection;

$module=new Module($myconnection);
$module->connection=$myconnection;
$modules = $module->get_list_array();

$menu_item = new MenuItem($myconnection);
$menu_item->connection = $myconnection;

$masterVouchers = $voucher->get_list_master_array();

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;
$ledgers = $ledger->get_list_sub_array();
if(!$ledgers){
	$_SESSION[SESSION_TITLE.'flash'] = "No active ledgers";
    header( "Location:dashboard.php");
    exit();
}

	


//form submission
if(isset($_POST['submit'])){
	$errorMSG = "";
//validation
	if(trim($_POST['txtname']) == ""){
		$errorMSG .= "Enter Voucher name \n";
	}
	if($_POST['lstmvoucher'] == "" or $_POST['lstmvoucher'] <=0){
		$errorMSG .= "Select Voucher type \n";
	}
	if(trim($_POST['txtseries']) == ""){
		$errorMSG .= "Enter Number Series\n";
	}

	
	

	if(trim($errorMSG) != ""){
		
        $_SESSION[SESSION_TITLE.'flash'] = "Please fill all required fields";
        header( "Location:".$current_url);
        exit();

	}else{

		$voucher->voucher_name = $_POST['txtname'];
		$voucher->voucher_master_id = $_POST['lstmvoucher'];
		$voucher->voucher_description = $_POST['txtdescription'];
		$voucher->fy_id = $account_settings->current_fy_id;

		$voucher->number_series .= (trim($_POST['txtprefix'])!="")?$_POST['txtprefix']:"";
		$voucher->number_series .= (trim($_POST['lstseperator'])!="")?$_POST['lstseperator']:"";
		$voucher->number_series .= $_POST['txtseries'];
		$voucher->number_series .= (trim($_POST['lstseperator'])!="")?$_POST['lstseperator']:"";
		$voucher->number_series .= (trim($_POST['txtsufix'])!="")?$_POST['txtsufix']:"";
		
		$voucher->series_prefix = $_POST['txtprefix'];
		$voucher->series_sufix = $_POST['txtsufix'];
		$voucher->series_start	= $_POST['txtseries'];
		$voucher->series_seperator = $_POST['lstseperator'];

		$voucher->header = $_POST['txtheader'];
		$voucher->footer = $_POST['txtfooter'];
		$voucher->source = $_POST['lstsource'];

		if(isset($_POST['chk_hidden'])){
			$voucher->hidden = VOUCHER_HIDDEN;	
			$voucher->module_id = $_POST['lstmodules'];
			$voucher->default_from = $_POST['lstfromledger'];
			$voucher->default_to = $_POST['lsttoledger'];
		}else{
			//voucher account details
			if($_POST['lstsource'] == VOUCHER_FOR_ACCOUNT){//voucher for account
				if($_POST['lstaccount'] == FROM){//from account
					$voucher->default_from = $_POST['lstledger'];
				}elseif($_POST['lstaccount'] == TO){//to account
					$voucher->default_to = $_POST['lstledger'];
				}

			}elseif($_POST['lstsource'] == VOUCHER_FOR_INVENTORY){//voucher for inventory
				$voucher->default_from = ($_POST['lstfromledger'] > 0)?$_POST['lstfromledger']:'';
				$voucher->default_to = ($_POST['lsttoledger'])?$_POST['lsttoledger']:'';
				$voucher->form_type_id	= $_POST['lstformtype'];
			}
		}

		$update = $voucher->update();
		if($update){
			$voucher_id = $update;
			//1. get voucher name
			$voucher->voucher_id = $voucher_id;
			$voucher->get_details();
			if($voucher->module_id > 0){
				//do nothing
			}else{
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
				$my_page->name = "ac_generate_voucher";
				$my_page->route = "";
				$my_page->params = "v=".$voucher_id;
				if($my_page->getPageId()){//update voucher
					$page_id = $my_page->id;
					$menu_item->page_id = $page_id;
					$menu_item->name = $voucher->voucher_name;
					$menu_item->update_with_page_id();

				}else{//new voucher
					$page_id = $my_page->update();

					//give access to user
					if($page_id){
						//page access for all user type
						$user_type_page = new UserTypePage($myconnection);
						$user_type_page->connection = $myconnection;
						$user_type_page->page_id = $page_id;
						$user_types = array(ADMINISTRATOR,COUNTER,FINANCE);
						$user_type_page->insert_batch_with_user_types($user_types);
						
						if(isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'user_type'] != ADMINISTRATOR){
							$user_page = new UserPage($myconnection);
							$user_page->connection = $myconnection;
							$user_page->user_id =$_SESSION[SESSION_TITLE.'userid'];
							$user_page->page_id = $page_id;
							$user_page->update();
						}
					}
					$user_session  = new UserSession($myconnection);
					$user_session->connection = $myconnection;
					$user_session->updatePageSession();

					//4.create new menu
					$menu_item->name = $voucher->voucher_name;
					$menu_item->parent_id = $menu_parent;
					$menu_item->page_id = $page_id;
					$menu_item->status = STATUS_ACTIVE;
					$menu_item->update();
				}
			}
			

			$_SESSION[SESSION_TITLE.'flash'] = "Voucher update successfully!";
	        header( "Location:".$current_url);
	        exit();
    	}else{
    		$_SESSION[SESSION_TITLE.'flash'] = "Voucher not udated";
	        header( "Location:".$current_url);
	        exit();
    	}
	}

	
}



?>