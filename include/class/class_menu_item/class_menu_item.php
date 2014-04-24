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

	public function validate()
	{
		$strSQL = "SELECT COUNT(*) AS count FROM menu_item WHERE deleted= '".NOT_DELETED."' name = '".$this->name."' AND link_url = '".$this->link_url."' AND parent_id = '".$this->parent_id."' AND id <> '".$this->id."'";
		//echo $strSQL;exit();
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		$row = mysql_fetch_assoc($rsRES);
		if($row['count'] >0){
			return false;
		}else{
			return true;
		}
	}


}