$(document).ready(function(){

	//remove user pages from pages
	$( "#lstuserpages option" ).each(function() {
		$("#lstpage option[value='"+$(this).val()+"']").remove();
	});

	$("#lstuser").change(function(){
		 $("#dv-pages").html('<label for="menu">Pages<small>required</small>'+pages);
		var user_id = $(this).val();
		$.ajax({
				type:'GET',
				url:CURRENT_URL,
				data:{ajax_user_id:user_id},
				contentType: "application/json",
				dataType: "json",
				success: function (json) {
					var lstuserpages = '<select id="lstuserpages" name="lstuserpages[]" multiple>';
					if(json['pages']){
						$.each(json['pages'], function(id, name){
		               		lstuserpages += '<option value="'+id+'" >'+name+'</option>';
		               		$("#lstpage option[value='"+id+"']").remove();
		            	});		            	
		            }
		            lstuserpages += '</select>';
		            $("#dv-user-pages").html('<label for="menu">User Pages<small>required</small>'+lstuserpages);
				}				
		});
	});

	//add option ti user pages
	$("#button-add").click(function(){

		$( "#lstpage option:selected" ).each(function() {
			$('<option>').val($(this).val()).text($(this).text()).appendTo('#lstuserpages');
			$("#lstpage option[value='"+$(this).val()+"']").remove();
		});

		
	});

	//remove options from user pages
	$("#button-remove").click(function(){
		$( "#lstuserpages option:selected" ).each(function() {
			$('<option>').val($(this).val()).text($(this).text()).appendTo('#lstpage');
			$("#lstuserpages option[value='"+$(this).val()+"']").remove();
		});
	});

	//select all user pages
	$("#frmmenu").submit(function(){
		$('#lstuserpages option').attr('selected',true);
	});
});