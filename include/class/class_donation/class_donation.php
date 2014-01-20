<?php 

if(!defined('CHECK_INCLUDED')){
	exit();
}

Class Donation{

var $id=gINVALID;
var $bill_item_id=gINVALID;
var $date="";
var $name="";
var $address="";
var $star_id=gINVALID;
var $amount="";
var $description="";

var $error = false;
var $error_number=gINVALID;
var $error_description="";
var $total_records='';



function update()
		{

			if ( $this->id == "" || $this->id == gINVALID) {
			$strSQL = "INSERT INTO donations(name,address,star_id,amount,description) VALUES ('";
			$strSQL .= addslashes(trim($this->name)) ."','";
			$strSQL .= addslashes(trim($this->address)) ."','";
			$strSQL .= addslashes(trim($this->star_id)) ."','";
			$strSQL .= addslashes(trim($this->amount)) ."','";
			$strSQL .= addslashes(trim($this->description)) . "')";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

       if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
        		  }else{
              $this->error_number = 3;
              $this->error_description="Can't insert Donation ";
              return false;
              }
         }

	elseif($this->id > 0 ) {
			$strSQL = "UPDATE donations SET name ='".addslashes(trim($this->name))."',"; 
			$strSQL .= "address = '".addslashes(trim($this->address))."',";
			$strSQL .= "star_id = '".addslashes(trim($this->star_id))."',";
			$strSQL .= "amount = '".addslashes(trim($this->amount))."',";
			$strSQL .= "description = '".addslashes(trim($this->description))."'";
			$strSQL .= " WHERE id = ".$this->id;
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

        if ( mysql_affected_rows($this->connection) >= 0 ) {
                 return true;
           	     }else{
               	 $this->error_number = 3;
              	 $this->error_description="Can't update donations";
               	return false;
           		 }
    		  }
  }











}

?>