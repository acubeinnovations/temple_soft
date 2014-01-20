<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
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
		  $usersession = new UserSession($username,$password,$myconnection);
		  $chk = $usersession->login();
		  if ( $chk == true ){
			
			  header('Location:dashboard.php');
				exit();
		  } else{
			 $login_error .= "Invalid Login name/Password.";
			$_SESSION[SESSION_TITLE.'flash'] = $login_error;
		 }
	
}else{
 	$_SESSION[SESSION_TITLE.'flash'] = $login_error;
		  
	}
	
	
}



?>
