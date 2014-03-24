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

$vazipadu_opening = $mybalancesheet->get_subledger_closing(2,"2014-3-23");
$vazipadu_closing = $mybalancesheet->get_subledger_closing(2);

echo "<pre> <h2>vazipadu Todays Opening</h2>";

print_r($vazipadu_opening);
echo "</pre>";

echo "<pre> <h2>vazipadu Todays Closing</h2>";
print_r($vazipadu_closing);
echo "</pre>";




?>
