<!--
$(document).ready(function(){
$('select[name=listpooja]').change(function(){
        var pooja_id = $(this).val();
        if(pooja_id == -1)
        {
            $("#rate").val("");
        }
        else
        {
            var success_post = $.post('<?php echo $current_url ?>',
            {
              pooja:pooja_id,
            });
            success_post.done(function (rate) {
                  if(rate){
                    $("#rate").val(rate);
                  }
           });
        }
   
    });
});


-->