
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
	var $ledger_sub_id = gINVALID;
	var $status_id ="";

	var $vazhipadu_date = CURRENT_DATE;

	var $from_date = "";
  	var $to_date = "";

  	var $voucher_id = "";

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';



    function update()
	{

		if ( $this->id == "" || $this->id == gINVALID) {
			$strSQL = "INSERT INTO pooja(name,rate,ledger_sub_id,status_id) VALUES ('";
			$strSQL .= addslashes(trim($this->name)) ."','";
			$strSQL .= addslashes(trim($this->rate)) . "','";
			$strSQL .= addslashes(trim($this->ledger_sub_id)) . "','";
			$strSQL .= addslashes(trim($this->status_id)) . "')";
 			mysql_query("SET NAMES utf8");
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
			 mysql_query("SET NAMES utf8");
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
		$strSQL = "SELECT id,name,rate,ledger_sub_id,status_id FROM pooja WHERE id = '".$this->id."'";
		 mysql_query("SET NAMES utf8");
		$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		 if(mysql_num_rows($rsRES) > 0){
			$row 	= mysql_fetch_assoc($rsRES);
			$this->id 		= $row['id'];
			$this->name 	= $row['name'];
			$this->rate= $row['rate'];
			$this->ledger_sub_id= $row['ledger_sub_id'];
			$this->status_id = $row['status_id'];
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
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
			{
			while ( list ($id,$name,$rate,$status_id) = mysql_fetch_row($rsRES) ){
				$pooja[$i]["id"] =  $id;
				$pooja[$i]["name"] = $name;
				$pooja[$i]["rate"] = $rate;
				$pooja[$i]["status_id"] = $status_id;
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
			$strSQL = "SELECT id,name,rate,status_id FROM pooja WHERE 1";
			if($this->status_id > 0){
				$strSQL .=" AND status_id = '".STATUS_ACTIVE."'";
			}
			mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 ){
				 while(list($id,$name,$rate,$status_id) = mysql_fetch_row($rsRES) ){
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
		mysql_query("SET NAMES utf8");
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

    public function get_vazhipadu_pooja_list($start_record = 0,$max_records = 25,$user_id = -1)
    {

    	$strSQL = "SELECT v.pooja_id,p.name,v.amount AS rate,v.vazhipadu_date,SUM(v.quantity) AS quantity FROM vazhipadu v";
    	$strSQL .= " LEFT JOIN pooja p ON p.id=v.pooja_id";
    	$strSQL .= " WHERE deleted = '".NOT_DELETED."'";
    	
    	 if($this->from_date != "" and $this->to_date != ""){
	      if($this->from_date == $this->to_date){
	        $strSQL .=" AND (v.vazhipadu_date = '".date('Y-m-d',strtotime($this->from_date))."')";
	      }else{
	        $strSQL .=" AND (v.vazhipadu_date BETWEEN '".date('Y-m-d',strtotime($this->from_date))."' AND '".date('Y-m-d',strtotime($this->to_date))."')";
	      }
	    }

	    if ($this->id > 0 ) {
			$strSQL .= " AND v.pooja_id = '".$this->id."'";
		}

	    if($user_id > 0){
	    	$strSQL .= " AND v.user_id = '".$user_id."'";
	    }

    	$strSQL .= " GROUP BY p.id,v.amount";
    	$strSQL .= " ORDER BY v.vazhipadu_id DESC";
    	$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
    	
    	 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
		$pooja = array();$i=0;
		$total_amount = 0;$total_quantity = 0;
        if ( mysql_num_rows($rsRES) > 0 ){
			if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
            	$this->total_records = mysql_num_rows($all_rs);
			}
			while ( list ($id,$name,$rate,$date,$quantity) = mysql_fetch_row($rsRES) ){
				$pooja[$i]["id"] =  $id;
				$pooja[$i]["name"] = $name;
				$pooja[$i]["rate"] = $rate;
				$pooja[$i]["quantity"] = $quantity;
				$pooja[$i]["amount"] = $rate*$quantity;
				$pooja[$i]["date"] = $date;	
				$total_amount += $pooja[$i]["amount"];
				$total_quantity += $quantity;		
				$i++;
			}

			return array($pooja,array('total_amount'=>$total_amount,'total_quantity'=>$total_quantity));
		} else {
  			return false;
        }
    }

    public function get_all_vazhipadu_pooja_list($user_id = -1)
    {

    	$strSQL = "SELECT v.pooja_id,p.name,v.amount AS rate,v.vazhipadu_date,SUM(v.quantity) AS quantity FROM vazhipadu v";
    	$strSQL .= " LEFT JOIN pooja p ON p.id=v.pooja_id";
    	$strSQL .= " WHERE deleted = '".NOT_DELETED."'";
    	
    	 if($this->from_date != "" and $this->to_date != ""){
	      if($this->from_date == $this->to_date){
	        $strSQL .=" AND (v.vazhipadu_date = '".date('Y-m-d',strtotime($this->from_date))."')";
	      }else{
	        $strSQL .=" AND (v.vazhipadu_date BETWEEN '".date('Y-m-d',strtotime($this->from_date))."' AND '".date('Y-m-d',strtotime($this->to_date))."')";
	      }
	    }

	    if ($this->id > 0 ) {
			$strSQL .= " AND v.pooja_id = '".$this->id."'";
		}

	    if($user_id > 0){
	    	$strSQL .= " AND v.user_id = '".$user_id."'";
	    }

    	$strSQL .= " GROUP BY p.id,v.amount";
    	//$strSQL .= " ORDER BY v.vazhipadu_id DESC";
		$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
		$pooja =array();$i=0;
		$total_amount = 0;$total_quantity = 0;
        if(mysql_num_rows($rsRES) > 0){
			while ( list ($id,$name,$rate,$date,$quantity) = mysql_fetch_row($rsRES) ){
				$pooja[$i]["id"] =  $id;
				$pooja[$i]["name"] = $name;
				$pooja[$i]["rate"] = $rate;
				$pooja[$i]["quantity"] = $quantity;
				$pooja[$i]["date"] = $date;
				$pooja[$i]["amount"] = $rate*$quantity;
				$total_amount += $rate*$quantity;
				$total_quantity += $quantity;	
				
				$i++;
			}
			return array($pooja,array('total_amount'=>$total_amount,'total_quantity'=>$total_quantity));
		} else {
  			return false;
        }
    }


    public function validate()
    {
    	if ( $this->id >0) {
    		$this->get_details();
    		return true;
    	}else{
	    	$strSQL = "SELECT * FROM pooja WHERE name = '".$this->name."'";
	    	$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
	    	if(mysql_num_rows($rsRES) > 0){
	    		$this->error_description = "Pooja already exists";
	    		return false;//pooja exist
	    	}else{
	    		return true;
	    	}
	    }

    }


//temporary function for insert ledger sub with all pooja
    /*
    function updateLedgerSubWithPooja()
    {
    	$poojas = $this->get_array();
    	//echo "<pre>";print_r($poojas);echo "</pre>";exit();
    	foreach ($poojas as $key => $pooja) {
    		$pooja_id = $pooja['id'];
    		$strSQL= "INSERT INTO ledger_sub(ledger_sub_name,ledger_id,parent_sub_ledger_id,fy_id,status,deleted) VALUES('";
    		$strSQL.= mysql_real_escape_string($pooja['name'])."','";
    		$strSQL.= mysql_real_escape_string(11)."','";
    		$strSQL.= mysql_real_escape_string(1)."','";
    		$strSQL.= mysql_real_escape_string(1)."','";
    		$strSQL.= mysql_real_escape_string(1)."','";
    		$strSQL.= mysql_real_escape_string(1)."')";
			//echo $strSQL;exit();
 			mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$ledger_sub_id = mysql_insert_id();
				$strSQL1 = "UPDATE pooja SET ledger_sub_id = '".addslashes(trim($ledger_sub_id))."'";
				$strSQL1 .= " WHERE id = ".$pooja_id;
			 	mysql_query("SET NAMES utf8");
				$rsRES1 = mysql_query($strSQL1,$this->connection) or die(mysql_error(). $strSQL1 );
			}
    	}
    }
    */

  public function get_pooja_collection_limit($data = array(),$start_record = 0,$max_records = 25)
  {

    $strSQL = "SELECT V.amount AS rate,V.pooja_id,SUM(V.amount) AS amount,sum(v.quantity) AS quantity,P.name AS pooja_name
FROM vazhipadu V
LEFT JOIN pooja P ON P.id = V.pooja_id
WHERE V.deleted ='".NOT_DELETED."' AND V.vazhipadu_rpt_number IN(SELECT voucher_number FROM account_master WHERE voucher_type_id = '".$this->voucher_id."' AND date = '".date('Y-m-d',strtotime($data['date']))."')";

    

    if(isset($data['user_id']) and $data['user_id'] > 0){
      $strSQL .= " AND V.user_id = '".$data['user_id']."'";
    }
    
    if(isset($data['pooja_id']) and $data['pooja_id'] > 0){
      $strSQL .= " AND V.pooja_id = '".$data['pooja_id']."'";
    }
    
    $strSQL .= " GROUP BY V.pooja_id,V.amount";

    //echo $strSQL;exit();
    $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
    mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

    //echo $strSQL_limit;
    $result = array();$i=0;
    if(mysql_num_rows($rsRES) > 0){
		if (trim($this->total_records)!="" && $this->total_records > 0) {
		} else {
			$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
			$this->total_records = mysql_num_rows($all_rs);
		}
		while ( $row = mysql_fetch_assoc($rsRES) ){
			$result[$i]['pooja_id'] = $row['pooja_id'];
			$result[$i]['pooja_name'] = $row['pooja_name'];
			$result[$i]['rate'] = $row['rate'];
			$result[$i]['quantity'] = $row['quantity'];
			$result[$i]['amount'] = $row['rate']*$row['quantity'];
			$i++;
		}
		return $result;
    }else{
      	$this->error_number = 4;
        $this->error_description="Can't list data";
        return false;
    }
    
  }

  public function get_pooja_collection($data = array(),$start_record = 0,$max_records = 25)
  {

  
	$strSQL = "SELECT V.amount AS rate,V.pooja_id,SUM(V.amount) AS amount,sum(v.quantity) AS quantity,P.name AS pooja_name
FROM vazhipadu V
LEFT JOIN pooja P ON P.id = V.pooja_id
WHERE V.deleted ='".NOT_DELETED."' AND V.vazhipadu_rpt_number IN(SELECT voucher_number FROM account_master WHERE voucher_type_id = '".$this->voucher_id."' AND date = '".date('Y-m-d',strtotime($data['date']))."')";

    

    if(isset($data['user_id']) and $data['user_id'] > 0){
      $strSQL .= " AND V.user_id = '".$data['user_id']."'";
    }
    
    if(isset($data['pooja_id']) and $data['pooja_id'] > 0){
      $strSQL .= " AND V.pooja_id = '".$data['pooja_id']."'";
    }
    
    $strSQL .= " GROUP BY V.pooja_id,V.amount";
 
	mysql_query("SET NAMES utf8");
	$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
	$this->total_records = mysql_num_rows($rsRES);
    
   // echo $strSQL;
    $result = array();$i=0;
    if(mysql_num_rows($rsRES) > 0){
      while ( $row = mysql_fetch_assoc($rsRES) ){ //echo "<pre>";print_r($row);echo "</pre>";exit();

        $result[$i]['pooja_id'] = $row['pooja_id'];
        $result[$i]['pooja_name'] = $row['pooja_name'];
        $result[$i]['rate'] = $row['rate'];
        $result[$i]['quantity'] = $row['quantity'];
        $result[$i]['amount'] = $row['rate']*$row['quantity'];
        $i++;
      }
   //  echo "<pre>";print_r($result);echo "</pre>";exit();
      return $result;

    }else{
      return false;
    }
    
  }







}



?>