<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$menu_item = new MenuItem($myconnection);
$menu_item->connection = $myconnection;

$menu_item->total_records=$pagination->total_records;

$menu_list = $menu_item->get_list_array_bylimit();
if($menu_list){
	$pagination->total_records = $menu_item->total_records;
	$pagination->paginate();
	$count_menu=count($menu_list);
	}else{
	$count_menu=0;
}


if(isset($_POST['submit']))
{	
	
}
?>