<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$user = new User($myconnection);
$user->connection = $myconnection;
$users = $user->get_list_array_filter("user_type_id <> '".ADMINISTRATOR."'");

$user_menu = new UserMenu($myconnection);
$user_menu->connection = $myconnection;
if(isset($_SESSION[SESSION_TITLE.'userid'])){
	$user_menu->user_id = $_SESSION[SESSION_TITLE.'userid'];
}

$menu_item = new MenuItem($myconnection);
$menu_item->connection = $myconnection;
$menu_list = $menu_item->getMenuTreeArray();
/*
echo "<pre>";
print_r($menu_list);
echo "</pre>";exit();
*/


if(isset($_POST['submit']))
{	
	$user_menu->user_id = $_POST['lstuser'];
	$user_menu->insert_batch($_POST['chk_menu']);

	/*
	$errMSG = "";
	

	if($errMSG == ""){
			
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url);
        exit();
	}
	*/
}
?>