<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Pages{

	var $connection ="";
	var $id  =  gINVALID;
	var $name = "";
	var $route = "";
	var $params = "";
	
	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update(){
    	if ( $this->id == "" || $this->id == gINVALID) {
    		$strSQL = "INSERT INTO pages(name,route,params) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->name)."','";
    		$strSQL.= mysql_real_escape_string($this->route)."','";
			$strSQL.= mysql_real_escape_string($this->params)."')";
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
    	}else if($this->id > 0){
    		$strSQL = "UPDATE pages SET ";
    		$strSQL .= " name = '".addslashes(trim($this->name))."',";
    		$strSQL .= " route = '".addslashes(trim($this->route))."',";
    		$strSQL .= " params = '".addslashes(trim($this->params))."'";
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

    public function getPageId(){
    	$strSQL = "SELECT id FROM pages WHERE name='".$this->name."' AND route = '".$this->route."' AND params = '".$this->params."'";
    	//echo $strSQL;exit();
    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    	if(mysql_num_rows($rsRES) > 0){
    		$row = mysql_fetch_assoc($rsRES);
    		$this->id = $row['id'];
    		return $row['id'];
    	}else{
    		return false;
    	}

    }

    function get_list_array()
	{
		$pages = array();$i=0;
		$strSQL = "SELECT  id,name,route,params FROM pages WHERE 1";
		mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name,$route,$params) = mysql_fetch_row($rsRES) ){
				$pages[$i]["id"] =  $id;
				$pages[$i]["name"] = $name;
				$pages[$i]["route"] = $route;
				$pages[$i]["params"] = $params;
				$pages[$i]["nameStr"] = (trim($route)!="")?$route."/":"";
				$pages[$i]["nameStr"] .= $name.".php";				
				$pages[$i]["nameStr"] .= (trim($params)!="")?"?".$params:"";
				$i++;
           	}
            return $pages;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list pages";
			return false;
    	}
	}


}