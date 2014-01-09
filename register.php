<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "My Daily Test";	// page Title
	$page->page_name = 'sign_up';		// page name for menu and other purpose
	$page->layout = 'null.html';		// layout name

    
    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");
	$page->function_list = array("functions.php", "functions_forum.php");
	$page->class_list = array("class_credit_plan.php", "class_payment_type.php","class_user.php","class_user_session.php","class_user_notifications.php","class_user_credit.php", "class_payment.php","class_exam.php","class_voucher.php");


    $index=0;

    $content_list[$index]['file_name']='inc_top_menu.php';
    $content_list[$index]['var_name']='top_menu';
	$index++;

    $content_list[$index]['file_name']='inc_menu.php';
    $content_list[$index]['var_name']='menu';
	$index++;
	

	$content_list[$index]['file_name']='inc_footer.php';
	$content_list[$index]['var_name']='footer';
    $index++;

	$page->content_list = $content_list;


    $page->module_path = 'modules/user/'; 
    $page->module = 'register';

	$page->display(); //completed page with dynamic cintent will be displayed
?>
