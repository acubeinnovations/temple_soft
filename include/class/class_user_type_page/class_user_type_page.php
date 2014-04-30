<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class UserTypePage{

	var $connection = "";
	var $user_type_id  =  gINVALID; //master ledger
	var $page_id = gINVALID;

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if($this->validate()){
	    	$strSQL = "INSERT INTO user_type_page(user_type_id,page_id) VALUES('".mysql_real_escape_string($this->user_type_id)."','".mysql_real_escape_string($this->page_id)."')";
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
	    	$strSQL = "INSERT INTO user_type_page(user_type_id,page_id) VALUES";
	    	foreach ($pageIdArray as $page_id) {
	    		$strSQL .="('";
	    		$strSQL.= mysql_real_escape_string($this->user_type_id)."','";
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

    public function insert_batch_with_user_types($userTypes= array())
    {
    	if(count($userTypes) > 0){
	    	$strSQL = "INSERT INTO user_type_page(user_type_id,page_id) VALUES";
	    	foreach ($userTypes as $user_type_id) {
	    		$strSQL .="('";
	    		$strSQL.= mysql_real_escape_string($user_type_id)."','";
	    		$strSQL.= mysql_real_escape_string($this->page_id)."'),";
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

 

    public function validate()
    {
    	if($this->page_id > 0){
	    	$strSQL = "SELECT * FROM user_type_page WHERE user_type_id = '".$this->user_type_id."' AND page_id = '".$this->page_id."'";
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

    public function getUserTypePages()
    {
    	$pages = array();
    	$strSQL = "SELECT page_id FROM user_type_page WHERE user_type_id = '".$this->user_type_id."'";
    	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
	    if(mysql_num_rows($rsRES) > 0){
	    	while($row = mysql_fetch_assoc($rsRES)){
	    		array_push($pages, $row['page_id']);
	    	}
	    	return $pages;
	    }else{
	    	return false;
	    }
    }

}

?>