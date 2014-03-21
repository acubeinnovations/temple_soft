<!--

var CURRENT_URL = '<?php echo $current_url ?>';
$(document).ready(function(){
  

  $('#listpooja').change(function(){
        var pooja_id = $(this).val();
        if(pooja_id == -1)
        {
            $("#txtamount").val('');
        }
        else
        {
            var success_post = $.post('<?php echo $current_url ?>',
            {
              pooja:pooja_id,
            });
            success_post.done(function(rate) {
              if(rate){
                $("#txtamount").val(rate);
              }
           });
        }
   
    });
});






-->