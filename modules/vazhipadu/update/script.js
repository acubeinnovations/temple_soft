
$(document).ready(function(){
	var clone_row=$('#default_row').clone();
	$('#addnew').click(function(){
		clone_row.appendTo('#load').show('slow');
        
 		});
 });

