
<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Pooja{

	var $connection ="";
	var $id  =  gINVALID;
	var $name ="";
	var $rate ="";
	var $status_id ="";

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';



    function update()
		{
			if ( $this->id == "" || $this->id == gINVALID) {
			$strSQL = "INSERT INTO pooja (name,rate,status_id) VALUES ('";
			$strSQL .= addslashes(trim($this->name)) ."','";
			$strSQL .= addslashes(trim($this->rate)) . "','";
			$strSQL .= addslashes(trim($this->status_id)) . "','";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
        		}else{
              $this->error_number = 3;
              $this->error_description="Can't insert pooja ";
              return false;
              }
         }

	elseif($this->id > 0 ) {
			$strSQL = "UPDATE pooja SET name = '".addslashes(trim($this->name))."',";
			$strSQL .= "rate = '".addslashes(trim($this->rate))."',";
		 	$strSQL .= "status_id = '".addslashes(trim($this->status_id))."',";
			$strSQL .= " WHERE id = ".$this->id;
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                  return true;
           	     }else{
               	 $this->error_number = 3;
              	 $this->error_description="Can't update Pooja";
               	return false;
           		 }
    		}
  	}



function get_details()
{
	if($this->id >0){
		$strSQL = "SELECT id,name,rate,,status_id FROM pooja WHERE id = '".$this->id."'";
		$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		 if(mysql_num_rows($rsRES) > 0){
			$user 	= mysql_fetch_assoc($rsRES);
			$this->id 		= $user['id'];
			$this->name 	= $user['name'];
			$this->rate= $user['rate'];
			$this->status_id = $user['status_id'];
			return true;
			}else{
			return false;
			}
			}else{
			return false;
			}
}







}



?>