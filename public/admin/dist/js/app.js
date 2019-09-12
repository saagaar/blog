  
 $(function () {

    	

		$(document).on('click', '.viewipdetail', function (e) {
        e.preventDefault();
        var ipaddressdetailid = $(this).data('parentid');
        $('.img-loader').removeClass('hidden');
        // alert(APP_URL + '/' + ipaddressdetailid);
        $.ajax({
            url: APP_URL + '/' + ipaddressdetailid, 

            type: "GET",
            dataType: 'json',
            success: function (data) 
            {
                // JSON.stringify(data);
                if (data.error_message)
                {
                    $('.overlay_alert').removeClass('hidden');
                    $('.overlay_alert').addClass('success');
                    $('.overlay_alert').html(data.error_message);
                } else
                {
       			 $('#IpAddressDetail').modal('show');

                    // $('#pop-display_name').val(data[0].display_name);
                    $('#ip_address').html(data.ip_address);
                    $('#referer_url').html(data.referer_url);
                    $('#user_agent').html(data.details.user_agent);
                    // $('#device').html(data.device);
                    $('#redirected_to').html(data.details.redirected_to);
                    $('#continent').html(data.continent);
                    $('#country').html(data.country);
                    $('#country_code').html(data.country_code);
                    $('#city').html(data.city);
                    $('#state').html(data.state);
                    
                    // $('#add-edit-product').modal('show');
                }
                $('.img-loader').addClass('hidden');
                setTimeout(function () {
                    $('.overlay_alert').addClass('hidden');
                    $('.overlay_alert').removeClass('error');
                    $('.overlay_alert').removeClass('success');
                }, 5000);
                
            }
        });
    })
    CKEDITOR.replace('contenteditor');

    //bootstrap WYSIHTML5 - text editor
  })
      