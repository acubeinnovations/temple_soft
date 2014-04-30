<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$user = new User($myconnection);
$user->connection = $myconnection;
$users = $user->get_list_array_filter("user_type_id <> '".ADMINISTRATOR."'");

$user_page = new UserPage($myconnection);
$user_page->connection = $myconnection;

$user_pages_list = array();$i=0;
if(isset($_GET['uid'])){
	$user_page->user_id = $_GET['uid'];
	$user_pages = $user_page->get_user_pages();	
	foreach($user_pages as $key=>$value){
		$user_pages_list[$i]['id'] = $key;
		$user_pages_list[$i]['name'] = $value;
		$i++;
	}
}


$my_page = new Pages($myconnection);
$my_page->connection = $myconnection;
$pages = $my_page->get_list_array();
/*
echo "<pre>";
print_r($user_pages);
echo "</pre>";exit();
*/


if(isset($_POST['submit']))
{	
	$errMSG = "";
	if($_POST['lstuser'] =='' || $_POST['lstuser'] == gINVALID){
		$errMSG .= "User Not Selected<br/>";
	}
	if(!isset($_POST['lstuserpages'])){
		$errMSG .= "Pages not selected <br/>";
	}
	//print_r($_POST);exit();
	
	if($errMSG == ""){
		$user_page->user_id = $_POST['lstuser'];
		$delete = true;
		if($user_page->check()){
			$delete = $user_page->delete();
		}
		if($delete){
			$user_page->insert_batch($_POST['lstuserpages']);
		}
		
			
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errMSG;
        header( "Location:".$current_url);
        exit();
	}

}

//jquery post 
if(isset($_GET['ajax_user_id'])){
	$user_page->user_id = $_GET['ajax_user_id'];
	$user_pages = $user_page->get_user_pages();
	$json=array();
	if($user_pages){
		$json['pages'] = $user_pages; 
	}
	echo json_encode($json);exit();
	
}

?>