<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$voucher=new Voucher($myconnection);
$voucher->connection=$myconnection;

$account=new Account($myconnection);
$account->connection=$myconnection;

$add_vazhipadu=new Vazhipadu($myconnection);
$add_vazhipadu->connection=$myconnection;

$add_pooja=new Pooja($myconnection);
$add_pooja->connection=$myconnection;

$array_vazhipadu=$add_pooja->get_array();
if($array_vazhipadu==false){
	$array_vazhipadu=array();
}


$add_star=new Stars($myconnection);
$add_star->connection=$myconnection;
$array_star=$add_star->get_array();

if(isset($_POST['submit'])){
	$total_amount = 0;
	$add_vazhipadu->pooja_id=$_POST['listpooja'];
	$add_vazhipadu->amount=$_POST['txtamount'];
	$add_vazhipadu->vazhipadu_date = $_POST['txtdate'];
	

	$dataArray = array();
	$i=0;

	if(isset($_POST['hd_row'])){
		$total_amount = $_POST['txtamount']*count($_POST['hd_row']);
		foreach($_POST['hd_row'] as $row){
			$list = explode("_", $row);
			$dataArray[$i]['name'] = $list[0];
			$dataArray[$i]['age'] = $list[1];
			$dataArray[$i]['star_id'] = $list[2];
			$i++;
		}
	}else{
		$total_amount = $_POST['txtamount'];
	}
	//add voucher entry
	$voucher->module_id = $_POST['hd_moduleid'];
	$voucher->get_details_with_moduleid();
	//get next voucher number
	$next_voucher_number = $account->getNextVoucherNumber($voucher->voucher_id);
	if($next_voucher_number){
		$voucher_number = $next_voucher_number;
	}else{
		$voucher_number = $voucher->series_start;
	}
	
	$account->voucher_number 	= $voucher_number;
	$account->voucher_type_id	= $voucher->voucher_id;
	$dataAccount = array();
	$account->fy_id				= $voucher->fy_id;
	$account->account_from 		= $voucher->default_from;
	$account->account_to		= $voucher->default_to;
	$account->date				= CURRENT_DATE;
	$dataAccount[0]['account_debit']  = $total_amount;
	$dataAccount[0]['account_credit'] = "";
	$dataAccount[0]['ref_ledger'] = $voucher->default_from;
	$dataAccount[1]['account_debit']  = "";
	$dataAccount[1]['account_credit'] = $total_amount;
	$dataAccount[1]['ref_ledger'] = $voucher->default_to;
	$insert = $account->insert_batch($dataAccount);
	//voucher entry ends

	if($insert){
		$account->get_details();
		$vazhipadu_rpt_number = $voucher->series_prefix.$voucher->series_seperator.$account->voucher_number.$voucher->series_seperator.$voucher->series_sufix;
		$add_vazhipadu->vazhipadu_rpt_number = $vazhipadu_rpt_number;


		$last_id = $add_vazhipadu->update($dataArray);
		if($last_id){
			if($vazhipadu_rpt_number){
				header("Location:vazhipadu_print.php?id=".$vazhipadu_rpt_number);
				exit();
			}else{
				header("Location:vazhipadu.php");
				exit();
			}
		}
	}

}

if(isset($_POST['pooja']) and $_POST['pooja'] > 0)
{
   $add_pooja->id=$_POST['pooja'];
    $add_pooja->get_details();
        print  $add_pooja->rate;
        exit();
       
  
}





?>