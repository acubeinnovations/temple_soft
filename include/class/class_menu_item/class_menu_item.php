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
	var $page_id = "";
	var $status = "";
	var $sort_order = "";

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if ( $this->id == "" || $this->id == gINVALID) {
    		$strSQL= "INSERT INTO menu_item(name,parent_id,page_id,status,sort_order) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->name)."','";
    		$strSQL.= mysql_real_escape_string($this->parent_id)."','";
    		$strSQL.= mysql_real_escape_string($this->page_id)."','";
    		$strSQL.= mysql_real_escape_string($this->status)."','";
			$strSQL.= mysql_real_escape_string($this->sort_order)."')";
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
    		$strSQL .= " page_id = '".addslashes(trim($this->page_id))."',";
    		$strSQL .= " sort_order = '".addslashes(trim($this->sort_order))."',";
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

    public function update_with_page_id()
    {
        if($this->page_id > 0 ) {
            $strSQL = "UPDATE menu_item SET ";
            $strSQL .= " name = '".addslashes(trim($this->name))."'";
            $strSQL .= " WHERE page_id = ".$this->page_id;
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
			$strSQL = "SELECT id,name,parent_id,page_id,status,sort_order FROM menu_item WHERE id = '".$this->id."' and status = '".STATUS_ACTIVE."'";
			mysql_query("SET NAMES utf8");
			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->id 			= $row['id'];
				$this->name 		= $row['name'];
				$this->parent_id 	= $row['parent_id'];
				$this->page_id 	= $row['page_id'];
				$this->status 		= $row['status'];
				$this->sort_order 		= $row['sort_order'];
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
		$strSQL = "SELECT  id,name FROM menu_item WHERE status = '".STATUS_ACTIVE."'";
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
		$strSQL = "SELECT mn1.id,mn1.name,mn1.parent_id,mn1.page_id,mn1.status,mn2.name as parent_name,pg.name as page_name,pg.route as page_route,pg.params as page_params FROM menu_item mn1";
		$strSQL .= " LEFT JOIN menu_item mn2 ON mn1.parent_id = mn2.id";
		$strSQL .= " LEFT JOIN pages pg ON pg.id = mn1.page_id";
		$strSQL .= " WHERE mn1.status = '".STATUS_ACTIVE."'";
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
			while ( list ($id,$name,$parent_id,$page_id,$status,$parent_name,$page_name,$page_route,$page_params) = mysql_fetch_row($rsRES) ){
				$menu_list[$i]["id"] =  $id;
				$menu_list[$i]["name"] = $name;
				$menu_list[$i]["parent_id"] = $parent_id;
				$menu_list[$i]["page_id"] = $page_id;
				$menu_list[$i]["status"] = $status;
				$menu_list[$i]["parent_name"] = $parent_name;
				$menu_list[$i]["pageStr"] = (trim($page_route)!="")?$page_route."/":"";
				$menu_list[$i]["pageStr"] .= $page_name;	
				$menu_list[$i]["pageStr"] .= (trim($page_params)!="")?"?".$page_params:"";

				$i++;
			}
			return $menu_list;
		} else {
			return false;
		}

	}

	public function validate()
	{
		$strSQL = "SELECT COUNT(*) AS count FROM menu_item WHERE status= '".STATUS_ACTIVE."' AND name = '".$this->name."' AND page_id = '".$this->page_id."' AND parent_id = '".$this->parent_id."' AND id <> '".$this->id."'";
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
    		$strSQL = "UPDATE menu_item SET status = '".STATUS_INACTIVE."' WHERE id = '".$this->id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="Menu Item not sort_order";
				return false;
            }
    	}else{
    		$this->error_description="Invalid Menu Item";
			return false;
    	}
    }

    public function getParentMenu()
    {
    	$result = array();$i=0;
    	$strSQL = "SELECT mn.id,mn.name,mn.parent_id,mn.page_id,mn.status,mn.sort_order,pg.name as page_name,pg.route as page_route,pg.params as page_params FROM menu_item mn";
    	$strSQL .= " LEFT JOIN pages pg ON pg.id = mn.page_id";
    	$strSQL .=" WHERE mn.status = '".STATUS_ACTIVE."' AND mn.parent_id = '".gINVALID."'";
    	$strSQL .= " ORDER BY mn.sort_order ASC";
    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    	if(mysql_num_rows($rsRES) > 0){
    		while($row = mysql_fetch_assoc($rsRES)){
    			$result[$i]['id'] = $row['id'];
    			$result[$i]['name'] = $row['name'];
    			$result[$i]['parent_id'] = $row['parent_id'];
    			$result[$i]['page_id'] = $row['page_id'];
    			$result[$i]['status'] = $row['status'];
    			$result[$i]['sort_order'] = $row['sort_order'];
    			$result[$i]['page_name'] 	= $row['page_name'];
    			$result[$i]['page_route'] 	= $row['page_route'];
    			$result[$i]['page_params'] 	= $row['page_params'];
    			$page 						= "";
    			//$page 	    				.= (trim($row['page_route']) != "")?$row['page_route']."/":"";
    			$page 	    				.= (trim($row['page_name']) != "")?$row['page_name'].".php":"";
    			$page 	    				.= (trim($row['page_params']) != "")?"?".$row['page_params']:"";
    			$result[$i]['page']			= $page;
    			$i++;
    		}
    		return $result;
    	}else{
    		
    		$this->error_description = "can't list data" ;
    		return false;
    	}

    }

    public function getSibblings($id)
    {
    	$result = array();$i=0;
    	$strSQL = "SELECT mn.id,mn.name,mn.parent_id,mn.page_id,mn.status,mn.sort_order,pg.name as page_name,pg.route as page_route,pg.params as page_params FROM menu_item mn";
    	$strSQL .= " LEFT JOIN pages pg ON pg.id = mn.page_id";
    	$strSQL .= " WHERE mn.status = '".STATUS_ACTIVE."' AND mn.parent_id = '".$id."'";
    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    	if(mysql_num_rows($rsRES) > 0){
    		while($row = mysql_fetch_assoc($rsRES)){
    			$result[$i]['id'] 			= $row['id'];
    			$result[$i]['name'] 		= $row['name'];
    			$result[$i]['parent_id'] 	= $row['parent_id'];
    			$result[$i]['page_id'] 		= $row['page_id'];
    			$result[$i]['status'] 		= $row['status'];
    			$result[$i]['sort_order'] 	= $row['sort_order'];
    			$result[$i]['page_name'] 	= $row['page_name'];
    			$result[$i]['page_route'] 	= $row['page_route'];
    			$result[$i]['page_params'] 	= $row['page_params'];
    			$page 						= "";
    			//$page 	    				.= (trim($row['page_route']) != "")?$row['page_route']."/":"";
    			$page 	    				.= (trim($row['page_name']) != "")?$row['page_name'].".php":"";
    			$page 	    				.= (trim($row['page_params']) != "")?"?".$row['page_params']:"";
    			$result[$i]['page']			= $page;

    			$next = $this->getSibblings($result[$i]['id']);
    			if($next){
    				$result[$i]['sibblings'] = $next;
    			}
    			$i++;
    		}
    		return $result;
    	}else{
    		
    		$this->error_description = "can't list data" ;
    		return false;
    	}
    }

    public function getMenuTreeArray()
    {
    	$menu_list = array();$i=0;
    	$parents = $this->getParentMenu();
    	if($parents){
    		foreach($parents as $parent){
    			$menu_list[$i]['id'] = $parent['id'];
    			$menu_list[$i]['name'] = $parent['name'];
    			$menu_list[$i]['page_id'] = $parent['page_id'];
    			$menu_list[$i]['parent_id'] = $parent['parent_id'];
    			$menu_list[$i]['status'] = $parent['status'];
    			$menu_list[$i]['sort_order'] = $parent['sort_order'];
    			$menu_list[$i]['page'] = $parent['page'];
    			$sibblings = $this->getSibblings($parent['id']);
    			if($sibblings){
    				$menu_list[$i]['sibblings'] = $sibblings;
    			}
    			$i++;
    		}
    		return $menu_list;
    	}else{
    		$this->error_description = "Can't list data";
    		return false;
    	}
    	
    }

    //recursive function for filter menu_list with user page_id array(from session variable pages)
    public function filterMenuTreeArray($menu_list,$pages)
    {
    	if(is_array($menu_list) and is_array($pages)){
    		foreach($menu_list as $key=>$menu){
    			if($menu['page_id'] > 0){
    				//echo $menu['page_id'];exit();
    				
    				if(array_key_exists($menu['page_id'], $pages)){
    					//do nothing
    				}else{
    					//remove menu item
    					unset($menu_list[$key]);	
    				}

    			}else{
    				if(isset($menu['sibblings'])){
    					$this->filterMenuTreeArray($menu['sibblings'],$pages);
    				}else{
    					unset($menu_list[$key]);
    				}
    			}
    		}
    		return $menu_list;
    	}else{
    		return false;
    	}
    }

    function get_filtered_row($filterArray = array())
    {
        $strSQL = "SELECT id,name,parent_id,page_id,status,sort_order FROM menu_item WHERE status = '".STATUS_ACTIVE."'";
        if(isset($filterArray['page_id'])){
            $strSQL .= " AND page_id = '".$filterArray['page_id']."'";
        }
        mysql_query("SET NAMES utf8");
        $rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        $result = array();
        if(mysql_num_rows($rsRES) > 0){
            $row    = mysql_fetch_assoc($rsRES);
            $result['id']           = $row['id'];
            $result['name']         = $row['name'];
            $result['parent_id']   = $row['parent_id'];
            $result['page_id']  = $row['page_id'];
            $result['status']       = $row['status'];
            $result['sort_order']       = $row['sort_order'];
            return $result;
        }else{
            return false;
        }
    }



    


}