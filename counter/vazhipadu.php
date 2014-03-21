<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "Counter- Vazhipadu";	// page Title
	$page->page_name = 'vazhipadu';		// page name for menu and other purpose
	$page->layout = 'default.html';			// layout name


    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");
	$page->function_list = array("functions.php");
	$page->class_list = array("class_vazhipadu.php","class_pooja.php","class_stars.php","class_voucher.php","class_account.php");
	$page->script_list = array("jquery.min.js");
	
	
	$page->access_list = array("ADMINISTRATOR","COUNTER");

    $index=0;
    $content_list[$index]['file_name']='counter/inc_menu.php';
    $content_list[$index]['var_name']='menu';
    $index++;


	$page->content_list = $content_list;

     $page->module_path = 'modules/vazhipadu/';
     $page->module = 'update';

	$page->display(); //completed page with dynamic cintent will be displayed
?>
