<!DOCTYPE html>
<html lang="en" xmlns="https://thebloggersclub.com/" xmlns:v="urn:the-bloggersclubs-com:vml" xmlns:o="urn:the-bloggersclub-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .x-gmail-data-detectors,    /* Gmail */
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            text-decoration: none !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }
        webversion a:hover{color:#ffffff !important;}

        /*Social Media Added*/ /*Design and Develop by: Bikash Bhandari (bikash.433@gmail.com)*/
        a.facebook, a.twitter, a.linkedin, a.google, a.youtube{display:inline-block !important; position:relative !important; min-height:28px !important; min-width:28px !important; 
        overflow:hidden !important; -webkit-transition: 0.5s linear !important; -moz-transition: 0.5s linear !important; -ms-transition: 0.5s linear; transition: 0.5s linear !important; margin:0px 5px !important;}
        
        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            .email-container {
                min-width: 414px !important;
            }
        }
        .button-td{
            border-radius: 5px;
            background: #01b875; border: 1px solid #00a63f; font-family: sans-serif; font-size: 14px; text-align: center; text-decoration: none; display: block; border-radius: 1px; font-weight: bold; padding:5px 15px;color: #ffffff
        }
    </style>
    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

    /* What it does: Hover styles for buttons */
    .button-td,
    .button-a {
        transition: all 100ms ease-in;
    }
    .button-td:hover,
    .button-a:hover {
        background: #4cb748 !important;
        border-color: #00a63f !important;
    }

    /* Media Queries */
    @media screen and (max-width: 600px) {

        /* What it does: Adjust typography on small screens to improve readability */
        .email-container p {
            font-size: 17px !important;
        }

    }

    </style>
    <!-- Progressive Enhancements : END -->

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

</head>
<body width="100%" style="margin: 0; mso-line-height-rule: exactly; background:rgba(0, 0, 0, 0.94);">
    <center style="width: 100%; background: rgba(255, 255, 255); text-align: left;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!--
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
            2. MSO tags for Desktop Windows Outlook enforce a 600px width.
        -->
        <div style="max-width: 600px; margin: auto;" class="email-container">
            <!--[if mso]>
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
            <tr>
            <td>
            <![endif]-->

            <!-- Email Header : BEGIN -->
            <table role="presentation" cellspacing="0" cellpadding="0" 
            border="0" align="center" width="100%" style="max-width: 600px; background:url(https://thebloggersclub.com/frontend/images/elements/white-pattern.png); border-bottom: 1px solid #dbdbdb;">
                <tr>
                    <td style="padding: 2px 0; text-align: center">
                       <a href="{{config('settings.url')}}" target="_blank" title="{{config('settings.site_name')}}"> <img src="{{config('settings.url')}}/uploads/sitesettings-images/{{config('settings.image')}}" width="205" height="72" alt="thebloggersclub.com" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 100%; color: #4cb748;"></a>
                    </td>
                </tr>
            </table>
            <!-- Email Header : END -->

            <!-- Email Body : BEGIN -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">

                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        {!! $body !!}
                        @if($data)
                            <tr>
                                <td style="padding: 0px 40px 15px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;">
                                    <!-- Button : BEGIN -->
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="1" align="center" style="margin: auto; width:100%;">
                                        @foreach($data as $items)
                                        <tr>
                                            <th style="padding:10px;" width="25%">
                                                <a href="{{url('/blog/detail/'.$items['code'].'/'.str_slug($items['title'])) }}" target="_blank" title="{{ $items['title'] }}">
                                                    @if($items['image'])
                                                        <img src="{{config('settings.url')}}/uploads/blog/{{$items['code']}}/{{$items['image']}}" width="205" height="72" alt="thebloggersclub.com" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 100%; color: #4cb748; max-width: 100px !important;">
                                                    @else
                                                    <img src="{{config('settings.url')}}/frontend/images/elements/default-post.jpg" width="205" height="72" alt="thebloggersclub.com" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 100%; color: #4cb748; max-width: 100px !important;">
                                                    @endif
                                                 </a>
                                            </th>
                                            <td style="padding:10px;">
                                                <h4 style="margin-bottom: 5px; margin-top: 0px;"><a style="font-family: sans-serif; color:#000; font-size: 14px; text-align: left; text-decoration: none; display: inline-block; position:relative;" href="{{url('/blog/detail/'.$items['code'].'/'.str_slug($items['title'])) }}" target="_blank" title="{{ $items['title'] }}">{{ $items['title'] }}</a></h4>
                                <p style="margin-bottom: 0px; font-size: 13px;">{{ $items['short_description']}}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <!-- Button : END -->
                                </td>
                            </tr>
                        
            @endif
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : END -->
            </table>
            <br/>
            <br/>
            <!-- Email Body : END -->

            <!-- Email Footer : BEGIN -->
              <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; font-family: sans-serif; color: #999999; font-size: 12px; line-height: 100%; background:#1b2a3c;">
                
                <tr>
                    <td style="padding: 5px 10px; width: 100%; font-family: sans-serif; font-size: 12px; line-height: 100%; text-align: center; color: #999999;" class="x-gmail-data-detectors">
                        <webversion style="color: #999999; text-decoration: underline; font-weight: bold; display: block; width: 100%; padding-bottom: 10px;">
                            <a href="{{config('settings.url')}}/blog" target="_blank" style="font-family: sans-serif; color:#cccccc; font-size: 11px; text-align: center; text-decoration: none; display: inline-block; position:relative;">Home</a> |
                            <a href="{{config('settings.url')}}/privacy-policy" target="_blank" style="font-family: sans-serif; color:#cccccc; font-size: 11px; text-align: center; text-decoration: none; display: inline-block; position:relative;">Privacy Policy </a> |
                            <a href="{{config('settings.url')}}/contact" target="_blank" style="font-family: sans-serif; color:#cccccc; font-size: 11px; text-align: center; text-decoration: none; display: inline-block; position:relative;">Contact Us</a>
                        </webversion>
                    </td>
                    </tr>
                     <tr>
                    <td style="padding: 5px 10px; width: 100%; font-family: sans-serif; font-size: 12px; line-height: 100%; text-align: center; color: #999999;" class="x-gmail-data-detectors">
                        <webversion style="color: #999999; text-decoration: underline;  display: block; width: 100% font-size:11px; padding: 0px 60px; line-height: 18px; color: #bbb;">
                            Sent by {{config('settings.site_name')}} · 44600 Kumaripati Kathmandu, Nepal
                        </webversion>
                    </td>
                    </tr>
                     <tr>
                    <td style="padding: 5px 10px; width: 100%; font-family: sans-serif; font-size: 12px; line-height: 100%; text-align: center; color: #999999;" class="x-gmail-data-detectors">
                        <webversion style="color: #999999; text-decoration: underline;  display: block; width: 100% font-size:11px; padding: 0px 60px; line-height: 18px; color: #bbb;">
                            <a href="https://thebloggersclub.com/newsletter/unsubscribe/{{$receiverInfo['email']}}" target="_blank" style="font-family: sans-serif; color:#cccccc; font-size: 11px; text-align: center; text-decoration: none; display: inline-block; position:relative;  font-weight: bold;">Unsubscribe</a> from this type of email ·
                        </webversion>
                    </td>
                </tr>
            </table>
            <!-- Email Footer : END -->

            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>

    </center>
</body>
</html>