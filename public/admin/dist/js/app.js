  
 $(function () {

        $(document).on('click', '#completepaymentclose', function (e) {
        e.preventDefault();
        var userid=$(this).data('userid');
        var amount=$(this).data('amount');
        var paymentrequestid=$(this).data('paymentrequestid');
        var token=$('meta[name="csrf-token"]').attr('content');
        $('#modal-accept').modal('show');
        $('.img-loader').removeClass('hidden');
      

         $(document).on('click', '#submitcompleterequest', function (e) {
             e.preventDefault();
             var remarks=$('#reference_payment').val();
             if(remarks=='')
             {
                $('#message').removeClass('hidden')
                return false;
             }
              $('#message').addClass('hidden')
               $.ajax({
                url: APP_URL + '/admin/complete/payment-request' , 
                data:{id:userid,amount:amount,payment_request_id:paymentrequestid,remarks:remarks,_token:token },
                type: "POST",
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
                        $('.overlay_alert').removeClass('hidden');
                        $('.overlay_alert').addClass('success');
                        $('.overlay_alert').html(data.success_message);
                        $('#modal-accept').modal('hide');
                        window.location.reload();
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
   });
    	
        $(document).on('click', '#rejectpaymentrequestbtn', function (e) {
        e.preventDefault();
        var userid=$(this).data('userid');
        var amount=$(this).data('amount');
        var paymentrequestid=$(this).data('paymentrequestid');
        var token=$('meta[name="csrf-token"]').attr('content');
        $('#modal-reject').modal('show');
        $('.img-loader').removeClass('hidden');
      

         $(document).on('click', '#submitrejectrequest', function (e) {
             e.preventDefault();
             var remarks=$('#reject_reason_text').val();
             if(remarks=='')
             {
                $('#message').removeClass('hidden')
                return false;
             }
              $('#message').addClass('hidden')
               $.ajax({
                url: APP_URL + '/admin/reject/payment-request' , 
                data:{id:userid,amount:amount,payment_request_id:paymentrequestid,remarks:remarks,_token:token },
                type: "POST",
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
                        $('.overlay_alert').removeClass('hidden');
                        $('.overlay_alert').addClass('success');
                        $('.overlay_alert').html(data.success_message);
                        $('#modal-reject').modal('hide');
                        window.location.reload();
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
       
       
   });


		$(document).on('click', '.viewipdetail', function (e) {
        e.preventDefault();
        var ipaddressdetailid = $(this).data('parentid');
        $('.img-loader').removeClass('hidden');
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
                    var text = i.referer_url;
                    if(text.length > 15) text = text.substring(0,15);
                    var redirectedtext = i.redirected_to;
                    if(redirectedtext.length > 15) redirectedtext = redirectedtext.substring(0,15);
                        var nhtml='<tr>'+
                                  '<td >'+i.id+'</td>'+
                                  '<td title="'+i.referer_url+'"><a href="'+i.referer_url+'">'+text+'</a></td>'+
                                  '<td title="'+i.redirected_to+'" >'+ redirectedtext +'</td>'+
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
      