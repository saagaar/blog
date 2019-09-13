  
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
                    $('#time_zone').html(data.time_zone);
                    $('#redirected_to').html(data.details.redirected_to);
                    $('#visit_date').html(data.details.visit_date);
                    $('#country').html(data.country);
                    $('#country_code').html(data.country_code);
                    $('#city').html(data.city);
                    $('#region').html(data.region);
                    
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

$(document).on('click', '.logdetail', function (e) {
        e.preventDefault();
        var ipaddressdetailid = $(this).data('parentid');
        $('.img-loader').removeClass('hidden');
        $.ajax({
            url: APP_URL + '/' + ipaddressdetailid, 
            type: "GET",
            dataType: 'json',
            success: function (data) 
            {
                // console.log(data.logdetails);
                // JSON.stringify(data);
                if (data.error_message)
                {
                    $('.overlay_alert').removeClass('hidden');
                    $('.overlay_alert').addClass('success');
                    $('.overlay_alert').html(data.error_message);
                } else
                {
                 $('#ajaxModel').modal('show');
                 $('#listOfIpAddressDetail').html('');

                 data.logdetails.forEach(function(i,v){
                        var nhtml='<tr>'+
                                  '<td ></td>'+
                                  '<td >'+i.redirected_to+'</td>'+
                                  '<td >'+i.referer_url+'</td>'+
                                  '<td ></td>'+
                                  '<td>asd</td>'+
                                  '<td ></td>'+
                                  '</tr>';
                        $('#listOfIpAddressDetail').append(nhtml);
                    // $('#id').html(i.id);
                    // console.log(i);
                    // $('#ip_address').html(i.ip_address);
                    // $('#referer_url').html();
                    // $('#user_agent').html(i.user_agent);
                    // $('#redirected_to').html(i.redirected_to);
                    // $('#visit_date').html(i.visit_date);
                 })
                    // $('#pop-display_name').val(data[0].display_name);
                    
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
      