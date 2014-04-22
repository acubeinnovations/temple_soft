<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

/*
Financial Year Rules

	1.Limit financial year entries  by ‘2’ open records.
		2 open records
		Many close records

	2.When we close currently running financial year next one selected for current use. 
		All ledgers and vouchers are regenerated for next financial year. Ledger are not generated but a link table used for this purpose. 
		Vouchers are automatically generated with new financial year id.

	3.When we add new financial year check start date , which is equal to  ‘current financial year end date + 1 day’.
		Next start date  = Current end date + 1day;

	4.Once a financial year closed , It can not be edited.

	5.Switching to closed financial year is allowed . But Update database strictly not allowed .

	6.Choosing next financial year is allowed only current one is closed.

	7.When we close financial year before end date reached, Then  entries into database  is allowed only from next financial year start date.

	8.We can not update database when current financial year end date crossed. 

*/

Class FinancialYear{

	var $connection ="";
	var $id  =  gINVALID;//fy_id
	var $fy_name ="";
	var $fy_start ="";
	var $fy_end ="";
	var $status = FINANCIAL_YEAR_CLOSE;

	var $current_fy_id =  gINVALID;
	var $next_fy_id =  gINVALID;

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function __construct($connection)
    {
    	$strSQL = "SELECT * FROM account_settings WHERE id = '1'";
    	$rsRES = mysql_query($strSQL,$connection) or die(mysql_error(). $strSQL );
    	if(mysql_num_rows($rsRES) > 0){
    		$row = mysql_fetch_assoc($rsRES);
    		$this->current_fy_id =$row['current_fy_id'];
    	}
    }


    public function update()
    {
    	if ( $this->id == "" || $this->id == gINVALID) {
    		$this->validate();
    		$strSQL = "INSERT INTO fy_master(fy_name,fy_start,fy_end,status) VALUES('";
    		$strSQL .= mysql_real_escape_string($this->fy_name)."','";
    		$strSQL .= date('Y-m-d',strtotime($this->fy_start))."','";
    		$strSQL .= date('Y-m-d',strtotime($this->fy_end))."','";
    		$strSQL .= mysql_real_escape_string(trim($this->status))."')";

			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->id = mysql_insert_id();
				return $this->id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert Financial Year";
				return false;
			}
    	}else{

    		$strSQL = "UPDATE fy_master SET fy_name = '".addslashes(trim($this->fy_name))."',";
			//$strSQL .= "fy_start = '".date('Y-m-d',strtotime($this->fy_start))."',";
			$strSQL .= "fy_end = '".date('Y-m-d',strtotime($this->fy_end))."',";
			$strSQL .= "status = '".addslashes(trim($this->status))."'";
			$strSQL .= " WHERE fy_id = ".$this->id;
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                  return true;
           	}else{
               	$this->error_number = 3;
              	$this->error_description="Can't update Financial Year";
               	return false;
       		 }

    	}
    }

    public function get_details(){
    	
    	if ( ($this->id != "" || $this->id != gINVALID) && $this->id >0 ) {
			$strSQL = "SELECT * FROM fy_master WHERE fy_id = '".$this->id."'";
			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->id 			= $row['fy_id'];
				$this->fy_name 		= $row['fy_name'];
				$this->fy_start		= date('d-m-Y',strtotime($row['fy_start']));
				$this->fy_end 		= date('d-m-Y',strtotime($row['fy_end']));
				$this->status 		= $row['status'];
				return true;
			}else{
				return false;
			}
		}
    }

    function get_list_array(){
    	$financial_years = array();
		$i=0;
		
        $strSQL = "SELECT * FROM fy_master WHERE 1";

        $strSQL .= " ORDER BY fy_id";
		
		$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
		if ( mysql_num_rows($rsRES) > 0 ){

			while ( list ($id,$name,$start,$end,$status) = mysql_fetch_row($rsRES) ){
				$financial_years[$i]["fy_id"] =  $id;
				$financial_years[$i]["fy_name"] = $name;
				$financial_years[$i]["fy_start"] = date('d-m-Y',strtotime($start));
				$financial_years[$i]["fy_end"] = date('d-m-Y',strtotime($end));
				$financial_years[$i]["status"] = $status;
				$financial_years[$i]["fy_status"] = ($status == FINANCIAL_YEAR_CLOSE)?"Yes":"No";
				$i++;
			}
			return $financial_years;
		} else {
			return false;
		}
    }

    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$financial_years = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT * FROM fy_master WHERE 1";

        $strSQL .= " ORDER BY fy_id";
		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
		if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
			if (trim($this->total_records)!="" && $this->total_records > 0) {
			} else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
				$this->total_records = mysql_num_rows($all_rs);
			}
			while ( list ($id,$name,$start,$end,$status) = mysql_fetch_row($rsRES) ){
				$financial_years[$i]["fy_id"] =  $id;
				$financial_years[$i]["fy_name"] = $name;
				$financial_years[$i]["fy_start"] = date('d-m-Y',strtotime($start));
				$financial_years[$i]["fy_end"] = date('d-m-Y',strtotime($end));
				$financial_years[$i]["status"] = $status;
				$financial_years[$i]["fy_status"] = ($status == FINANCIAL_YEAR_CLOSE)?"Yes":"No";
				$i++;
			}
			return $financial_years;
		} else {
			return false;
		}
    }

    public function delete()
    {
    	if ( ($this->id != "" || $this->id != gINVALID) && $this->id >0 ) {

    		//1.check if this fiscal year has previos year .If yes not delete

    		//2. If previos state return true then delete 



    	}else{
    		$this->error_description="Invalid Financial Year .";
            return false;
    	}

    }

    public function get_default_capital_account(){
		$strSQL = "SELECT* FROM account_settings  WHERE id = '1'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if(mysql_num_rows($rsRES) > 0){
            $row = mysql_fetch_assoc($rsRES);
            return $row["default_capital"];
        }else{
           return false;
        }

	}

    public function revert_close(){
		$this->get_details();
		$this->status = FINANCIAL_YEAR_OPEN;
		$this->update();
		return true;
		
	}
    public function close(){
		$this->get_details();
		if($this->checkNextFY($this->fy_end)){
			$this->status = FINANCIAL_YEAR_CLOSE;
			$this->update();
			return true;
		}else{
			return false;
		}
	}



    public function create_FY_subledgers($new_fyid){

		if($new_fyid>0){
			$strSQL = "INSERT INTO fy_ledger_sub (fy_id,ledger_sub_id) SELECT ".$new_fyid.", ledger_sub_id FROM ledger_sub";
			$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
			return true;
		}else{
			return false;
		}
	}

	//regenerate vouchers for next financial year 
	public function create_FY_vouchers($new_fyid){

		if($new_fyid>0){
			$strSQL = "INSERT INTO voucher (fy_id,ledger_sub_id) SELECT ".$new_fyid.", ledger_sub_id FROM ledger_sub";
			$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
			return true;
		}else{
			return false;
		}
	}



    public function delete_FY_subledgers($new_fyid){

		if($new_fyid>0){
			$strSQL = "DELETE FROM fy_ledger_sub WHERE fy_id ='".$new_fyid."'";
			$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
			return true;
		}else{
			return false;
		}
	}

    public function delete_FY_account_entries($new_fyid){

		if($new_fyid>0){
			$strSQL = "DELETE FROM account_master WHERE fy_id ='".$new_fyid."'";
			$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
			return true;
		}else{
			return false;
		}
	}



	public function checkNextFY($enddate){
		
		if(trim($enddate) != ""){
			$start_date =date('Y-m-d', strtotime('+1 day', strtotime($enddate)));
			$strSQL = "SELECT * FROM fy_master WHERE fy_start = '".$start_date."'";
		    $strSQL .= " ORDER BY fy_id";
			$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
			if ( mysql_num_rows($rsRES) == 1 ){
				$row = mysql_fetch_assoc($rsRES);
				$this->next_fy_id = $row["fy_id"];
				return true;
			}else{
				$this->next_fy_id = gINVALID;
				return false;
			}
		}else{
			$this->next_fy_id = gINVALID;
			return false;
		}
	}

	public function updateCurrentFY(){
        if ( $this->current_fy_id >0 ) {
            $strSQL = "UPDATE account_settings SET current_fy_id = '".$this->current_fy_id."'";

            $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

            if ( mysql_affected_rows($this->connection) > 0 ) {
                $this->current_fy_id = mysql_insert_id();
                return $this->current_fy_id;
            }else{
                $this->error_number = 3;
                $this->error_description="Can't Update Financial Year";
                return false;
			}
		}
	}

	public function validate($new_start='',$new_end='')
	{
		$errorMSG = "";
		if(trim($new_start) != "" and trim($new_end) != ""){
			$lastRecord = $this->getLastRecord();
			if($lastRecord){
				$new_start 	= strtotime($new_start);
				$new_end 	= strtotime($new_end);
			
				$last_start 	= strtotime($lastRecord['fy_start']);
				$last_end 		= strtotime($lastRecord['fy_end']);

				if ( $this->id == "" || $this->id == gINVALID) {//add new
					if($new_start != strtotime('+1 day', $last_end)){
						$errorMSG .= "Invalid Start date<br/>";
					}
				}

				if($new_end < strtotime('+1 day', $new_start)){
					$errorMSG .= "Invalid end Date<br/>";
				}

				//checking
				if($errorMSG != ""){
					$this->error_description = $errorMSG;
					return false;
				}else{
					return true;
				}

			}else{
				$this->error_description = "Empty Table";
				return true;
			}
		}else{
			$this->error_description = "Start and End dates are required fields";
			return false;
		}
	}

	public function getLastRecord()
	{
		$lastRow = array();
		$strSQL = "SELECT * FROM `fy_master` WHERE fy_id = (SELECT max( fy_id ) FROM fy_master ) ";
		$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
		if ( mysql_num_rows($rsRES) == 1 ){
			$row = mysql_fetch_assoc($rsRES);
			$lastRow['id']			= $row['fy_id'];
			$lastRow['fy_name']	 	= $row['fy_name'];
			$lastRow['fy_start']	= date('d-m-Y',strtotime($row['fy_start']));
			$lastRow['fy_end']		= date('d-m-Y',strtotime($row['fy_end']));
			$lastRow['status']	 	= $row['status'];
			return $lastRow;
		}else{
			return false;
		}
	}

	public function getCount($filter = "")
	{
		$strSQL = "SELECT COUNT(*) FROM fy_master WHERE 1";
		if($filter != ""){
			$strSQL .= " AND ".$filter;
		}
		//echo $strSQL;
		$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
		if ( mysql_num_rows($rsRES) > 0 ){
			$row = mysql_fetch_row($rsRES);
			return $row[0];
		}else{
			return 0;
		}
	}
	


    
}

?>
