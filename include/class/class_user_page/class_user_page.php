<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class UserPage{

	var $connection = "";
	var $user_id  =  gINVALID; //master ledger
	var $page_id = gINVALID;

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if($this->validate()){
	    	$strSQL = "INSERT INTO user_menu(user_id,page_id) VALUES('".mysql_real_escape_string($this->user_id)."','".mysql_real_escape_string($this->page_id)."')";
	    	//echo $strSQL;exit();
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
			return false;
		}
    }

    public function insert_batch($pageIdArray= array())
    {
    	if(count($pageIdArray) > 0){
	    	$strSQL = "INSERT INTO user_page(user_id,page_id) VALUES";
	    	foreach ($pageIdArray as $page_id) {
	    		$strSQL .="('";
	    		$strSQL.= mysql_real_escape_string($this->user_id)."','";
	    		$strSQL.= mysql_real_escape_string($page_id)."'),";
			}
			
			$strSQL= substr($strSQL, 0,-1);

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

    public function check()
    {
    	if($this->user_id > 0){
	    	$strSQL = "SELECT count(*) AS num FROM user_page WHERE user_id = '".$this->user_id."'";
	    	//echo $strSQL;exit();
	    	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
	    	if(mysql_num_rows($rsRES) > 0){
	    		$row = mysql_fetch_assoc($rsRES);
	    		return $row['num'];
	    	}else{
	    		return false;
	    	}
	    }else{
	    	return false;
	    }
    }

    public function delete()
    {
    	if($this->user_id > 0){
	    	$strSQL = "DELETE FROM user_page WHERE user_id = '".$this->user_id."'";
	    	//echo $strSQL;exit();
	    	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
	    	if(mysql_num_rows($rsRES) > 0){
	    		return false;
	    	}else{
	    		return true;
	    	}
	    }else{
	    	return false;
	    }
    }

 

    public function validate()
    {
    	if($this->page_id > 0){
	    	$strSQL = "SELECT * FROM user_page WHERE user_id = '".$this->user_id."' AND page_id = '".$this->page_id."'";
	    	//echo $strSQL;exit();
	    	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
	    	if(mysql_num_rows($rsRES) > 0){
	    		return false;
	    	}else{
	    		return true;
	    	}
	    }else{
	    	return false;
	    }
    }

}

?>