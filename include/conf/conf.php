<?php
header('Content-type: text/html; charset=utf-8');

//timezone
date_default_timezone_set('Asia/Kolkata');
define("CURRENT_DATETIME",date('Y-m-d H:i:s'));
define("CURRENT_DATE",date('Y-m-d'));
define("CURRENT_TIME",date('H:i:s'));


//User Types
define("ADMINISTRATOR", 999);

define("REGISTERED_USER", 1);

//User Status
define("USERSTATUS_ACTIVE", 1);
define("USERSTATUS_WAITING_EMAIL_ACTIVATION", 2);
define("USERSTATUS_SUSPENDED", 3);
define("USERSTATUS_DISABLED", 4);


// Status
define("STATUS_ACTIVE", 1);
define("STATUS_INACTIVE", 2);

$g_ARRAY_LIST_STATUS = array();
$g_ARRAY_LIST_STATUS[0]["id"] = 1;
$g_ARRAY_LIST_STATUS[0]["name"] = "Active";
$g_ARRAY_LIST_STATUS[1]["id"] = 2;
$g_ARRAY_LIST_STATUS[1]["name"] = "Inactive";



$g_ARRAY_STATUS = array();
$g_ARRAY_STATUS[1] = "Active";
$g_ARRAY_STATUS[2] = "Inactive";


$g_ARRAY_record_per_page = array();
$g_ARRAY_record_per_page[0]["no_of_records"] = "10";
$g_ARRAY_record_per_page[1]["no_of_records"] = "20";
$g_ARRAY_record_per_page[2]["no_of_records"] = "50";
$g_ARRAY_record_per_page[3]["no_of_records"] = "100";



//timer arrays
$g_ARRAY_hours 		= array();
$g_ARRAY_minutes	= array();
$g_ARRAY_seconds	= array();
for($i=0; $i <= 5; $i++){
	$g_ARRAY_hours[$i]['hour'] = sprintf("%02s", $i);
}
for($i=0; $i < 60; $i++){
	$g_ARRAY_minutes[$i]['minute'] = sprintf("%02s", $i);
	$g_ARRAY_seconds[$i]['second'] = sprintf("%02s", $i);
}


GLOBAL $g_msg_unauthorized_request;
$g_msg_unauthorized_request = "<strong>Unauthorized Page Request</strong><br/> <br/> You are not authorized to access this page. This attempt will be reported to the system Administrator. ";

GLOBAL $g_msg_unauthorized_request_redirect_page;
$g_msg_unauthorized_request_redirect_page = "index.php";

GLOBAL $g_obj_select_default_text;
$g_obj_select_default_text = "Choose from list..";


//Email
define("EMAIL_FEEDBACK", "feedback@temple_soft.local");
define("EMAIL_NO_REPLY", "noreply@temple_soft.local");
define("EMAIL_INFO", "noreply@temple_soft.local");
define("EMAIL_SUPPORT", "noreply@temple_soft.local");


define("WEB_URL", "http://temple_soft.local");
define("ADMIN_URL", "http://temple_soft.local/admin");
define("WEB_NAME", "temple_soft.local");
define("ORG_NAME", "temple_soft");




//credit types
define("CREDIT_TYPE_PAYMENT", '1');
define("CREDIT_TYPE_TEST", '2');
define("CREDIT_TYPE_OFFER", '3');
define("CREDIT_TYPE_REPORT", '4');
define("CREDIT_TYPE_ORGANIZATION_CREDIT", '5');
define("CREDIT_TYPE_VOUCHER", '6');

//payment online
define("PAYMENT_ONLINE",'1');
define("PAYMENT_OFFLINE", '0');

//payment type
define("PAYMENT_TYPE_IIPAY", '1');
define("PAYMENT_TYPE_CCAVENUE", '2');
define("PAYMENT_TYPE_CHEQUE", '3');
define("PAYMENT_TYPE_CASH", '4');

// question Status
define("QUESTION_STATUS_ACTIVE", 1);
define("QUESTION_STATUS_INACTIVE", 2);

// question Types
define("QUESTION_TYPE_SINGLE_ANSWER", 1);
define("QUESTION_TYPE_MULTIPLE_ANSWERS", 2);



//import default delimiter
define("DEFAULT_IMPORT_DELIMITER", ',');
define("DEFAULT_OPTION_DELIMITER", '#!@$&');
define("DEFAULT_ANSWER_KEY_DELIMITER", ',');
define("DEFAULT_IDS_DELIMITER", ',');

?>
