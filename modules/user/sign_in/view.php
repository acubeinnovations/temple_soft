<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/login.php">Login</a>';?>
<br>
<fieldset>
    <legend>Login</legend> 
<div class="row" >
	<div class="medium-12 columns">
		<form  id="ajax-contact-form" target="_self" method="post" action="<?php echo $current_url?>" name="frmlogin">
		<div class="medium-12 columns ">
						<div class="medium-5 columns ">
							<label>User Name <small>*</small></label>
							<input name="loginname"  type="text" required class="text " id="loginname"  title=""  value="" placeholder="Enter your name" >
						 </div>
						<div class="medium-5 columns ">
					
						</div>
		</div>
		
		<div class="medium-12 columns ">
						<div class="medium-5 columns ">
							<label>Password <small>*</small></label>
							<input name="passwd"  type="password" required class="text " placeholder="Enter your password" id="passwd" >
						 </div>
						<div class="medium-5 columns ">
					
						</div>
		</div>
	
		<div class="medium-12 columns ">
						<div class="medium-5 columns ">
							<input  value="<?php echo $capSIGNIN; ?>" type="submit" name="submit" class="tiny success button" >
         					    <input name="h_id" value="" type="hidden"><input name="h_login" value="pass" type="hidden">
								<a href="forgot_password.php" class="button-link">Forgot Password?</a>
						 </div>
						<div class="medium-5 columns ">
					
						</div>
		</div>
		</form>
	</div>
</div>
</fieldset>	
	
