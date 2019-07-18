$(function(){
            $('.permission-table').find('input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
              });

              //Enable check and uncheck all functionality
              $(".checkbox-toggle").click(function () {
                var clicks = $(this).data('clicks');
                if (clicks) {
                  //Uncheck all checkboxes
                  $(this).parents('.timeline-item').find(".permission-table input[type='checkbox']").iCheck("uncheck");
                  $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                } else {
                  //Check all checkboxes
                  $(this).parents('.timeline-item').find(".permission-table input[type='checkbox']").iCheck("check");
                  $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                }
                $(this).data("clicks", !clicks);
              });

                $(".checkbox-toggle-all").click(function () {
                var clicks = $(this).data('clicks');
                if (clicks) {
                  //Uncheck all checkboxes
                  $(".permission-table input[type='checkbox']").iCheck("uncheck");
                  $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                } else {
                  //Check all checkboxes
                  $(".permission-table input[type='checkbox']").iCheck("check");
                  $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                }
                $(this).data("clicks", !clicks);
              });

            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
              checkboxClass: 'icheckbox_minimal-blue',
              radioClass   : 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
              checkboxClass: 'icheckbox_minimal-red',
              radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
              checkboxClass: 'icheckbox_flat-green',
              radioClass   : 'iradio_flat-green'
            })
  })