$(document).ready(function(){

	if($("#lstmenu").val() > 0){
		$("#lstsort").attr('disabled',true);
	}else{
		$("#lstsort").attr('disabled',false);
	}

	$("#lstmenu").change(function(){
		var parent_menu = $(this).val();
		if(parent_menu > 0){
			$("#lstsort").attr('disabled',true);
		}else{
			$("#lstsort").attr('disabled',false);
		}
	});
});