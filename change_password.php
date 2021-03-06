<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;

	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "Administrator - Change Password";	// page Title
	$page->page_name = 'change_password';		// page name for menu and other purpose
	$page->layout = 'default.html';		// layout name
	$page->default_access = false;



    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");

	$page->function_list = array("functions.php");
	$page->class_list = array("class_user.php");

	$page->access_list = array("ADMINISTRATOR");

	

    $index=0;
    $content_list[$index]['file_name']='inc_menu.php';
    $content_list[$index]['var_name']='menu';
    $index++;


	$page->content_list = $content_list;


    $page->module_path = 'modules/user/';
    $page->module = 'change_password';

	$page->display(); //completed page with dynamic cintent will be displayed
?>
