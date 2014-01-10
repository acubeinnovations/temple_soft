
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
			$strSQL = "INSERT INTO pooja(name,rate,status_id) VALUES ('";
			$strSQL .= addslashes(trim($this->name)) ."','";
			$strSQL .= addslashes(trim($this->rate)) . "','";
			$strSQL .= addslashes(trim($this->status_id)) . "')";
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
			$strSQL .= "status_id = '".addslashes(trim($this->status_id))."'";
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
		$strSQL = "SELECT id,name,rate,status_id FROM pooja WHERE id = '".$this->id."'";
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




function get_list_array()
	{
		$pooja = array();$i=0;
		$strSQL = "SELECT  id,name,rate,status_id FROM pooja";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
			{
			while ( list ($id,$name,$rate,$status_id) = mysql_fetch_row($rsRES) ){
				$items[$i]["id"] =  $id;
				$items[$i]["name"] = $name;
				$items[$i]["rate"] = $rate;
				$items[$i]["status_id"] = $status_id;
				$i++;
           	}
            return $pooja;
       		}else{
			$this->error_number = 4;
			$this->error_description="Can't list pooja";
			return false;
    	}
}



function get_array()

	{
        	$pooja = array();
			$i=0;
			$strSQL = "SELECT id,name,rate,status_id FROM pooja";
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 )
				 {while(list($id,$name,$rate,$status_id) = mysql_fetch_row($rsRES) ){
						$pooja[$i]['id'] =  $id;
						$pooja[$i]['name'] =  $name;
						$pooja[$i]['rate'] =  $rate;
						$pooja[$i]['status_id'] =  $status_id;

						$i++;
           		 		}
            		return $pooja;
       			}else{
					$this->error_number = 4;
					$this->error_description="Can't list pooja";
					return false;
    				}
		}		



 function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $pooja = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,name,rate,status_id FROM pooja WHERE 1";
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
			while ( list ($id,$name,$rate,$status_id) = mysql_fetch_row($rsRES) ){
					$pooja[$i]["id"] =  $id;
					$pooja[$i]["name"] = $name;
					$pooja[$i]["rate"] = $rate;
					$pooja[$i]["status_id"] = $status_id;
					$i++;}
					return $pooja;
    				} else {
      			 return false;
        	}
        
    }










}



?>