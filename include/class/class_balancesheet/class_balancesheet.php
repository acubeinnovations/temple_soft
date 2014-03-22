<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class BalanceSheet{
	var $connection 		= "";
	var $ledgers_liabilities = array(2,3,5,8,22,24,29,31,34);
	var $ledgers_assets = array(1,6,7,9,15,20,21,26,27,32,33);

	var $p_and_l_expenses = array(10,13,14,19);
	var $p_and_l_income = array(11,16,17,18);

	var $fy_id = "";
	
	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

	function get(){
		$balancesheet = array();

		$strSQL = "SELECT LS.ledger_id, LM.ledger_name , SUM(AM.account_debit), SUM(AM.account_credit), ( SUM(AM.account_debit) -SUM(AM.account_credit)) as balance 
FROM 
ledger_sub LS, ledger_master LM , account_master AM
WHERE 
LS.ledger_id=LM.ledger_id 
AND LS.fy_id='".$this->fy_id."' 
AND  AM.ref_ledger=LS.ledger_sub_id 
AND AM.fy_id='".$this->fy_id."' 
AND AM.deleted='".NOT_DELETED."'
GROUP BY LS.ledger_id 
ORDER BY LS.ledger_id ASC";


        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if(mysql_num_rows($rsRES) > 0){
			$sheet_liabilities = array();
			$sheet_assets = array();
			$total_liabilities =0;
			$total_assets =0;
			$total_expenses =0;
			$total_income =0;
			$index = 0;

            while($row = mysql_fetch_assoc($rsRES)){

				if(in_array($row['ledger_id'],$this->ledgers_liabilities)){

					if($row['balance'] < 0){
						$sheet_assets[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_assets[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_assets[$index]["balance"] = abs($row['balance']);
						$total_assets += abs($row['balance']);
					}else{
						$sheet_liabilities[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_liabilities[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_liabilities[$index]["balance"] = abs($row['balance']);
						$total_liabilities += abs($row['balance']);
					}


				}
				if(in_array($row['ledger_id'],$this->ledgers_assets)){

					if($row['balance'] < 0){
						$sheet_liabilities[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_liabilities[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_liabilities[$index]["balance"] = abs($row['balance']);
						$total_liabilities += abs($row['balance']);
					}else{
						$sheet_assets[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_assets[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_assets[$index]["balance"] = abs($row['balance']);
						$total_assets += abs($row['balance']);
					}
					
				}
				if(in_array($row['ledger_id'],$this->p_and_l_expenses)){
						$total_expenses += abs($row['balance']);
				}
				if(in_array($row['ledger_id'],$this->p_and_l_income)){
						$total_income += abs($row['balance']);
				}

				$index++;
			}
			$balancesheet["liabilities"] = $sheet_liabilities;
			$balancesheet["assets"] = $sheet_assets;
			$balancesheet["total_liabilities"] = $total_liabilities;
			$balancesheet["total_assets"] = $total_assets;
			$balancesheet["total_expenses"] = $total_expenses;
			$balancesheet["total_income"] = $total_income;
			if(($total_income - $total_expenses)<0){
				$balancesheet["profit"]  = 0;
				$balancesheet["loss"]  = abs($total_income - $total_expenses);
				$balancesheet["difference_in_opening_balance"]  = (abs($total_income - $total_expenses)+$total_liabilities)-$total_assets;
			}else{
				$balancesheet["profit"]  = $total_income - $total_expenses;
				$balancesheet["loss"]  = 0;
				$balancesheet["difference_in_opening_balance"]  = (abs($total_income - $total_expenses)+$total_assets)-$total_liabilities;
			}
			
			
        }else{
			$balancesheet =false;
		}

		return $balancesheet;
	}

}

?>
