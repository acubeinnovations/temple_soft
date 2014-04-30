<!--
$(document).ready(function(){

	var key_code = [48,49,50,51,52,53,54,55,56,57];
	$('#listpooja').focus();
	

	var nameObj	= $("input:text[name=txtname]");
	var starObj = $("#liststar");

	var tblArray = [];
	
	$("#button-add").click(function(){

		var name	= nameObj.val();
		var star_id = starObj.val();
		var star 	= '-';
		if(star_id > 0){
			star 	= $("#liststar option:selected").text();
		}
	
		if(name!=''){

			var hiddenStr = name+'_'+star_id;
			
			$("#tbl-append").append('<tbody><tr class="new_rows"><td>'+name+'<input type="hidden" class="hide-rows" name="hd_row[]" value="'+hiddenStr+'"></td><td>'+star+'<input type="hidden" name="hd_star[]" value="'+star+'"></td><td></td></tr></tbody>');
			var row = $('.hide-rows').length;
			if(row == 4){
				$(this).hide();
			}

			$("input:text[name=txtname]").val('');
			$("#liststar").val(-1);

		}else{
			popup_alert("Enter Name",false);
		}
		
		$("input:text[name=txtname]").focus();
		

	});

	//remove generated rows on click cancel
	$("#button-cancel").click(function(){
		$("table .new_rows").remove();
	});


	$('#listpooja').change(function(){
        var pooja_id = $(this).val();
        if(pooja_id == -1)
        {
            $("#txtamount").val('');
        }
        else
        {
        	postPooja(pooja_id);
        }
    });

    
	//shortcut for star select (number+tab)
    $("#liststar").focus(function(){
    	var star ='';
    	$(this).keypress(function(e){  
            if(e.which == 0){
            	$(this).val(star);
            	if($(this).val() == null){
            		$(this).val(-1);
            	}
            	star = 0;
            }else{
            	var val = key_code.indexOf(e.which); 
            	star += val.toString();
            }
                
        });

    });

    //shortcut for pooja select (number+tab)
    $("#listpooja").focus(function(){
    	var pooja ='';
    	$(this).keypress(function(e){  
            if(e.which == 0){
            	$(this).val(pooja);
            	if($(this).val() == null){
            		$(this).val(-1);
            	}
            	
            	pooja = 0;
            }else{
            	var val = key_code.indexOf(e.which); 
            	pooja += val.toString();
            	postPooja(val);
            }
                
        });

    });

   

    if($("#chk_qty").prop('checked') == true){
		$("#txtqty").attr('disabled',false);
		$("#dv-dtls").hide();
	}else{
		$("#txtqty").attr('disabled',true);
		$("#dv-dtls").show();
	}
 


    $("#chk_qty").click(function(){
    	if($(this).prop('checked') == true){
    		$("#txtqty").attr('disabled',false);
    		$("#dv-dtls").hide();
    	}else{
    		$("#txtqty").attr('disabled',true);
    		$("#dv-dtls").show();
    	}
    });




});

function postPooja(pooja_id)
{
	$.ajax({
		type:'GET',
		url:CURRENT_URL,
		data:{pooja:pooja_id},
		contentType: "application/json",
		dataType: "json",
		success: function (json) {
			if(json['rate']){
				$("#txtamount").val(json['rate']);
            }
            if(json['ledger']){
            	$("#hd_ledger_id").val(json['ledger']);
            }
		}				
	});
}

	

