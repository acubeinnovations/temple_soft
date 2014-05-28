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

		var msg ="";
		var voucher_type = $("#lstmvoucher").val();
		var source = $("#lstsource").val();

		if(voucher_type == -1){
			msg += "Select voucher type<br>";
		}

		if($("#chk_hidden").prop("checked")){
			if($("#lstmodules").val() == -1){
				msg += "Module not selected<br>";
			}
			if($("#lstfromledger").val() == -1){
				msg += "Select From Ledger<br>";
			}
			if($("#lsttoledger").val() == -1){
				msg += "Select To Ledger<br>";
			}

		}else{
			if(source == -1){
				msg += "Select Source<br>";
			}else if(source == 1){
				if($("#lstledger").val() == null){
					msg += "Select default ledgers<br>";
				}
			}else if(source == 2){
				
			}
		}

		
		if(msg == ""){
			return true;
		}else{
			popup_alert(msg,false);
			return false;
		}
		
	});


	//series start number must be greater than 0
	$('input[name="txtseries"]').keyup(function(){

		if($(this).val() != ""){
			if($(this).val() <= 0){
				$(this).val('');
				alert("Enter Valid Number");
			}
		}
		

	});

	$("#title").mouseout(function(){
		$(this).hide();
	});


});


function showNumberSeries()
{
	var prefix = $('input[name="txtprefix"]').val();

	var sufix = $('input[name="txtsufix"]').val();

	var seperator = $('select[name="lstseperator"]').val();

	var start = $('input[name="txtseries"]').val();

	var size = $('input[name="txtprintsize"]').val();

	var number_series = "";

	var num_length = 0;

	var prepend_count = 0;

	if(start > 0){
	
		if(prefix.trim() != ""){
			number_series += prefix;
		}

		if(seperator.trim() != ""){
			number_series += seperator;
		}

		if(size > 0){
			num_length = start.length;
			prepend_count = size - num_length;
			while(prepend_count > 0){
				number_series += '0';
				prepend_count--;
			}
		}

		number_series += start;
		
		if(seperator.trim() != ""){
			number_series += seperator;
		}

		if(sufix.trim() != ""){
			number_series += sufix;
		}

		$("#title").html(number_series);
		$("#title").show();


	}else{
		alert("Enter valid series start");
	}

//	alert(number_series);
}