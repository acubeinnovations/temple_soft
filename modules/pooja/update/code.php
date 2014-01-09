<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}


$add_pooja=new Pooja($myconnection);
$add_pooja->connection=$myconnection;

$msg="";
if(isset($_POST['submit'])){
	echo "hi";
	$add_pooja->status_id=$_POST['status_id'];
	$add_pooja->name=$_POST['name'];
	$add_pooja->rate=$_POST['rate'];
	$add_pooja->update();

}else{
	$msg="Invalid";
}




?>