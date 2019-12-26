  
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

                    $('#ip_address').html(data.ip_address);
                    $('#region_code').html(data.region_code);
                    $('#time_zone').html(data.time_zone);
                    $('#latitude').html(data.latitude);
                    $('#isp').html(data.isp);
                    $('#country').html(data.country);
                    $('#country_code').html(data.country_code);
                    $('#city').html(data.city);
                    $('#region').html(data.region);
                    $('#flagurl').html(data.flagurl);
                    $('#currencysymbol').html(data.currencysymbol);
                    $('#currency').html(data.currency);
                    $('#callingcode').html(data.callingcode);
                    $('#countrycapital').html(data.countrycapital);
                    $('#longitude').html(data.longitude);
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
                 // console.log(data);
                 data.visitordetails.forEach(function(i,v){
                        var nhtml='<tr>'+
                                  '<td >'+i.id+'</td>'+
                                  '<td >'+i.referer_url+'</td>'+
                                  '<td >'+i.redirected_to+'</td>'+
                                  '<td>'+i.user_agent+'</td>'+
                                  '<td>'+i.visit_date+'</td>'+
                                  '</tr>';
                        $('#listOfIpAddressDetail').append(nhtml);
                 })
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
      