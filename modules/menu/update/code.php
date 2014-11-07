<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}


$pages = new Pages($myconnection);
$pages->connection = $myconnection;
$page_list = $pages->get_list_array();


$menu_list = $menu_item->get_list_array();

if(isset($_GET['id'])){
	$menu_item->id = $_GET['id'];
	$menu_item->get_details();
}


if(isset($_POST['submit']))
{	
	$errMSG = "";
	if(trim($_POST['txtname']) == ""){
		$errMSG .= "Menu Name is empty <br/>";
	}
	
	
	if(trim($errMSG) == ""){
		$menu_item->id = $_POST['h_id'];
		$menu_item->name = $_POST['txtname'];
		$menu_item->parent_id = $_POST['lstmenu'];
		if(isset($_POST['lstsort'])){
			$menu_item->sort_order = $_POST['lstsort'];
		}
		$menu_item->page_id = $_POST['lstpage'];
		$menu_item->status = $_POST['lststatus'];
		if($menu_item->validate()){
			$menu_item->update();
			$_SESSION[SESSION_TITLE.'flash'] = "Menu Item Updated";
	        header( "Location:".$current_url);
	        exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Menu Item already exists";
	        header( "Location:".$current_url);
	        exit();
		}	
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errMSG;
        header( "Location:".$current_url);
        exit();
	}
}
?>
