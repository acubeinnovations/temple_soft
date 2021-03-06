<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserSession {
    var $connection;
    var $id = gINVALID;
    var $username	= "" ;
    var $password	= "";
	var $first_name 	= "";
    var $last_name		= "";
    var $email			= "";
    var $address		= "";
    var $occupation 	= "";
    var $user_status_id	= "";

    var $user_type_id = "";



    var $error = false;
    var $error_number=gINVALID;
    var $error_description="";


    function __construct($username ='',$password = '',$connection = '')
    {
			$this->username =$username;
			$this->password =$password;
			$this->connection =$connection;

    }

    function login(){
          $strSQL = "SELECT U.* FROM users U WHERE U.username = '".mysql_real_escape_string($this->username);
          $strSQL .= "' AND U.password='".$this->password."' AND (U.user_status_id = '".USERSTATUS_ACTIVE."')";
		//echo $strSQL;exit();
          $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
          if ( mysql_num_rows($rsRES) > 0 ){

                $this->id = mysql_result($rsRES,0,'id');
                $this->username = mysql_result($rsRES,0,'username');
                $this->email = mysql_result($rsRES,0,'email');
                $this->first_name = mysql_result($rsRES,0,'first_name');
                $this->last_name = mysql_result($rsRES,0,'last_name');
                $this->user_status_id=mysql_result($rsRES,0,'user_status_id');
                $this->user_type_id = mysql_result($rsRES,0,'user_type_id');
                //user session values
                $_SESSION[SESSION_TITLE.'user_status_id'] = $this->user_status_id;
                $_SESSION[SESSION_TITLE.'userid'] = $this->id;
                $_SESSION[SESSION_TITLE.'name'] = $this->first_name." ".$this->last_name;
                $_SESSION[SESSION_TITLE.'username'] = $this->username;
                $_SESSION[SESSION_TITLE.'user_type'] = $this->user_type_id;

                //get current account settings
                $strSQL_ac = "SELECT ast.id,fm.fy_id,fm.fy_start AS fy_start_date,fm.fy_end AS fy_end_date,fm.status AS fy_status FROM account_settings ast LEFT JOIN fy_master fm ON fm.fy_id = ast.current_fy_id WHERE ast.id = '1' ";
                $rsRES_ac = mysql_query($strSQL_ac,$this->connection) or die(mysql_error(). $strSQL );
                if(mysql_num_rows($rsRES_ac) > 0){
                    $row_ac = mysql_fetch_assoc($rsRES_ac);
                    $_SESSION[SESSION_TITLE.'fy_start_date'] = date('d-m-Y',strtotime($row_ac['fy_start_date']));
                    $_SESSION[SESSION_TITLE.'fy_end_date'] = date('d-m-Y',strtotime($row_ac['fy_end_date']));
                    $_SESSION[SESSION_TITLE.'fy_status'] = $row_ac['fy_status'];
                    $_SESSION[SESSION_TITLE.'current_fy_id'] = $row_ac['fy_id'];
                }

                //get current user pages
                $strSQL_pg = "";
                if(isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] == ADMINISTRATOR){
                    $strSQL_pg .= "SELECT utp.page_id,pg.name FROM user_type_page utp LEFT JOIN pages pg ON utp.page_id = pg.id  WHERE utp.user_type_id = '".$_SESSION[SESSION_TITLE.'user_type']."'"; 
		
		
                }else if(isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0){
                    $strSQL_pg .= "SELECT up.page_id,pg.name FROM user_page up LEFT JOIN pages pg ON up.page_id = pg.id WHERE up.user_id = '".$_SESSION[SESSION_TITLE.'userid']."'";
                }

                if(trim($strSQL_pg) != ""){
                    $rsRES_pg = mysql_query($strSQL_pg,$this->connection) or die ( mysql_error() . $strSQL_pg );
                     if(mysql_num_rows($rsRES_pg) > 0){
                        $pages = array();                       
                        while($row_pg = mysql_fetch_assoc($rsRES_pg)){
                            //array_push($pages, $row_pg['page_id']);
                            $id= $row_pg['page_id'];
                            $name= $row_pg['name'];
                            $pages[$id] = $name;
                        }
                       
                        $_SESSION[SESSION_TITLE.'pages'] = $pages;
                     }
                }
               

		      return true;
          }
          else{
                $this->error_description = "Login Failed";
                return false;
          }
    }


    function check_login(){
		if ( isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0 && $this->id == $_SESSION[SESSION_TITLE.'userid'] && $_SESSION[SESSION_TITLE.'user_type'] == $this->user_type_id ) {
			return true;
		}else{
			return false;
		}

	}

    function logout(){
        $chk = session_destroy();
        if ($chk == true){
            return true;
        }
        else{
                return false;
        }
    }

    function updatePageSession()
    {
        //get current user pages
        $strSQL_pg = "";
        if(isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] == ADMINISTRATOR){
            $strSQL_pg .= "SELECT utp.page_id,pg.name FROM user_type_page utp LEFT JOIN pages pg ON utp.page_id = pg.id  WHERE utp.user_type_id = '".$_SESSION[SESSION_TITLE.'user_type']."'"; 
        }else if(isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0){
            $strSQL_pg .= "SELECT up.page_id,pg.name FROM user_page up LEFT JOIN pages pg ON up.page_id = pg.id WHERE up.user_id = '".$_SESSION[SESSION_TITLE.'userid']."'";
        }
       // echo $strSQL_pg;exit();

        if(trim($strSQL_pg) != ""){
            $rsRES_pg = mysql_query($strSQL_pg,$this->connection) or die ( mysql_error() . $strSQL_pg );
             if(mysql_num_rows($rsRES_pg) > 0){
                $pages = array();                       
                while($row_pg = mysql_fetch_assoc($rsRES_pg)){
                    //array_push($pages, $row_pg['page_id']);
                    $id= $row_pg['page_id'];
                    $name= $row_pg['name'];
                    $pages[$id] = $name;
                }
               
                $_SESSION[SESSION_TITLE.'pages'] = $pages;
             }
        }
    }


}

?>
