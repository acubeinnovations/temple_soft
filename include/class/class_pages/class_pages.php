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