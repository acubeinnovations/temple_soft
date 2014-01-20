<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}


$add_vazhipadu=new Vazhipadu($myconnection);
$add_vazhipadu->connection=$myconnection;

$add_pooja=new Pooja($myconnection);
$add_pooja->connection=$myconnection;

$array_vazhipadu=$add_pooja->get_array();
if($array_vazhipadu==false){
	$array_vazhipadu=array();
}

$add_star=new Stars($myconnection);
$add_star->connection=$myconnection;
$array_star=$add_star->get_array();

if(isset($_POST['submit'])){
	$add_vazhipadu->name=$_POST['name'];
	$add_vazhipadu->pooja_id=$_POST['listpooja'];
	$add_vazhipadu->rate=$_POST['rate'];
	echo $add_vazhipadu->rate;
	$add_vazhipadu->quantity=$_POST['quantity'];
	//$add_vazhipadu->date=$_POST['date'];
	$add_vazhipadu->update();
	header("Location:vazhipadu.php");
	exit();
}

if(isset($_POST['pooja']) and $_POST['pooja'] > 0)
{
   $add_pooja->id=$_POST['pooja'];
    $add_pooja->get_details();
        print  $add_pooja->rate;
        exit();
       
  
}

?>