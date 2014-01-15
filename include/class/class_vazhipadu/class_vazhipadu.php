<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}


Class Vazhipadu{

var $id=gINVALID;
var $bill_item_id=gINVALID;
var $name="";
var $star_id=gINVALID;
var $pooja_id=gINVALID;
var $rate="";
var $quantity="";
var $date="";

var $error = false;
var $error_number=gINVALID;
var $error_description="";
var $total_records='';


function update()
		{

			if ( $this->id == "" || $this->id == gINVALID) {
			$strSQL = "INSERT INTO vazhipadu(name,star_id,pooja_id,rate,quantity) VALUES ('";
		//	$strSQL .= addslashes(trim($this->bill_item_id)) ."','";
			$strSQL .= addslashes(trim($this->name)) ."','";
			$strSQL .= addslashes(trim($this->star_id)) ."','";
			$strSQL .= addslashes(trim($this->pooja_id)) ."','";
			//$strSQL .= addslashes(trim($this->rate)) ."','";
			$strSQL .= addslashes(trim($this->quantity)) ."','";
			//$strSQL .= addslashes(trim($this->date)) ."','";
			$strSQL .= addslashes(trim($this->rate)) . "')";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

       if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
        		  }else{
              $this->error_number = 3;
              $this->error_description="Can't insert vazhipadu ";
              return false;
              }
         }

	elseif($this->id > 0 ) {
			$strSQL = "UPDATE vazhpadu SET name ='".addslashes(trim($this->name))."',"; 
		//	$strSQL .= "name =  '".addslashes(trim($this->bill_item_id))."',";
			$strSQL .= "star_id = '".addslashes(trim($this->star_id))."',";
			$strSQL .= "pooja_id = '".addslashes(trim($this->pooja_id))."',";
			$strSQL .= "quantity = '".addslashes(trim($this->quantity))."',";
			//$strSQL .= "date = '".addslashes(trim($this->date))."',";
			$strSQL .= "rate = '".addslashes(trim($this->rate))."'";
			$strSQL .= " WHERE id = ".$this->id;
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

        if ( mysql_affected_rows($this->connection) >= 0 ) {
                 return true;
           	     }else{
               	 $this->error_number = 3;
              	 $this->error_description="Can't update Vazhipadu";
               	return false;
           		 }
    		  }
  }


  function get_list_array()
     {
    $vazhipadu = array();$i=0;
    echo $strSQL = "SELECT  id,bill_item_id,name,star_id,pooja_id,rate,quantity FROM vazhipadu";
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    if ( mysql_num_rows($rsRES) > 0 )
        {
      while ( list ($id,$bill_item_id,$name,$star_id,$pooja_id,$rate,$quantity) = mysql_fetch_row($rsRES) ){
        $vazhipadu[$i]["id"] =  $id;
        $vazhipadu[$i]["bill_item_id"] = $bill_item_id;
		    $vazhipadu[$i]["name"] = $name;
        $vazhipadu[$i]["star_id"] = $star_id;
        $vazhipadu[$i]["pooja_id"] = $pooja_id;
        $vazhipadu[$i]["rate"] = $rate;
        $vazhipadu[$i]["quantity"] = $quantity;
        $i++;
          } return $vazhipadu;
            }else{    
      $this->error_number = 4;
      $this->error_description="Can't list vazhipadu";
      return false;
      }
}









}




?>
