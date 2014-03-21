<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class ReportFeature{

	var $connection 	="";
	var $feature_id  	=  gINVALID; 
	var $report_id  	=  gINVALID; 
	var $ledger_id 		= "";
	var $position 		= ""; 
	var $priority 		= "";
	var $status 		= STATUS_INACTIVE;

	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if ( $this->feature_id == "" || $this->feature_id == gINVALID) {
    		$strSQL= "INSERT INTO report_feature(report_id,ledger_id,position,priority,status) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->report_id)."','";
    		$strSQL.= mysql_real_escape_string($this->ledger_id)."','";
    		$strSQL.= mysql_real_escape_string($this->position)."','";
    		$strSQL.= mysql_real_escape_string($this->priority)."','";
    		$strSQL.= mysql_real_escape_string($this->status)."')";
   
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->feature_id = mysql_insert_id();
				$this->error_description="Success";
				return $this->feature_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->feature_id > 0 ) {
    		$strSQL = "UPDATE report_feature SET report_id = '".addslashes(trim($this->report_id))."',";
    		$strSQL .= "ledger_id = '".addslashes(trim($this->ledger_id))."',";
    		$strSQL .= "position = '".addslashes(trim($this->position))."',";
    		$strSQL .= "priority = '".addslashes(trim($this->priority))."',";
			$strSQL .= "status = '".addslashes(trim($this->status))."'";
			$strSQL .= " WHERE feature_id = '".$this->feature_id."'";
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                return true;
           	}else{
				$this->error_number = 3;
				$this->error_description="Can't update";
				return false;
           	}
    	}
    }


    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$report_features = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT * FROM report_feature WHERE 1";

        $strSQL .= " ORDER BY feature_id";
		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
		if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
			if (trim($this->total_records)!="" && $this->total_records > 0) {
			} else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
				$this->total_records = mysql_num_rows($all_rs);
			}
			while ($row = mysql_fetch_row($rsRES) ){
				$reports[$i]["feature_id"] =  $row['feature_id'];
				$reports[$i]["report_head"] =  $row['report_head'];
				$reports[$i]["lhs"] =  $row['lhs'];
				$reports[$i]["rhs"] =  $row['rhs'];
				$reports[$i]["lhs_head"] =  $row['lhs_head'];
				$reports[$i]["rhs_head"] =  $row['rhs_head'];
				$reports[$i]["header"] =  $row['header'];
				$reports[$i]["footer"] =  $row['footer'];
				$reports[$i]["status"] =  $row['status'];
				
				$i++;
			}
			return $reports;
		} else {
			return false;
		}
    }

     public function get_details(){
    	
    	if ( ($this->feature_id != "" || $this->feature_id != gINVALID) && $this->feature_id >0 ) {
			$strSQL = "SELECT * FROM report WHERE feature_id = '".$this->feature_id."'";

			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->feature_id 		= $row['feature_id'];
				$this->report_head 		= $row['report_head'];
				$this->lhs				= $row['lhs'];
				$this->rhs 				= $row['rhs'];
				$this->lhs_head 		= $row['lhs_head'];
				$this->rhs_head			= $row['rhs_head'];
				$this->header 			= $row['header'];
				$this->footer 			= $row['footer'];
				$this->status			= $row['status'];
				return true;
			}else{
				return false;
			}
		}
    }

    public function delete()
    {
    	if ( ($this->feature_id != "" || $this->feature_id != gINVALID) && $this->feature_id >0 ){
    		$strSQL = "DELETE FROM report WHERE feature_id = '".$this->feature_id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="Report not deleted";
				return false;
            }
    	}else{
    		$this->error_description="Invalid Report";
			return false;
    	}
    }


    function get_list_array()
	{
		$reports = array();$i=0;
		$strSQL = "SELECT * FROM report";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
			{
			while ( $row = mysql_fetch_assoc($rsRES) ){
				$reports[$i]["feature_id"] =  $row['feature_id'];
				$reports[$i]["report_head"] =  $row['report_head'];
				$reports[$i]["lhs"] =  $row['lhs'];
				$reports[$i]["rhs"] =  $row['rhs'];
				$reports[$i]["lhs_head"] =  $row['lhs_head'];
				$reports[$i]["rhs_head"] =  $row['rhs_head'];
				$reports[$i]["header"] =  $row['header'];
				$reports[$i]["footer"] =  $row['footer'];
				$reports[$i]["status"] =  $row['status'];
				$i++;
           	}
            return $reports;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list Reports";
			return false;
    	}
}



}
?>