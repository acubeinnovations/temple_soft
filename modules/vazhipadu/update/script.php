<!--
$(document).ready(function(){
  

  $('.ratepooja').change(function(){
        var pooja_id = $(this).val();
        var list = $(this);

        if(pooja_id == -1)
        {
            $(this).next().val("");
        }
        else
        {
            var success_post = $.post('<?php echo $current_url ?>',
            {
             
              pooja:pooja_id,

            });
            success_post.done(function(rate) {
                  if(rate){
                  $("#rate").val(rate);
                  }
           });
        }
   
    });
});






-->