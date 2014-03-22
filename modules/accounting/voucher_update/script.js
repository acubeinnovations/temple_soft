$(document).ready(function(){

	$("#div-dtls1").hide();
	$("#div-dtls2").hide();


	$("#lstsource").change(function(){
		var source =$(this).val();
		if(source == "1"){
			$("#div-dtls1").show();
			$("#div-dtls2").hide();
		}else if(source == "2"){
			$("#div-dtls1").hide();
			$("#div-dtls2").show();
		}else{
			$("#div-dtls1").hide();
			$("#div-dtls2").hide();
		}
	});

	$("#chk_hidden").click(function(){

		if($(this).prop("checked")){
			$("#div-settings").show();
			$("#v_ac_dtls").hide();
		}else{
			$("#div-settings").hide();
			$("#v_ac_dtls").show();
		}
	});
	

	$("#frmvoucher").submit(function(){

		var voucher_type = $("#lstmvoucher").val();
		var source = $("#lstsource").val();
		if(source == -1){
			
		}
		
	});


});