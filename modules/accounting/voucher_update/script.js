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
	/*

	$("#frmvoucher").submit(function(){

		var message = "";
		var voucher_name = $("#txtname").val();
		var voucher_type = $("#lstmvoucher").val();

		if(isNull(voucher_name)){
			message += "Empty voucher name \n";
		}

		if(isInteger(voucher_type)){
			message += "Select voucher type \n";
		}

		if(message == ""){
			return true;
		}else{
			alert(message);
			return false;
		}
		
	});
*/

});