<?php
const keyCode  = 'spa123';

use PHPMailer\PHPMailer\PHPMailer;

$db = new MysqliApp();
$encrypt = new apiKeys();

$clientInfo = isset($_POST['data']) ? json_decode($_POST['data'], true) : null;
$sched = isset($_POST['sched']) ? json_decode($_POST['sched'], true) : null;


if ($clientInfo != null && $sched != null) {

    $date = DateTime::createFromFormat('Y/m/d', $sched['today']); // Specify the input format
    $formattedDate = $date->format('Y-m-d');

    $sql = "INSERT INTO client_tbl(fullname,email,contact_number,staff_id,client_type,sched_date,sched_time)
            VALUES(?,?,?,?,?,?,?) ";
    $params = [
        $clientInfo['fullname'],
        $clientInfo['email'],
        $clientInfo['contact'],
        $clientInfo['staff']['value'],
        $clientInfo['clientType'],
        $formattedDate,
        $sched['time']
    ];

    $query = $db->query($sql, $params);


    if (!empty($query)) {

        $sql = "SELECT id FROM client_tbl ORDER BY id DESC LIMIT 1";
        $check_id = $db->fetchRow($sql);

        if (!empty($check_id)) {


            $service = '';
            foreach ($clientInfo['service'] as $key => $value) {
                $sql = "INSERT INTO client_service(client_id,service_id) 
                        VALUES (?,?)";
                $db->query($sql, [$check_id['id'], $value['id']]);

                $service .= $value['services'] .' ';
            }

            $uploadQRCode_dir = "../../img/qrcode/";
            $contentQR  = $clientInfo['fullname'] . '~' . $check_id['id'] . '~' . $formattedDate;
            $code = $encrypt->Encode($contentQR, keyCode);

            $qrCodeImagePath = $uploadQRCode_dir . $check_id['id'] . '.png';
            QRcode::png($code, $qrCodeImagePath);

            $timeDate =  $formattedDate.'~'.  $sched['time'];
         

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply.bot.sample@gmail.com';
            $mail->Password = 'bopryjkqircwjaec';
            $mail->setFrom('noreply.bot.sample@gmail.com', 'noreply');
            $mail->addAddress($clientInfo['email']);
            $mail->Subject = 'Thankyou Booking with Us!';
            $mail->AddEmbeddedImage('../../img/logo.png', 'logo');
            $mail->AddEmbeddedImage($qrCodeImagePath, 'qrcode');
            $mail->Body .= '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
            <head>
            <title></title>
            <meta charset="UTF-8" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="x-apple-disable-message-reformatting" content="" />
            <meta content="target-densitydpi=device-dpi" name="viewport" />
            <meta content="true" name="HandheldFriendly" />
            <meta content="width=device-width" name="viewport" />
            <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no" />
            <style type="text/css">
            table {
            border-collapse: separate;
            table-layout: fixed;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt
            }
            table td {
            border-collapse: collapse
            }
            .ExternalClass {
            width: 100%
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
            line-height: 100%
            }
            body, a, li, p, h1, h2, h3 {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            }
            html {
            -webkit-text-size-adjust: none !important
            }
            body, #innerTable {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
            }
            #innerTable img+div {
            display: none;
            display: none !important
            }
            img {
            Margin: 0;
            padding: 0;
            -ms-interpolation-mode: bicubic
            }
            h1, h2, h3, p, a {
            line-height: inherit;
            overflow-wrap: normal;
            white-space: normal;
            word-break: break-word
            }
            a {
            text-decoration: none
            }
            h1, h2, h3, p {
            min-width: 100%!important;
            width: 100%!important;
            max-width: 100%!important;
            display: inline-block!important;
            border: 0;
            padding: 0;
            margin: 0
            }
            a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important
            }
            u + #body a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
            }
            a[href^="mailto"],
            a[href^="tel"],
            a[href^="sms"] {
            color: inherit;
            text-decoration: none
            }
            </style>
            <style type="text/css">
            @media (min-width: 481px) {
            .hd { display: none!important }
            }
            </style>
            <style type="text/css">
            @media (max-width: 480px) {
            .hm { display: none!important }
            }
            </style>
            <style type="text/css">
            @media (max-width: 480px) {
            .t63{mso-line-height-alt:0px!important;line-height:0!important;display:none!important}.t64{padding-left:30px!important;padding-bottom:40px!important;padding-right:30px!important}.t126,.t66{width:480px!important}.t6{padding-bottom:20px!important}.t109,.t114,.t122,.t13,.t18,.t23,.t29,.t34,.t40,.t54,.t60,.t71,.t8{width:420px!important}.t5{line-height:28px!important;font-size:26px!important;letter-spacing:-1.04px!important}.t124{padding:40px 30px!important}.t107{padding-bottom:36px!important}.t103{text-align:center!important}.t100,.t43,.t45,.t74,.t76,.t80,.t82,.t86,.t88,.t92,.t94,.t98{display:revert!important}.t102,.t78,.t84,.t90,.t96{vertical-align:top!important;width:44px!important}.t1{padding-bottom:50px!important}.t3{width:80px!important}.t48{text-align:left!important}.t47{vertical-align:middle!important;width:95px!important}
            }
            </style>

            <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@400;500;700;800&amp;display=swap" rel="stylesheet" type="text/css" />
            </head>
            <body id="body" class="t130" style="min-width:100%;Margin:0px;padding:0px;background-color:#242424;"><div class="t129" style="background-color:#242424;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td class="t128" style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#242424;" valign="top" align="center">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" align="center" id="innerTable"><tr><td><div class="t63" style="mso-line-height-rule:exactly;mso-line-height-alt:45px;line-height:45px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t67" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>
            <td class="t66" style="background-color:#F8F8F8;width:600px;">

            <table class="t65" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t64" style="padding:0 50px 60px 50px;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="left">
            <table class="t4" role="presentation" cellpadding="0" cellspacing="0" style="Margin-right:auto;">
            <tr>
            <td class="t3" style="width:130px;">
            <table class="t2" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t1" style="padding:0 0 81px 0;"><div style="font-size:0px;"><img class="t0" style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width="130" height="117.90625" alt="" src="cid:logo"></div></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t9" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>
            <td class="t8" style="width:500px;">

            <table class="t7" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t6" style="padding:0 0 15px 0;"><h1 class="t5" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:26px;font-weight:800;font-style:normal;font-size:24px;text-decoration:none;text-transform:none;letter-spacing:-1.56px;direction:ltr;color:#191919;text-align:left;mso-line-height-rule:exactly;mso-text-raise:1px;">'.$clientInfo['fullname'].', Thank you for booking with us!</h1></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t14" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>
            <td class="t13" style="width:500px;">
            <table class="t12" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t11" style="padding:0 0 22px 0;"><p class="t10" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">Thank you so much for choosing to book your massage with us! We deeply value your trust and are committed to providing you with a truly exceptional experience. Our team of professional therapists is dedicated to ensuring your comfort and relaxation from the moment you arrive until the end of your session. Whether you are looking to relieve stress, soothe sore muscles, or simply enjoy a peaceful escape, we are here to meet your needs and exceed your expectations.</p></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t19" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>
            <td class="t18" style="width:500px;">

            <table class="t17" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t16"><p class="t15" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">Avail services</p></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t24" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>
            <td class="t23" style="width:500px;">

            <table class="t22" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t21" style="padding:0 0 22px 0;"><p class="t20" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;"> '.$service.'</p></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t30" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>
            <td class="t29" style="width:500px;">

            <table class="t28" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t27"><p class="t26" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;"><span class="t25" style="margin:0;Margin:0;font-weight:bold;mso-line-height-rule:exactly;">Date &amp; time</span></p></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t35" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>
            <td class="t34" style="width:500px;">

            <table class="t33" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t32" style="padding:0 0 22px 0;"><p class="t31" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">'.$timeDate.'</p></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t41" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>
            <td class="t40" style="width:500px;">
            <table class="t39" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t38"><p class="t37" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;"><span class="t36" style="margin:0;Margin:0;font-weight:bold;mso-line-height-rule:exactly;">This QR code serves as your entrance to our massage session</span></p></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t55" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>
            <td class="t54" style="background-color:#FFFFFF;width:500px;">

            <table class="t53" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t52" style="padding:20px 20px 20px 20px;"><div class="t51" style="width:100%;text-align:left;"><div class="t50" style="display:inline-block;"><table class="t49" role="presentation" cellpadding="0" cellspacing="0" align="left" valign="middle">
            <tr class="t48"><td></td><td class="t47" width="95" valign="middle">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="t46" style="width:100%;"><tr>
            <td class="t43" style="width:10px;" width="10"></td><td class="t44"><div style="font-size:0px;"><img class="t42" style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width="140" height="115.453125" alt="" src="cid:qrcode"/></div></td><td class="t45" style="width:10px;" width="10"></td>
            </tr></table>
            </td>
            <td></td></tr>
            </table></div></div></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td><div class="t56" style="mso-line-height-rule:exactly;mso-line-height-alt:30px;line-height:30px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align="center">
            <table class="t61" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t60" style="width:500px;">

            <table class="t59" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t58"><p class="t57" style="margin:0;Margin:0;font-family:Albert Sans,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:14px;text-decoration:none;text-transform:none;letter-spacing:-0.56px;direction:ltr;color:#333333;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">Click the button below for a status update on your delivery.</p></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td><div class="t62" style="mso-line-height-rule:exactly;mso-line-height-alt:40px;line-height:40px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr></table></td>
            </tr></table>
            </td>
            </tr></table>
            </td></tr><tr><td align="center">
            <table class="t127" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t126" style="background-color:#242424;width:600px;">

            <table class="t125" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
            <td class="t124" style="padding:48px 50px 48px 50px;"><table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100% !important;"><tr><td align="center">
            <table class="t72" role="presentation" cellpadding="0" cellspacing="0" style="Margin-left:auto;Margin-right:auto;">
            <tr>

            <td class="t71" style="width:500px;">

            <table class="t70" role="presentation" cellpadding="0" cellspacing="0" width="100%" style="width:100%;"><tr>
           
            </body>
            </html>';
            $mail->IsHTML(true);
            $mail->send();
            $return = true;
        } else {
            $return = false;
        }
    } else {
        $return = false;
    }
} else {
    $return = false;
}


$data = array(
    "result" => $return
);

echo json_encode($data);
