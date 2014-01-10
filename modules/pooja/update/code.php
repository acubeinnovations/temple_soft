<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$add_pooja=new Pooja($myconnection);
$add_pooja->connection=$myconnection;

if(isset($_GET['id'])){
$add_pooja->id=$_GET['id'];
$add_pooja->get_details();
}

$array_add_pooja=$add_pooja->get_list_array();

$msg="";
if(isset($_POST['submit'])){
	$add_pooja->h_id=$_POST['h_id'];
	$add_pooja->name=$_POST['name'];
	$add_pooja->rate=$_POST['rate'];
	$add_pooja->status_id=$_POST['listpooja'];
	$add_pooja->update();
	header("Location:poojas.php");

}else{
	$msg="Invalid";
}





?>