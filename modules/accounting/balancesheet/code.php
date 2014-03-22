<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$mybalancesheet = new BalanceSheet();
$mybalancesheet->connection = $myconnection;
$mybalancesheet->fy_id = 1;

$sheet = $mybalancesheet->get();

echo "<pre>";
print_r($sheet);
echo "</pre>";
?>
