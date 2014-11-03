<?php

$dbhostname = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "temple_soft";
//establish the connection with the database server
$myconnection = mysql_connect($dbhostname, $dbusername, $dbpassword) or die ("Unable to connect to server" . mysql_error());

//connect to the database
$blnConnected = mysql_select_db ($dbname, $myconnection) or die("Unable to connect to database" . mysql_error());


/*
$query = "SELECT * FROM account_master WHERE voucher_type_id = '1' AND account_to = '-1' ORDER BY account_id";
$result = mysql_query($query,$myconnection) or die ( mysql_error() . $query );

$update_count = 0;

while($row = mysql_fetch_assoc($result)){

	$ac_id = $row['account_id'];

	$rpt_number = $row['voucher_number'];

	$query1 = "SELECT P.ledger_sub_id as lsid FROM vazhipadu V,pooja P WHERE V.vazhipadu_rpt_number = '{$rpt_number}' AND P.id = V.pooja_id";
	$result1 = mysql_query($query1,$myconnection) or die ( mysql_error() . $query1 );



	if(mysql_num_rows($result1) >  0){

		$row1 = mysql_fetch_assoc($result1);
		$ledger_sub_id = $row1['lsid'];
		

		if($row['ref_ledger'] == '-1'){
			$update_qry = "UPDATE account_master SET account_to = '{$ledger_sub_id}',ref_ledger = '{$ledger_sub_id}' WHERE account_id = '{$ac_id}'";

			
		}else{
			$update_qry = "UPDATE account_master SET account_to = '{$ledger_sub_id}' WHERE account_id = '{$ac_id}'";

		}


		

		mysql_query($update_qry,$myconnection) or die ( mysql_error() . $update_qry );

		$update_count++;

	}
 
}

echo $update_count." records updated";

*/

$qry_vazhipadu = "SELECT pooja_id,vazhipadu_rpt_number,ledger_sub_id FROM vazhipadu,pooja WHERE vazhipadu_rpt_number IN (SELECT voucher_number FROM account_master WHERE voucher_type_id = '1' AND deleted = '1' AND (date BETWEEN '2014-06-01' AND '2014-06-30')) AND pooja.id = vazhipadu.pooja_id";
$result_vazhipadu = mysql_query($qry_vazhipadu,$myconnection) or die ( mysql_error() . $qry_vazhipadu );
$i=0;
while($row_vzh = mysql_fetch_assoc($result_vazhipadu)){
	$i++;
	$voucher_number = $row_vzh['vazhipadu_rpt_number'];
	$ledger_sub_id = $row_vzh['ledger_sub_id'];

	$query = "SELECT account_id,account_from,account_to,account_credit,ref_ledger FROM account_master WHERE voucher_type_id = '1' AND voucher_number = {$voucher_number} ";

	$result = mysql_query($query,$myconnection) or die ( mysql_error() . $query );

	if(mysql_num_rows($result) > 0){

		while($row = mysql_fetch_assoc($result)){

			if($row['account_to'] != $ledger_sub_id){
				
				print_r($row)

				if($row['account_to'] == $row['ref_ledger']){//pooja record change both account to and ref ledger if not correct
					
				}else{//cash record change account to if not correct

				}
					
			}else{
					//do nothing
			}
		
			
		}
	}

}







?>