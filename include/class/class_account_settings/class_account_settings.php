<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class AccountSettings{

	var $connection ="";
	var $id  =  gINVALID;//fy_id
	var $current_fy_id = gINVALID;
    var $default_capital = gINVALID;

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';


    public function getAccountSettings()
    {
    	$strSQL = "SELECT * FROM account_settings WHERE id = '1'";
    	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    	if(mysql_num_rows($rsRES) > 0){
    		$row 	= mysql_fetch_assoc($rsRES);
    		$this->id = $row['id'];
    		$this->current_fy_id = $row['current_fy_id'];
            $this->default_capital = $row['default_capital'];
    		return true;
    	}else{
    		return false;
    	}
    }

	public function update()
    {
    	if ( ($this->current_fy_id != "" || $this->current_fy_id != gINVALID) && $this->current_fy_id >0 ) {
    		$strSQL = "UPDATE account_settings SET";
            $strSQL.= " current_fy_id = '".mysql_real_escape_string($this->current_fy_id)."',";
            $strSQL.= " default_capital = '".mysql_real_escape_string($this->default_capital)."'";

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
}

?>