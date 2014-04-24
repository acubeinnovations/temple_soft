<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class MenuItem{

	var $connection ="";
	var $id  =  gINVALID;
	var $name ="";
	var $parent_id = gINVALID;
	var $link_url = "";
	var $status = "";
	var $deleted = NOT_DELETED;

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if ( $this->id == "" || $this->id == gINVALID) {
    		$strSQL= "INSERT INTO menu_item(name,parent_id,link_url,status,deleted) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->name)."','";
    		$strSQL.= mysql_real_escape_string($this->parent_id)."','";
    		$strSQL.= mysql_real_escape_string($this->link_url)."','";
    		$strSQL.= mysql_real_escape_string($this->status)."','";
			$strSQL.= mysql_real_escape_string($this->deleted)."')";
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->id = mysql_insert_id();
				$this->error_description="Successfully";
				return $this->id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->id > 0 ) {
    		$strSQL = "UPDATE menu_item SET ";
    		$strSQL .= " name = '".addslashes(trim($this->name))."',";
    		$strSQL .= " parent_id = '".addslashes(trim($this->parent_id))."',";
    		$strSQL .= " link_url = '".addslashes(trim($this->link_url))."',";
    		$strSQL .= " deleted = '".addslashes(trim($this->deleted))."',";
    		$strSQL .= " status = '".addslashes(trim($this->status))."'";
			$strSQL .= " WHERE id = ".$this->id;
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                return true;
           	}else{
				$this->error_number = 3;
				$this->error_description="Can't update ";
				return false;
           	}
    	}
    }

    function get_details()
	{
		if($this->id >0){
			$strSQL = "SELECT id,name,parent_id,link_url,status,deleted FROM menu_item WHERE id = '".$this->id."' and deleted = '".NOT_DELETED."'";
			mysql_query("SET NAMES utf8");
			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->id 			= $row['id'];
				$this->name 		= $row['name'];
				$this->parent_id 	= $row['parent_id'];
				$this->link_url 	= $row['link_url'];
				$this->status 		= $row['status'];
				$this->deleted 		= $row['deleted'];
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
		$menu_list = array();$i=0;
		$strSQL = "SELECT  id,name FROM menu_item WHERE deleted = '".NOT_DELETED."'";
		mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
				$menu_list[$i]["id"] =  $id;
				$menu_list[$i]["name"] = $name;
				$i++;
           	}
            return $menu_list;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list menu items";
			return false;
    	}
	}

	public function get_list_array_bylimit($start_record = 0,$max_records = 25){
		$menu_list = array();
		$i=0;
		$str_condition = "";
		$strSQL = "SELECT mn1.id,mn1.name,mn1.parent_id,mn1.link_url,mn1.status,mn2.name as parent_name FROM menu_item mn1 LEFT JOIN menu_item mn2 ON mn1.parent_id = mn2.id";
		$strSQL .= " WHERE mn1.deleted = '".NOT_DELETED."'";
		if($this->id!='' && $this->id!=gINVALID){
			$strSQL .= " AND mn1.id = '".addslashes(trim($this->id))."'";
		}
		if ($this->name!='') {
			$strSQL .= " AND mn1.name LIKE '%".addslashes(trim($this->name))."%'";
		}

		$strSQL .= " ORDER BY mn1.parent_id,mn1.id ASC";
		//echo $strSQL;
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
			while ( list ($id,$name,$parent_id,$link_url,$status,$parent_name) = mysql_fetch_row($rsRES) ){
				$menu_list[$i]["id"] =  $id;
				$menu_list[$i]["name"] = $name;
				$menu_list[$i]["parent_id"] = $parent_id;
				$menu_list[$i]["link_url"] = $link_url;
				$menu_list[$i]["status"] = $status;
				$menu_list[$i]["parent_name"] = $parent_name;
				$i++;
			}
			return $menu_list;
		} else {
			return false;
		}

	}

	public function validate()
	{
		$strSQL = "SELECT COUNT(*) AS count FROM menu_item WHERE deleted= '".NOT_DELETED."' AND name = '".$this->name."' AND link_url = '".$this->link_url."' AND parent_id = '".$this->parent_id."' AND id <> '".$this->id."'";
		//echo $strSQL;exit();
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		$row = mysql_fetch_assoc($rsRES);
		if($row['count'] >0){
			return false;
		}else{
			return true;
		}
	}

	public function delete()
    {
    	if ( ($this->id != "" || $this->id != gINVALID) && $this->id >0 ){
    		$strSQL = "UPDATE menu_item SET deleted = '".DELETED."' WHERE id = '".$this->id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="Menu Item not deleted";
				return false;
            }
    	}else{
    		$this->error_description="Invalid Menu Item";
			return false;
    	}
    }


}