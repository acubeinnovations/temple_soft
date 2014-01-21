<!--
$(document).ready(function(){
	alert('hi');
	var listcount=$('#count').val();
	$('addnew').click(function(){
	listcount++;

$('<div class="row"><div class="medium-2 columns"><label for="name"> Name</label><input type="text" name="name" id="" value=""/></div><div class="row"><div class="medium-2 columns"><label for="listpooja"> Select pooja</label><?php echo populate_list_array("listpooja", $array_vazhipadu, 'id','name',$add_vazhipadu->pooja_id,$disable=false,true,'class=ratepooja');?></div><div class="row"><div class="medium-2 columns"><label for="rate">rate</label><input type="text" name="rate" id="rate" value="<?php echo $add_vazhipadu->rate;?>" readonly/></div><div class="row"><div class="medium-2 columns"><label for="liststar"> Select Star</label><?php echo populate_list_array("liststar", $array_star, 'id','name',$add_vazhipadu->star_id,$disable=false);?></div><div class="row"><div class="medium-2 columns"><label for="quantity">quantity</label><input type="text" name="quantity" id=""value=""/></div><div class="row"><div class="medium-2 columns"><label for="name"> Date</label><input class="mydatepicker"name="date" id="" value=""/></div></div>').animate({ opacity: 'show' }, 'slow').appendTo("listpooja");
});
});



-->