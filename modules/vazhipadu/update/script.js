<!--




$(document).ready(function(){


	var key_code = [48,49,50,51,52,53,54,55,56,57];
	
   // $('#listpooja').focus();
    
    
   /* $('#advance').focus();
    var e = $.event('keypress');
    e.which = 0; // TAB
    $(this).trigger(e);
    */
    setTimeout(function(){
            $('#listpooja').focus();
    }, 1);



	var nameObj	= $("input:text[name=txtname]");
	var starObj = $("#liststar");
    var qtyObj = $("input:text[name=txtquantity]");//row quantity

	var tblArray = [];
	
	$("#button-add").click(function(){

		var name	= nameObj.val();
		var star_id = starObj.val();
        if(qtyObj.val() > 0){
            var quantity = qtyObj.val();
        }else{
            var quantity = 1;
        }
		var star 	= '-';
		if(star_id > 0){
			star 	= $("#liststar option:selected").text();
		}
	
		if(name!=''){

			var hiddenStr = name+'_'+star_id+'_'+quantity;
			
			$("#tbl-append").append('<tbody><tr class="new_rows"><td>'+name+'<input type="hidden" class="hide-rows" name="hd_row[]" value="'+hiddenStr+'"></td><td>'+star+'<input type="hidden" name="hd_star[]" value="'+star+'"></td><td>'+quantity+'<input type="hidden" name="hd_star[]" value="'+quantity+'"></td><td></td></tr></tbody>');
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
		//$("table .new_rows").remove();
        window.location='vazhipadu.php';
	});

    //continue - form submission with same values(date and rpt are changed)
    $("#button-continue").click(function(){
        $("#hd_continue").val(1);
       $("#btn-submit").trigger('click');
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
               
               if(star == 0){

               }else{
                 $(this).val(star);
               }
               
               
                if($(this).val() == null){
                    $(this).val(-1);
                }
            	star = 0;
            }
            else{
            	var val = key_code.indexOf(e.which);
            	star += val.toString();

            }
                
        });

    });

    /*

    //shortcut for pooja select (number+tab)
    $("#listpooja").focus(function(){
    	var pooja ='';
    	$(this).keypress(function(e){  
            if(e.which == 0){

                if(pooja == 0){

                }else{
                    $(this).val(pooja);
                }
            	
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
*/
//shortcut for pooja select (number+tab)
    $("#listpooja").focus(function(){
        var pooja ='';
        $(this).keypress(function(e){  
            if(e.which == 0){

                if(pooja == 0){
                }else{
                    $(this).val(pooja);
                    postPooja(pooja);
                }
                if($(this).val() == null){
                    $(this).val(-1);
                }
                
                pooja = 0;
            }else{
                var val = key_code.indexOf(e.which); 
                pooja += val.toString();
                $('#listpooja').val(pooja);
                
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
{//alert(pooja_id);
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
