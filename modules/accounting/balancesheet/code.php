<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$mybalancesheet = new BalanceSheet();
$mybalancesheet->connection = $myconnection;
$mybalancesheet->fy_id = 1;

$sheet = $mybalancesheet->get();
$sheet_closing = $mybalancesheet->get_closing();

echo "<pre> <h2>Balancesheet</h2>";

print_r($sheet);
echo "</pre>";
echo "<pre> <h2>Closing</h2>";

print_r($sheet_closing);
echo "</pre>";
?>
