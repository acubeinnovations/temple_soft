<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class FyLedgerSub{

	var $connection = "";
	var $fy_id  =  gINVALID; //master ledger
	var $ledger_sub_id = gINVALID;

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
    		//echo $this->current_fy_id;exit();
    	}else{
    		header("Location:ac_account_settings.php");exit();
    	}
    }

    public function insert_batch($dataArray= array())
    {
    	if(count($dataArray) > 0){
	    	$strSQL = "INSERT INTO fy_ledger_sub(fy_id,ledger_sub_id) VALUES";
	    	foreach ($dataArray as $row) {
	    		if(isset($row['fy_id'])){
	    			$this->fy_id = $row['fy_id'];
	    		}
	    		if(isset($row['ledger_sub_id'])){
	    			$this->ledger_sub_id = $row['ledger_sub_id'];
	    		}
	    		$strSQL .="('";
	    		$strSQL.= mysql_real_escape_string($this->fy_id)."','";
	    		$strSQL.= mysql_real_escape_string($this->ledger_sub_id)."'),";
			}
			$strSQL.= substr($strSQL, 0,-1);
			mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->error_description="Data inserted Successfully";
				return true;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}
	 
	    	
		}else{
			$this->error_description = "Invalid data";
			return false;
		}
    }

    public function getFyLedgers()
    {

    }

}

?>