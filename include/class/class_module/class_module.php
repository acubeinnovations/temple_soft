<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Module{

	var $connection ="";
	var $id  =  gINVALID;
	var $name ="";

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    function get_details()
	{
		if($this->id >0){
			$strSQL = "SELECT id,name FROM module WHERE id = '".$this->id."'";
			mysql_query("SET NAMES utf8");
			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->id 		= $row['id'];
				$this->name 	= $row['name'];
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
		$modules = array();$i=0;
		$strSQL = "SELECT  id,name FROM module";
		mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
				$modules[$i]["id"] =  $id;
				$modules[$i]["name"] = $name;
				$i++;
           	}
            return $modules;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list modules";
			return false;
    	}
	}


}