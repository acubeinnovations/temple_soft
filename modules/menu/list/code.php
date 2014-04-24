<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$menu_item = new MenuItem($myconnection);
$menu_item->connection = $myconnection;

$menu_item->total_records=$pagination->total_records;

$menu_list = $menu_item->get_list_array_bylimit();
/*
echo "<pre>";
print_r($menu_list);
echo "</pre>";exit();
*/
if($menu_list){
	$pagination->total_records = $menu_item->total_records;
	$pagination->paginate();
	$count_menu=count($menu_list);
	}else{
	$count_menu=0;
}

if(isset($_GET['dlt'])){
	$menu_item->id = $_GET['dlt'];
	$delete = $menu_item->delete();
	if($delete){
		$_SESSION[SESSION_TITLE.'flash'] = "Menu Item deleted";
        header( "Location:".$current_url);
        exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $menu_item->error_description;
        header( "Location:".$current_url);
        exit();
	}
}


?>