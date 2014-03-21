<!--
$(document).ready(function(){

	var nameObj	= $("input:text[name=txtname]");
	var ageObj 	= $("input:text[name=txtage]");
	var starObj = $("#liststar");

	var tblArray = [];
	
	$("#button-add").click(function(){

		var name	= nameObj.val();
		var age 	= ageObj.val();
		var star 	= $("#liststar option:selected").text();
		var star_id = starObj.val();

		
		

		if(name!='' && age!='' && star_id >0){
			var hiddenStr = name+'_'+age+'_'+star_id;
					
			$("#tbl-append").append('<tbody><tr><td>'+name+'<input type="hidden" name="hd_row[]" value="'+hiddenStr+'"></td><td>'+age+'<input type="hidden" name="hd_age[]" value="'+age+'"></td><td>'+star+'<input type="hidden" name="hd_star[]" value="'+star+'"></td><td></td></tr></tbody>');

			$("input:text[name=txtname]").val('');
			$("input:text[name=txtage]").val('');
			$("#liststar").val(-1);


		}
		$("input:text[name=txtname]").focus();
		

	});

	$("#txtage").keypress(function(evt){
		evt = (evt) ? evt : window.event;
	    var charCode = (evt.which) ? evt.which : evt.keyCode;
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	        return false;
	    }
	    return true;
	});






});


