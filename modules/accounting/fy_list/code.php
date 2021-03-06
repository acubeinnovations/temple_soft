<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

if(isset($_SESSION[SESSION_TITLE.'current_fy_id'])){
	$current_fy_id = $_SESSION[SESSION_TITLE.'current_fy_id'];
}else{
	$current_fy_id = gINVALID;
}

$pagination = new Pagination(10);

$financial_year = new FinancialYear($myconnection);
$financial_year->connection = $myconnection;

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;

$last_record = $financial_year->getLastRecord();

$mybalancesheet = new BalanceSheet($myconnection);


$mystock_register = new StockRegister($myconnection);
$mystock_register->connection = $myconnection;


//delete
if(isset($_GET['dlt'])){
	$financial_year->id = $_GET['dlt'];
	$financial_year->delete();
}



//close
if(isset($_GET['cls'])){
	$_SESSION[SESSION_TITLE.'flash'] = "";
	if($mybalancesheet->error == false){

		$financial_year->id = $_GET['cls'];
		$financial_year->get_details();
		if($financial_year->checkNextFY($financial_year->fy_end) == true){
			// Stock Close
			$result = $mystock_register->close($_GET['cls'],$financial_year->next_fy_id,date('Y-m-d', strtotime('+1 day', strtotime($financial_year->fy_end))));
			//echo "<pre>";
			//print_r($close_data);
			//echo "</pre>";
			//exit();

			if($result == true){
				//fetched closing data
				$close_data = $mybalancesheet->get_closing();
				$close_data_liabilities = $close_data["liabilities"];
				$close_data_assets = $close_data["assets"];
				$close_data_income = $close_data["income"];
				$close_data_expenses = $close_data["expenses"];
			
				// set new FY id as current
				$financial_year->current_fy_id = $financial_year->next_fy_id;
				$current_fy_id = $financial_year->updateCurrentFY();
				

				// add opening balance for liabilities
				foreach ($close_data_liabilities as $row_liabilities){
					//echo $row_liabilities["ledger_sub_id"].",".$row_liabilities["ledger_sub_name"].",".$row_liabilities["balance"]."<br>";

					$account = new Account($myconnection);
					$account->connection = $myconnection;
					$account->mysqli = $mysqli;
					$account->ref_ledger = $row_liabilities["ledger_sub_id"];
					$account->date = date('Y-m-d', strtotime('+1 day', strtotime($financial_year->fy_end))); 
					$account->account_to = $row_liabilities["ledger_sub_id"];
					$account->account_credit = $row_liabilities["balance"];
	//				echo "<pre>";
	//				print_r($account);
	//				echo "</pre>";
					$account->update();

				}

				// add opening balance for assets
				foreach ($close_data_assets as $row_assets){
					//echo $row_assets["ledger_sub_id"].",".$row_assets["ledger_sub_name"].",".$row_assets["balance"]."<br>";
					$account = new Account($myconnection);
					$account->connection = $myconnection;
					$account->mysqli = $mysqli;
					$account->ref_ledger = $row_assets["ledger_sub_id"];
					$account->date = date('Y-m-d', strtotime('+1 day', strtotime($financial_year->fy_end))); 
					$account->account_from = $row_assets["ledger_sub_id"];
					$account->account_debit = $row_assets["balance"];
	//				echo "<pre>";
	//				print_r($account);
	//				echo "</pre>";
					$account->update();
				}

	// add profit or loss to capital
					$default_capital = $financial_year->get_default_capital_account();
					$result = false;
					if($default_capital > 0){
						$account = new Account($myconnection);
						$account->connection = $myconnection;
						$account->mysqli = $mysqli;
						$account->ref_ledger = $default_capital;
						$account->date = date('Y-m-d', strtotime('+1 day', strtotime($financial_year->fy_end))); 
						$account->account_from = $default_capital;
						if ($close_data["profit"] >0){
							$account->account_credit = $close_data["profit"];
						}elseif ($close_data["loss"] >0){
							$account->account_debit = $close_data["loss"];				
						}

						$account->update();
						$result=true;
					}else{
						$_SESSION[SESSION_TITLE.'flash'] .= "Default capital account not in settings<br>";
						$result=false;
					}

				if($financial_year->next_fy_id > 0 && $result==true  ){
					// create vouchers for New FY

					$financial_year->create_FY_vouchers($_SESSION[SESSION_TITLE.'current_fy_id'],$financial_year->next_fy_id);
					// create subledgers for New FY
					$result = $financial_year->create_FY_subledgers($financial_year->next_fy_id);
					if($result == true){
						// close FY
						$result = $financial_year->close();
					}else{
						$_SESSION[SESSION_TITLE.'flash'] .= "Adding sub ledges for next Fy failed <br>";
						$result =false;
					
					}
				}else{
					$_SESSION[SESSION_TITLE.'flash'] .= "Please check for next FY <br>";
					$result =false;
				}
			}else{
					$_SESSION[SESSION_TITLE.'flash'] .= "Stock closing failed <br>";
					$result =false;
			}

			if($result==false){
				// error occured remove added account entries for New FY
				 $financial_year->delete_FY_account_entries($financial_year->next_fy_id);

				// error occured remove added subledgers for New FY
				 $financial_year->delete_FY_subledgers($financial_year->next_fy_id);
				 $financial_year->delete_FY_vouchers($financial_year->next_fy_id);
				 
				// error occured revert close
				$financial_year->id = $_GET['cls'];
				$financial_year->revert_close();
				//error occured  set reset FY id as current
				$financial_year->current_fy_id = $_GET['cls'];
				$current_fy_id = $financial_year->updateCurrentFY();
				
				// error occured revert stock closing
				$mystock_register->revert_close($financial_year->next_fy_id);
			}
			
			
		}else{
			$_SESSION[SESSION_TITLE.'flash'] .= "Please check for next FY <br>";
			$result =false;
		}
	}else{
		$_SESSION[SESSION_TITLE.'flash'] .= "Unable to fetch closing data, Please check for FY in account settings <br>";
		$result =false;
	}

	$account_settings->updateSessionValues();

	if($result==true){
		$_SESSION[SESSION_TITLE.'flash'] = "Financial Year Closed";
	    header( "Location:".$current_url);
	    exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] .= "Unable to close Financial Year.";
	    header( "Location:".$current_url);
	    exit();
	}
}


$financial_year->total_records=$pagination->total_records;

$financial_years = $financial_year->get_list_array_bylimit($pagination->start_record,$pagination->max_records);


if($financial_years <> false){
	$pagination->total_records = $financial_year->total_records;
	$pagination->paginate();
	$count_financial_years = count($financial_years);
}else{
	$count_financial_years = 0;
}



?>
