<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class LedgerTrans{

	var $connection ="";
	var $current_fy_id = gINVALID;
    	var $default_capital = gINVALID;


	public function __construct($connection)
    	{
	    	$strSQL = "SELECT * FROM account_settings WHERE id = '1'";
	    	$rsRES = mysql_query($strSQL,$connection) or die(mysql_error(). $strSQL );
	    	if(mysql_num_rows($rsRES) > 0){
	    		$row = mysql_fetch_assoc($rsRES);
	    		$this->current_fy_id =$row['current_fy_id'];
	    		$this->default_capital =$row['default_capital'];
	    	}else{
	    		header("Location:ac_account_settings.php");exit();
	    	}
    	}

	public function getLedgerTransaction()
	{
		$ledgers = $this->get_list_sub_array();
		return $ledgers;
	}


	//get sub ledger list of current financial year
	public function get_list_sub_array()
	{
		$ledgers = array();$i=0;
		$strSQL = "SELECT
			  	ledger.ledger_sub_id,
				ledger.ledger_sub_name,
				master_sub.ledger_sub_name as parent,
				master.ledger_name as master,
				master_sub.ledger_sub_id as parent_id,
				master.ledger_id as master_id
			FROM ledger_sub ledger"; 
		$strSQL .= " LEFT JOIN ledger_sub master_sub ON master_sub.ledger_sub_id = ledger.parent_sub_ledger_id";
		$strSQL .= " LEFT JOIN ledger_master master ON master.ledger_id = ledger.ledger_id";
		$strSQL .= " WHERE ledger.deleted = '".NOT_DELETED."' AND ledger.status = '".STATUS_ACTIVE."'";
		$strSQL .= " AND ledger.ledger_sub_id IN(SELECT ledger_sub_id FROM fy_ledger_sub WHERE fy_id = '".$this->current_fy_id."')";
		$strSQL .= " ORDER BY ledger.parent_sub_ledger_id,ledger.ledger_id";
		
		mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name,$parent,$master,$parent_id,$master_id) = mysql_fetch_row($rsRES) ){
				$ledgers[$i]["id"] 		=  $id;
				$ledgers[$i]["name"] 		= $name;
				$ledgers[$i]["parent_id"] 	=  $parent_id;
				$ledgers[$i]["parent"] 		= $parent;
				$ledgers[$i]["master_id"] 	=  $master_id;
				$ledgers[$i]["master"] 		= $master;
				$ledgers[$i]["debit"] 	= number_format(0,2);
				$ledgers[$i]["credit"] 	= number_format(0,2);
				$i++;
		}
	    return $ledgers;
	}else{
			$this->error_number = 4;
			$this->error_description="Can't list Ledgers";
			return false;
	}
	}
}
?>
