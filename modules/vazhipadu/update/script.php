<!--
$(document).ready(function(){
$('.listpooja').change(function(){
        var pooja_id = $(this).val();
        if(pooja_id == -1)
        {
            $(this.).next().val("");
        }
        else
        {
            var success_post = $.post('<?php echo $current_url ?>',
            {
              pooja:pooja_id,
            });
            success_post.done(function (rate) {
                  if(rate){
                    $(this.).next().val(rate);
                  }
           });
        }
   
    });
});


-->