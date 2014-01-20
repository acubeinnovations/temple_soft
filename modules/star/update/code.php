<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}

$add_star=new Stars($myconnection);
$add_star->connection=$myconnection;

if(isset($_GET['id'])){
	$add_star->id=$_GET['id'];
	$add_star->get_details();
}
if(isset($_POST['submit'])){
	$add_star->name=$_POST['name'];
	$add_star->status_id=$_POST['liststar'];
	$add_star->update();
	header("Location:stars.php");
	exit();
}


?>