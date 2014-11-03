<!--

var CURRENT_URL = '<?php echo $current_url ?>';
$(document).ready(function(){

 	var continue_vazhipadu = getUrlParameter('cn');
    var rpt = getUrlParameter('pr');
	if(continue_vazhipadu == 1){
		CURRENT_URL += "?cn="+rpt;
	}
	<?php if($vazhipadu_details){?>
		print();
		window.location = CURRENT_URL;
		
		
	<?php }?>

	<?php if($txtquantity){?>
		$("#chk_qty").prop('checked',true);
		$("#txtqty").attr('disabled',false);
		$("#dv-dtls").hide();
	<?php }?>

});


function getUrlParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
    
}




-->