<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}


function printTree($dataArray = array())
{
	echo '<ul type="disc">';
	foreach($dataArray as $data)
	{
		$id = $data['id'];
		$url = $data['page'];
		echo '<li>';
		if($url != ''){
			echo '<input type="checkbox" name="chk_menu[]" value="'.$id.'"/> ';
		}
		echo $data['name'];
		if(isset($data['sibblings'])){
			echo printTree($data['sibblings']);
		}
		
		echo '</li>';
	}
	echo '</ul>';
}


?>