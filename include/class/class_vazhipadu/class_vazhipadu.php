<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}


Class Vazhipadu{

  var $vazhipadu_id = gINVALID;
  var $vazhipadu_rpt_number = '';
  var $vazhipadu_date = '';
  var $star_id = gINVALID;
  var $pooja_id = gINVALID;
  var $name = '';
  var $age="";
  var $quantity = 1;
  var $amount = '';
  var $deleted = NOT_DELETED;
  var $user_id = gINVALID;

  var $pooja_description = "";

  var $from_date = "";
  var $to_date = "";

  var $error = false;
  var $error_number=gINVALID;
  var $error_description="";
  var $total_records='';


  function update($dataArray = array())
  {

    if ( $this->vazhipadu_id == "" || $this->vazhipadu_id == gINVALID) {
      if($dataArray){
        $strSQL = "INSERT INTO vazhipadu(vazhipadu_rpt_number,vazhipadu_date,star_id,pooja_id,name,quantity,amount,deleted,user_id) VALUES";
        for($i=0; $i<count($dataArray); $i++)
        {
          $nameData = $dataArray[$i]['name'];
          $starData = $dataArray[$i]['star_id'];
          $quantityData = $dataArray[$i]['quantity'];

          $strSQL .= "('".addslashes(trim($this->vazhipadu_rpt_number))."',";
          $strSQL .= "'".date('Y-m-d',strtotime($this->vazhipadu_date))."',";
          $strSQL .= "'".addslashes(trim($starData))."',";
          $strSQL .= "'".addslashes(trim($this->pooja_id))."',";
          $strSQL .= "'".addslashes(trim($nameData))."',";          
          $strSQL .= "'".addslashes(trim($quantityData))."',";
          $strSQL .= "'".addslashes(trim($this->amount))."',";
          $strSQL .= "'".addslashes(trim($this->deleted))."',";
          $strSQL .= "'".addslashes(trim($this->user_id))."'),";
        }
      }else{
        $strSQL = "INSERT INTO vazhipadu(vazhipadu_rpt_number,vazhipadu_date,star_id,pooja_id,name,quantity,amount,deleted,user_id) VALUES";
        $strSQL .= "('".addslashes(trim($this->vazhipadu_rpt_number))."',";
        $strSQL .= "'".date('Y-m-d',strtotime($this->vazhipadu_date))."',";
        $strSQL .= "'".addslashes(trim($this->star_id))."',";
        $strSQL .= "'".addslashes(trim($this->pooja_id))."',";
        $strSQL .= "'".addslashes($this->name)."',";
        $strSQL .= "'".addslashes(trim($this->quantity))."',";
        $strSQL .= "'".addslashes(trim($this->amount))."',";
        $strSQL .= "'".addslashes(trim($this->deleted))."',";
        $strSQL .= "'".addslashes(trim($this->user_id))."'),";
      }
     // echo $strSQL;exit();
       mysql_query("SET NAMES utf8");
      $rsRES = mysql_query(substr($strSQL, 0,-1),$this->connection) or die ( mysql_error() . $strSQL );

      if ( mysql_affected_rows($this->connection) > 0 ) {
        $this->vazhipadu_id = mysql_insert_id();
        return $this->vazhipadu_id;
      }else{
        $this->error_number = 3;
        $this->error_description="Can't insert vazhipadu ";
        return false;
      }
  }

}
  
  public function getRptNumber($vazhipadu_id = gINVALID)
  {
    if($vazhipadu_id >0){
        $strSQL = "SELECT vazhipadu_rpt_number as rpt_number FROM vazhipadu WHERE vazhipadu_id = '".$vazhipadu_id."'";
         mysql_query("SET NAMES utf8");
        $rsRES  = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
        $row    = mysql_fetch_assoc($rsRES);
        if($row['rpt_number']){
          return $row['rpt_number'];
        }else{
           return false;
        }
    }else{
      return false;
    }
    
  }

 




  public function get_vazhipadu_details()
  {
      if($this->vazhipadu_rpt_number != ""){
        $strSQL =" SELECT v.vazhipadu_id,v.vazhipadu_date,v.vazhipadu_rpt_number,v.amount as rate,v.quantity,v.name AS name,v.age AS age,v.pooja_id,v.star_id,p.name AS pooja,s.name AS star FROM vazhipadu v";
        $strSQL .= " LEFT JOIN pooja p ON p.id = v.pooja_id";
        $strSQL .= " LEFT JOIN stars s ON s.id = v.star_id";
         $strSQL .=" WHERE v.deleted ='".NOT_DELETED."' AND v.vazhipadu_rpt_number = '".$this->vazhipadu_rpt_number."'";

         //echo $strSQL;exit();
          mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
          $vazhipadu = array();$i=0;
          $total_amount = 0;
          $total_quantity = 0;
          while($row = mysql_fetch_assoc($rsRES)){
            
            $this->vazhipadu_date    = date('d-m-Y',strtotime($row['vazhipadu_date']));
            $this->pooja_description = $row['pooja'];
            $this->pooja_id = $row['pooja_id'];
            $this->amount = $row['rate'];
            $this->vazhipadu_rpt_number = $row['vazhipadu_rpt_number'];

            $vazhipadu[$i]['vazhipadu_id']    = $row['vazhipadu_id'];
            $vazhipadu[$i]['name']            = $row['name'];
            $vazhipadu[$i]['age']             = $row['age'];
            $vazhipadu[$i]['star']            = $row['star'];
            $vazhipadu[$i]['star_id']            = $row['star_id'];
            $vazhipadu[$i]['rate']            = $row['rate'];
            $vazhipadu[$i]['quantity']        = $row['quantity'];
            $vazhipadu[$i]['amount']          = $row['quantity']*$row['rate'];
            $total_amount += $row['quantity']*$row['rate'];
            $total_quantity += $row['quantity'];
            $i++;
          }
          $variables = array(
                      'total_amount'=>$total_amount,
                      'total_quantity'=>$total_quantity
                      );

          return array($vazhipadu,$variables);
        }else{
          $this->error_description = "No Records found";
          return false;
        }
      }
  }

  function get_filter_array_by_limit($start_record = 0,$max_records = 25,$dataArray = array())
  {
    $vazhipadu = array();$i=0;
    $strSQL = "SELECT  v.vazhipadu_rpt_number,v.vazhipadu_date,v.amount,p.name as pooja_name,sum(quantity) as quantity FROM vazhipadu v";
    $strSQL .=" LEFT JOIN pooja p ON p.id=v.pooja_id ";
    $strSQL .= " WHERE v.deleted ='".NOT_DELETED."'";

    if($this->vazhipadu_date != ""){
      $strSQL .=" AND v.vazhipadu_date = '".date('Y-m-d',strtotime($this->vazhipadu_date))."'";
    }else if(isset($dataArray['from_date']) and isset($dataArray['to_date'])){
      $this->from_date = date('Y-m-d',strtotime($dataArray['from_date']));
      $this->to_date = date('Y-m-d',strtotime($dataArray['to_date']));
      $strSQL .=" AND (v.vazhipadu_date BETWEEN '".$this->from_date."' AND '".$this->to_date."')";
    }

    if($this->vazhipadu_rpt_number != ""){
      $strSQL .=" AND v.vazhipadu_rpt_number = '".mysql_real_escape_string($this->vazhipadu_rpt_number)."'";
    }

/*
    if($this->user_id > 0){
      $strSQL .= " AND v.user_id = '".$this->user_id."'";
    }
  */
  
    $strSQL .= " GROUP BY vazhipadu_rpt_number";
    $strSQL .= " ORDER BY vazhipadu_rpt_number DESC";
    //echo $strSQL;exit();
   
    $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
     mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

    if ( mysql_num_rows($rsRES) > 0 )
    {
      if (trim($this->total_records)!="" && $this->total_records > 0) {
      } else {
        $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
        $this->total_records = mysql_num_rows($all_rs);
      }

        while ( $row = mysql_fetch_assoc($rsRES) ){

          $strSQL_dtl = "SELECT v.name,v.star_id,s.name FROM vazhipadu v LEFT JOIN stars s ON s.id=v.star_id WHERE v.deleted = '".NOT_DELETED."' AND vazhipadu_rpt_number = '".$row['vazhipadu_rpt_number']."'";
           mysql_query("SET NAMES utf8");
           //echo  $strSQL_dtl;exit();
          $rsRES_dtl = mysql_query($strSQL_dtl,$this->connection) or die(mysql_error(). $strSQL_dtl );

          if ( mysql_num_rows($rsRES_dtl) > 0 )
          {
            $dtlArray = array();$j=0;
            while ( list($name,$star_id,$star) = mysql_fetch_row($rsRES_dtl) ){
              if($name!="" and $star_id >0){
                $dtlArray[$j]['name'] = $name;
                $dtlArray[$j]['star'] = $name;
                $j++;
              }
            }
            $vazhipadu[$i]["details"] = $dtlArray;
          }else{
            $vazhipadu[$i]["details"] = false;
          }

          $vazhipadu[$i]["vazhipadu_rpt_number"] = $row['vazhipadu_rpt_number'];
          $vazhipadu[$i]["vazhipadu_date"] = date('d-m-Y',strtotime($row['vazhipadu_date']));
          $vazhipadu[$i]["quantity"] = $row['quantity'];
          $vazhipadu[$i]["unit_rate"] = $row['amount'];
          $vazhipadu[$i]["amount"] = $row['amount']*$row['quantity'];
          $vazhipadu[$i]["pooja_name"] = $row['pooja_name'];
          $i++;
        } 
        return $vazhipadu;
      }else{    
        $this->error_number = 4;
        $this->error_description="Can't list vazhipadu";
        return false;
      }
  }

  function get_array_by_limit($start_record = 0,$max_records = 25,$dataArray = array())
  {
    $vazhipadu = array();$i=0;
    $strSQL = "SELECT v.user_id,v.vazhipadu_id,v.vazhipadu_rpt_number,v.vazhipadu_date,v.amount,v.quantity,v.name,s.name as star_name,p.name as pooja_name FROM vazhipadu v";
    $strSQL .=" LEFT JOIN pooja p ON p.id=v.pooja_id ";
    $strSQL .=" LEFT JOIN stars s ON s.id=v.star_id ";
    $strSQL .= " WHERE v.deleted ='".NOT_DELETED."'";
    if($this->from_date != "" and $this->to_date != ""){
      if($this->from_date == $this->to_date){
        $strSQL .=" AND (v.vazhipadu_date = '".date('Y-m-d',strtotime($this->from_date))."')";
      }else{
        $strSQL .=" AND (v.vazhipadu_date BETWEEN '".date('Y-m-d',strtotime($this->from_date))."' AND '".date('Y-m-d',strtotime($this->to_date))."')";
      }
    }

    if($this->user_id > 0){
      $strSQL .= " AND v.user_id = '".$this->user_id."'";
    }
    if($this->pooja_id > 0){
      $strSQL .= " AND v.pooja_id = '".$this->pooja_id."'";
    }

    
   // $strSQL .= " GROUP BY vazhipadu_rpt_number";
    $strSQL .= " ORDER BY vazhipadu_id DESC";
   //$strSQL .= " ORDER BY vazhipadu_rpt_number";
    //echo $strSQL;exit();
   
    $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
     mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

    if ( mysql_num_rows($rsRES) > 0 )
    {
      if (trim($this->total_records)!="" && $this->total_records > 0) {
      } else {
        $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
        $this->total_records = mysql_num_rows($all_rs);
      }

        while ( $row = mysql_fetch_assoc($rsRES) ){
          $vazhipadu[$i]["vazhipadu_id"] = $row['vazhipadu_id'];
          $vazhipadu[$i]["vazhipadu_rpt_number"] = $row['vazhipadu_rpt_number'];
          $vazhipadu[$i]["vazhipadu_date"] = date('d-m-Y',strtotime($row['vazhipadu_date']));
          $vazhipadu[$i]["unit_rate"] = $row['amount'];
          $vazhipadu[$i]["quantity"] = $row['quantity'];
          $vazhipadu[$i]["amount"] = $row['amount']*$row['quantity'];
          $vazhipadu[$i]["name"] = $row['name']; 
          $vazhipadu[$i]["pooja_name"] = $row['pooja_name'];
          $vazhipadu[$i]["star_name"] = $row['star_name'];  
	  $vazhipadu[$i]["user_id"] = $row['user_id'];        
          $i++;
        } 
        return $vazhipadu;
      }else{    
        $this->error_number = 4;
        $this->error_description="Can't list vazhipadu";
        return false;
      }
  }

  function get_all_array($dataArray = array())
  {
    $vazhipadu = array();$i=0;
	$grand_total = 0;
    $strSQL = "SELECT v.vazhipadu_id,v.vazhipadu_rpt_number,v.vazhipadu_date,v.quantity,v.amount,v.name,s.name as star_name,p.name as pooja_name FROM vazhipadu v";
    $strSQL .=" LEFT JOIN pooja p ON p.id=v.pooja_id ";
    $strSQL .=" LEFT JOIN stars s ON s.id=v.star_id ";
    $strSQL .= " WHERE v.deleted ='".NOT_DELETED."'";
    if($this->from_date != "" and $this->to_date != ""){
      if($this->from_date == $this->to_date){
        $strSQL .=" AND (v.vazhipadu_date = '".date('Y-m-d',strtotime($this->from_date))."')";
      }else{
        $strSQL .=" AND (v.vazhipadu_date BETWEEN '".date('Y-m-d',strtotime($this->from_date))."' AND '".date('Y-m-d',strtotime($this->to_date))."')";
      }
    }

    if($this->user_id > 0){
      $strSQL .= " AND v.user_id = '".$this->user_id."'";
    }
     if($this->pooja_id > 0){
      $strSQL .= " AND v.pooja_id = '".$this->pooja_id."'";
    }

    
   // $strSQL .= " GROUP BY vazhipadu_rpt_number";
    $strSQL .= " ORDER BY vazhipadu_rpt_number";
    //echo $strSQL;exit();
   
    mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);

    if ( mysql_num_rows($rsRES) > 0 )
    {
        while ( $row = mysql_fetch_assoc($rsRES) ){
          $vazhipadu[$i]["vazhipadu_id"] = $row['vazhipadu_id'];
          $vazhipadu[$i]["vazhipadu_rpt_number"] = $row['vazhipadu_rpt_number'];
          $vazhipadu[$i]["vazhipadu_date"] = date('d-m-Y',strtotime($row['vazhipadu_date']));
          $vazhipadu[$i]["unit_rate"] = $row['amount'];
          $vazhipadu[$i]["quantity"] = $row['quantity'];
          $vazhipadu[$i]["amount"] = $row['amount']*$row['quantity'];
          $vazhipadu[$i]["name"] = $row['name']; 
          $vazhipadu[$i]["pooja_name"] = $row['pooja_name'];
          $vazhipadu[$i]["star_name"] = $row['star_name'];
	  $grand_total += $vazhipadu[$i]["amount"];         
          $i++;
        } 
        return array($vazhipadu,$grand_total);
      }else{    
        $this->error_number = 4;
        $this->error_description="Can't list vazhipadu";
        return false;
      }
  }


  public function cancelVazhipadu()
  {
    if($this->vazhipadu_rpt_number != ''){
      $strSQL = "UPDATE vazhipadu SET deleted = '".DELETED."' WHERE vazhipadu_rpt_number = '".$this->vazhipadu_rpt_number."'";
      $rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
      if ( mysql_affected_rows($this->connection) > 0 ) {
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }


	//get userwise collection amount with date
	public function get_counter_wise_collection($data = array())
	{
		$resultArray = array();
		
		$strSQL = " SELECT SUM(V.quantity*V.amount) as amount,V.user_id,AM.date";
		$strSQL .=" FROM vazhipadu V";
		$strSQL .=" LEFT JOIN ( SELECT DISTINCT(voucher_number), date FROM account_master ) AM ON AM.voucher_number=V.vazhipadu_rpt_number ";
		$strSQL .= " WHERE V.deleted ='".NOT_DELETED."'";
		if(isset($data['from_date']) && isset($data['to_date'])){
			if(strtotime($data['from_date']) == strtotime($data['to_date'])){
				$strSQL .= " AND AM.date = '".date('Y-m-d',strtotime($data['from_date']))."'";
			}else{
				$strSQL .= " AND (AM.date BETWEEN '".date('Y-m-d',strtotime($data['from_date']))."' AND '".date('Y-m-d',strtotime($data['to_date']))."')";
			}
		}

		$strSQL .= " GROUP BY V.user_id,AM.date";

		//echo $strSQL;exit;
		
		$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
		if ( mysql_num_rows($rsRES) > 0 )
    		{
        		while ( $row = mysql_fetch_assoc($rsRES) ){
				$resultArray[] = $row;
			}
		}

		return $resultArray;
	}


	/*public function get_counter_wise_collection($date_list = array())
	{
		$resultArray = array();$i=0;//final result array
		$totals = array();//footer content

		$totals['date'] = "Totals";

		foreach($date_list as $date => $record){
			
			$strSQL = "SELECT V.user_id AS counter,SUM(V.quantity*V.amount) AS amount";
			$strSQL .= " FROM vazhipadu V, account_master AM";
			$strSQL .= " WHERE V.vazhipadu_rpt_number = AM.voucher_number";
			$strSQL .= " AND AM.date = '".date('Y-m-d',strtotime($date))."'";
			$strSQL .= " GROUP BY AM.date,V.user_id";

			echo $strSQL;exit;


			$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
			if ( mysql_num_rows($rsRES) > 0 )
			{
				$tr['date']=$date;
				$tot = 0;
				while ( $row = mysql_fetch_assoc($rsRES) ){
					
					$column_name = 'counter'.$row['counter'];
					$tr[$column_name] = number_format($row['amount'],2);
					$tot +=$row['amount'];

					if(isset($totals[$column_name])){
						$totals[$column_name] += $row['amount'];
					}
					else{
						$totals[$column_name] = 0;
						$totals[$column_name] += $row['amount'];
					}
				}
				if(isset($totals['account'])){
					$totals['account'] += $tot;
				}
				else{
					$totals['account'] = 0;
					$totals['account'] += $tot;
				}
				$tr['account'] = number_format($tot,2);
				
			}else{
				$tr['date']=$date;
				
			}
			$resultArray[] = $tr;

		}
		
		$totals_formatted = array();
		foreach($totals as $key=>$val)
		{
			
			if($key!= 'date')
				$totals_formatted[$key] = number_format($val,2);
			else
				$totals_formatted[$key] = $val;
		}
		
		
		return array($resultArray,$totals_formatted);

	}*/


  
}




?>
