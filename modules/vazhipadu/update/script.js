<!--
$(document).ready(function(){

	var nameObj	= $("input:text[name=txtname]");
	var starObj = $("#liststar");

	var tblArray = [];
	
	$("#button-add").click(function(){

		var name	= nameObj.val();
		var star 	= $("#liststar option:selected").text();
		var star_id = starObj.val();
	

		if(name!=''  && star_id >0){
			var hiddenStr = name+'_'+star_id;
					
			$("#tbl-append").append('<tbody><tr><td>'+name+'<input type="hidden" name="hd_row[]" value="'+hiddenStr+'"></td><td>'+star+'<input type="hidden" name="hd_star[]" value="'+star+'"></td><td></td></tr></tbody>');

			$("input:text[name=txtname]").val('');
			$("#liststar").val(-1);

		}else{
			popup_alert("Enter Name and Star",false);
		}
		
		$("input:text[name=txtname]").focus();
		

	});



});


