<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pooja=new Pooja($myconnection);
$pooja->connection=$myconnection;

if(isset($_GET['id'])){
	$pooja->id=$_GET['id'];
	$pooja->get_details();
}


if(isset($_POST['submit'])){
	//validation 
	$errorMSG = "";
	if(trim($_POST['name']) == ""){
		$errorMSG .= "Pooja name required ";
	}
	if(trim($_POST['rate']) == ""){
		$errorMSG .= "Pooja rate required";
	}elseif(!filter_var($_POST['rate'], FILTER_VALIDATE_FLOAT)){
		$errorMSG .= "Invalid rate";
	}


	if($errorMSG == ""){
		$pooja->h_id=$_POST['h_id'];
		$pooja->name=$_POST['name'];

		if($pooja->validate()){
			$pooja->rate=$_POST['rate'];
			$pooja->status_id=$_POST['listpooja'];
			$pooja->update();
			$_SESSION[SESSION_TITLE.'flash'] = "Pooja added successfully";
			header("Location:poojas.php");
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $pooja->error_description;
	        header( "Location:".$current_url);
	        exit();
		}
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url);
        exit();
	}
	

}





?>