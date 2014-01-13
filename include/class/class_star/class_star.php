<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

Class Star{

var $id=gINVALID;
var $name="";
var $status_id=gINVALID;

var $error = false;
var $error_number=gINVALID;
var $error_description="";
var $total_records='';




function update()
		{

			if ( $this->id == "" || $this->id == gINVALID) {
			$strSQL = "INSERT INTO star(name,status_id) VALUES ('";
			$strSQL .= addslashes(trim($this->name)) ."','";
			$strSQL .= addslashes(trim($this->status_id)) . "')";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

       if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
        		  }else{
              $this->error_number = 3;
              $this->error_description="Can't insert star ";
              return false;
              }
         }

	elseif($this->id > 0 ) {
			$strSQL = "UPDATE star SET name = '".addslashes(trim($this->name))."',";
			$strSQL .= "status_id = '".addslashes(trim($this->status_id))."'";
			$strSQL .= " WHERE id = ".$this->id;
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

        if ( mysql_affected_rows($this->connection) >= 0 ) {
                 return true;
           	     }else{
               	 $this->error_number = 3;
              	 $this->error_description="Can't update star";
               	return false;
           		 }
    		  }
  }



function get_list_array()
     {
    $star = array();$i=0;
    $strSQL = "SELECT  id,name,status_id FROM star";
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    if ( mysql_num_rows($rsRES) > 0 )
        {
      while ( list ($id,$name,$status_id) = mysql_fetch_row($rsRES) ){
        $star[$i]["id"] =  $id;
        $star[$i]["name"] = $name;
        $star[$i]["status_id"] = $status_id;
        $i++;
          } return $star;
            }else{    
      $this->error_number = 4;
      $this->error_description="Can't list star";
      return false;
      }
}




    function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $star = array();
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id,name,status_id FROM star WHERE 1";

        if($this->id!='' && $this->id!=gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
         }

        if ($this->name!='') {
        $strSQL .= " AND name LIKE '%".addslashes(trim($this->name))."%'";
        }


     $strSQL .= " ORDER BY id";
     $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
     $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

    if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
     if (trim($this->total_records)!="" && $this->total_records > 0) {
          } else {
             $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
             $this->total_records = mysql_num_rows($all_rs);
          }
      while ( list ($id,$name,$status_id) = mysql_fetch_row($rsRES) ){
          $star[$i]["id"] =  $id;
          $star[$i]["name"] = $name;
          $star[$i]["status_id"] = $status_id;
          $i++;
         }return $star;
          } else {
          return false;
       } 
  }
        
    



    function get_details()
  {
    if($this->id >0){
    $strSQL = "SELECT id,name,status_id FROM star WHERE id = '".$this->id."'";
    $rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
     if(mysql_num_rows($rsRES) > 0){
      $user   = mysql_fetch_assoc($rsRES);
      $this->id     = $user['id'];
      $this->name   = $user['name'];
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