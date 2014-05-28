<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
//echo $_SESSION[SESSION_TITLE.'fy_end_date'];exit();
//check current date with current financial year
$check =checkFinancialYear($_SESSION[SESSION_TITLE.'fy_status'],$_SESSION[SESSION_TITLE.'fy_start_date'],$_SESSION[SESSION_TITLE.'fy_end_date']);
if(!$check){
	$_SESSION[SESSION_TITLE.'flash'] = "Please check Financial Year";
    header( "Location:index.php");
    exit();
}
//checking financial year ends


if(isset($_SESSION[SESSION_TITLE.'userid'])){
	$user_id = $_SESSION[SESSION_TITLE.'userid'];
}else{
	$user_id = -1;
}
$submit_value = $cap_submit;

$voucher=new Voucher($myconnection);
$voucher->connection=$myconnection;

$module=new Module($myconnection);
$module->connection=$myconnection;

$account=new Account($myconnection);
$account->connection=$myconnection;
$account->mysqli = $mysqli;

$add_vazhipadu=new Vazhipadu($myconnection);
$add_vazhipadu->connection=$myconnection;
$add_vazhipadu->user_id = $user_id;

$add_pooja=new Pooja($myconnection);
$add_pooja->connection=$myconnection;

$add_pooja->status_id = STATUS_ACTIVE;
$array_vazhipadu=$add_pooja->get_array();
if($array_vazhipadu==false){
	$array_vazhipadu=array();
}
$txtquantity = false;
$voucher_number_array = array();

$add_star=new Stars($myconnection);
$add_star->connection=$myconnection;
$add_star->status_id = STATUS_ACTIVE;
$array_star=$add_star->get_array();

// voucher details
$voucher->module_id = MODULE_VAZHIPADU;
$voucher_details = $voucher->get_details_with_moduleid();
if(!$voucher_details){
	$_SESSION[SESSION_TITLE.'flash'] = "Vazhipadu Voucher Not Found.";
    header( "Location:".$current_url);
    exit();
}



if(isset($_GET['pr'])){

	$add_vazhipadu->vazhipadu_rpt_number = $_GET['pr'];
	
	$voucher_number_array = $voucher->get_number_attributes($voucher->voucher_id);
	
	list($vazhipadu_details,$variable) = $add_vazhipadu->get_vazhipadu_details();
}else{
	$vazhipadu_details = false;
}

if(isset($_GET['cn'])){
	$add_vazhipadu->vazhipadu_rpt_number = $_GET['cn'];
	list($vazhipadu_details_cn,$variable_cn) = $add_vazhipadu->get_vazhipadu_details();
	if(count($vazhipadu_details_cn) == 1){
		if(trim($vazhipadu_details_cn[0]['name']) == '' and $vazhipadu_details_cn[0]['star_id'] == -1){
			$txtquantity = $vazhipadu_details_cn[0]['quantity'];
			$vazhipadu_details_cn = false;
		}
	}
	
	$submit_value = $cap_Finish;
}else{
	$vazhipadu_details_cn = false;
}



if(isset($_POST['submit'])){
//print_r($_POST);exit();
	$errorMSG = "";
	if($_POST['listpooja'] >0){
	}else{
		$errorMSG .= "Select Pooja ";
	}

	if(isset($_POST['chk_qty'])){
		if(!filter_var($_POST['txtqty'],FILTER_VALIDATE_INT)){
			$errorMSG .= "Invalid Quantity";
		}
	}else{
		if(!isset($_POST['hd_row'])){
			$errorMSG .= "Name not added ";
		}
	}


	if($errorMSG == ""){
		$total_amount = 0;
		$add_vazhipadu->pooja_id=$_POST['listpooja'];
		$add_vazhipadu->amount=$_POST['txtamount'];
		$add_vazhipadu->vazhipadu_date = $_POST['txtdate'];
		
		//add voucher entry
		if($_POST['hd_voucherid'] > 0){
			//get voucher details
			$voucher->voucher_id = $_POST['hd_voucherid'];
			$voucher->get_details();

			if(isset($_POST['chk_qty'])){
				$total_amount = $_POST['txtamount']*$_POST['txtqty'];
				$add_vazhipadu->quantity = $_POST['txtqty'];
				$dataArray = false;
			}else{
				$dataArray = array();$i=0;
				$total_amount = 0;
				foreach($_POST['hd_row'] as $row){
					$list = explode("_", $row);
					$dataArray[$i]['name'] = $list[0];
					$dataArray[$i]['star_id'] = $list[1];
					$dataArray[$i]['quantity'] = $list[2];
					$total_amount += $_POST['txtamount'] * $list[2];
					$i++;
				}
			}
			
			$account->voucher_type_id	= $voucher->voucher_id;
			$dataAccount = array();
			$account->account_from 		= $voucher->default_from;
			$account->account_to		= $_POST['hd_ledger_id'];//$voucher->default_to;
			$account->date				= CURRENT_DATE;
			$dataAccount[0]['account_debit']  = $total_amount;
			$dataAccount[0]['account_credit'] = "";
			$dataAccount[0]['ref_ledger'] = $account->account_from;
			$dataAccount[1]['account_debit']  = "";
			$dataAccount[1]['account_credit'] = $total_amount;
			$dataAccount[1]['ref_ledger'] = $account->account_to;

			//print_r($dataAccount);exit();
			$insert = $account->insert_batch($dataAccount);
			mysqli_close();
			//voucher entry ends

			if($insert){
				$account->account_id = $insert;
				$account->get_details();
				$vazhipadu_rpt_number = $account->voucher_number;
				$add_vazhipadu->vazhipadu_rpt_number = $vazhipadu_rpt_number;

				$last_id = $add_vazhipadu->update($dataArray);
				if($last_id){
					if($vazhipadu_rpt_number){	
						//print page
						$url = $current_url."?pr=".$vazhipadu_rpt_number;
						if($_POST['hd_continue'] == '1'){
							$url .= "&cn=1";
						}
						header( "Location:".$url);
						exit();
					}
				}
			}
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "No Voucher Selected.";
	        header( "Location:".$current_url);
	        exit();
		}

	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url);
        exit();
	}

}

if(isset($_GET['pooja']) and $_GET['pooja'] > 0)
{
	$json = array();
   	$add_pooja->id=$_GET['pooja'];
   	$add_pooja->get_details();
   	$json['rate'] = $add_pooja->rate;
   	$json['ledger'] = $add_pooja->ledger_sub_id;
   	echo json_encode($json);exit();
     
}





?>