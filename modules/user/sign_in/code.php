<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$usersession = new UserSession();
$usersession->connection = $myconnection;
if(isset($_SESSION[SESSION_TITLE.'userid']) and isset($_SESSION[SESSION_TITLE.'user_type'])){
	$usersession->id = $_SESSION[SESSION_TITLE.'userid'];
	$usersession->user_type_id = $_SESSION[SESSION_TITLE.'user_type'];
	if($usersession->check_login()){
		header('Location:dashboard.php');
		exit();
	}
}






$login_error = "";
if(isset($_POST['submit']) and $_POST['submit'] == $capSIGNIN)
{
	if ( $_POST['loginname'] == ""  || $_POST['passwd'] == ""){
		$login_error = "Invalid Username or password!";
	}
	
	
	if ( $login_error == "" )
	{
		$username = trim($_POST['loginname']);
		$password = md5(trim($_POST['passwd']));
		$usersession->username = $username;
		$usersession->password = $password;
		$chk = $usersession->login();
		if ( $chk == true ){
			header('Location:dashboard.php');
			exit();
		}
		else{
			$_SESSION[SESSION_TITLE.'flash'] = $usersession->error_description;
			header( "Location:".$current_url);
			exit();
		}

	} else{
		$_SESSION[SESSION_TITLE.'flash'] = $login_error;
		header( "Location:".$current_url);
		exit();
	}
	
}



?>
