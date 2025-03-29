<?php
include_once 'create.php';

$arr    = array();
$arr2   = array();

$oid = security('orders_id');

$user_name = security('user_name');
$user_id = security('user_id');
$email = security('user_email');
$phone = security('user_phone');


//FOR TABLE ORDERS
$arr['order_code']      = 'HELLO-' . generateRandomString();



//FOR TABLE SUBORDERS
$total = 0;
foreach ($_SESSION['cart'] as $cart) {
    $arr2['id']             = create_id('sub_orders', 'id');
    $arr2['order_id']       = $oid;
    $arr2['product_id']     = $cart['product_id'];
    $arr2['quantity']       = $cart['cart_quantity'];
    $arr2['variations']     = $cart['cart_variations'];
    $arr2['total_price']    = $cart['cart_price'];
    $arr2['user_id']        = $user_id;

    $total += $cart['cart_price'];

    if (!build_sql_insert('sub_orders', $arr2)) {
        header('location:../../checkout.php?error');
    }
}

$arr['order_amount'] = $total;
$arr['payment_method'] = security('payment_method');

if (!build_sql_edit('orders', $arr, $oid, 'orders_id')) {
    header('location:../../checkout.php?error');
}

// pay($oid, "1", $phone);

function pay($inv, $amount, $phone)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://vesencomputing.com/hj/lp_api.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('total' => $amount, 'inv' => $inv, 'number' => $phone),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}

$body = '<p style="font-family:Poppins, sans-serif;">';
$body   .= 'New order on ' . APP_NAME;
$body   .= '';
$body   .= '</p>';
$body   .= '
<!DOCTYPE html>

<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <title></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css" />
    <!--<![endif]-->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: inherit !important;
        }

        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
        }

        p {
            line-height: inherit
        }

        .desktop_hide,
        .desktop_hide table {
            mso-hide: all;
            display: none;
            max-height: 0px;
            overflow: hidden;
        }

        .image_block img+div {
            display: none;
        }

        @media (max-width:670px) {

            .desktop_hide table.icons-inner,
            .social_block.desktop_hide .social-table {
                display: inline-block !important;
            }

            .icons-inner {
                text-align: center;
            }

            .icons-inner td {
                margin: 0 auto;
            }

            .fullMobileWidth,
            .image_block img.big,
            .row-content {
                width: 100% !important;
            }

            .mobile_hide {
                display: none;
            }

            .stack .column {
                width: 100%;
                display: block;
            }

            .mobile_hide {
                min-height: 0;
                max-height: 0;
                max-width: 0;
                overflow: hidden;
                font-size: 0px;
            }

            .desktop_hide,
            .desktop_hide table {
                display: table !important;
                max-height: none !important;
            }
        }
    </style>
</head>

<body style="background-color: #F5F5F5; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
    <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F5F5F5;" width="100%">
        <tbody>
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                    <div class="spacer_block" style="height:30px;line-height:30px;font-size:1px;"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #333; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 25px; padding-left: 25px; padding-top: 25px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="50%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-top:5px;width:100%;padding-right:0px;padding-left:0px;">
                                                                <div align="left" class="alignment" style="line-height:10px"><img alt="Image" class="fullMobileWidth" src="https://hello.angacinemas.com/assets/img/images/logo3.png" style="display: block; height: auto; border: 0; width: 195px; max-width: 100%;" title="Image" width="195" /></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 25px; padding-right: 25px; padding-top: 25px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="50%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="button_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:10px;padding-top:10px;text-align:right;">
                                                                <div align="right" class="alignment">
                                                                    <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:38px;width:100px;v-text-anchor:middle;" arcsize="37%" stroke="false" fillcolor="#D4E9F9"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#052d3d; font-family:Poppins, sans-serif; font-size:14px"><![endif]--><a href="#" style="text-decoration:none;display:inline-block;color:#052d3d;background-color:#D4E9F9;border-radius:14px;width:auto;border-top:0px solid transparent;font-weight:undefined;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:3px;padding-bottom:3px;font-family:Poppins, sans-serif;font-size:14px;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank"><span style="padding-left:15px;padding-right:15px;font-size:14px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; word-break: break-word; line-height: 2; mso-line-height-alt: 32px;"><span data-mce-style="font-size:14px;" style="font-size:14px;">My account</span></span></span></a>
                                                                    <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #D6E7F0; color: #000000; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 15px; padding-top: 55px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:15px;padding-top:25px;width:100%;padding-right:0px;padding-left:0px;">
                                                                <div align="center" class="alignment" style="line-height:10px"><img alt="Image" class="big" src="https://blinkhub.co.ke/assets/imgs/email/illo_shipped.png" style="display: block; height: auto; border: 0; width: 488px; max-width: 100%;" title="Image" width="488" /></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:5px;padding-left:15px;padding-right:10px;padding-top:20px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #052D3D; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:38px;"><strong><span style="font-size:38px;">Your order is <span style="color:#2190e3;font-size:38px;">on its way</span></span></strong></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:40px;padding-right:40px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 18px; color: #052D3D; line-height: 1.5;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 33px;"><span style="font-size:22px;"><span style="font-size:22px;">Hello <strong> ' . $user_name . ' </strong>, thanks again for making an order with www.yourecommerce.com. We\'re happy to let you know that your items have now been shipped</span></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #052D3D; line-height: 1.2;">
                                                                        <p style="margin: 0; text-align: center; font-size: 12px; mso-line-height-alt: 14.399999999999999px;"><span style="font-size:18px;background-color:#ffffff;">Your estimated delivery date is <strong><span style="color:#2190e3;font-size:18px;">Apr 5, 2019</span></strong></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #D6E7F0; color: #000000; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 35px; padding-top: 15px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="empty_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 15px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                    <table border="0" cellpadding="10" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #052d3d; line-height: 1.2;">
                                                                        <p style="margin: 0; text-align: center; font-size: 12px; mso-line-height-alt: 14.399999999999999px;"><strong><span style="font-size:20px;">Items ordered:</span></strong></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F8F8F8; color: #333; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 15px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>ITEM</strong></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px dotted #E8E8E8; padding-bottom: 5px; padding-top: 15px; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
                                                    <div class="spacer_block" style="height:25px;line-height:25px;font-size:1px;"></div>
                                                </td>
                                                <td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px dotted #E8E8E8; padding-bottom: 5px; padding-left: 15px; padding-right: 15px; padding-top: 15px; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>QTY</strong></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="column column-4" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 15px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>PRICE</strong></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    ';

foreach ($_SESSION['cart'] as $ct) {
    if (!empty($ct['cart_variations'])) {
        $text = '+ variations';
    } else {
        $text = '';
    }
    $body .= '
                    
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #333; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                <div align="center" class="alignment" style="line-height:10px"><img alt="Image" src=" ' . file_url . $ct['product_image'] . ' " style="display: block; height: auto; border: 0; width: 130px; max-width: 100%;" title="Image" width="130" /></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px dotted #E8E8E8; padding-bottom: 35px; padding-top: 30px; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:5px;padding-right:10px;padding-top:10px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"><span style="font-size:16px;color:#2190e3;"><strong> ' . $ct['product_name'] . ' </strong></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-right:10px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
                                                                        
                                                                        <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;">' . $text . '</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-right: 1px dotted #E8E8E8; padding-bottom: 5px; padding-top: 55px; vertical-align: top; border-top: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:20px;"><strong> ' . $ct['cart_quantity'] . ' </strong></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="spacer_block" style="height:50px;line-height:50px;font-size:1px;"></div>
                                                </td>
                                                <td class="column column-4" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 55px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-right:15px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
                                                                        <p style="margin: 0; text-align: center; font-size: 12px; mso-line-height-alt: 14.399999999999999px;"><span style="font-size:20px;"><span style="font-size:20px;"><strong>Ksh. ' . $ct['cart_price'] . '</strong></span></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    ';
}

$body .= '
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-10" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #D6E7F0; color: #333; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #FFFFFF; border-bottom: 18px solid #D6E7F0; border-left: 18px solid #D6E7F0; border-right: 18px solid #D6E7F0; border-top: 18px solid #D6E7F0; padding-bottom: 10px; padding-left: 15px; padding-top: 5px; vertical-align: top;" width="50%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                <div align="center" class="alignment" style="line-height:10px"><img alt="Image" src="https://blinkhub.co.ke/assets/imgs/email/002-shipped.png" style="display: block; height: auto; border: 0; width: 123px; max-width: 100%;" title="Image" width="123" /></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:5px;padding-left:15px;padding-right:15px;padding-top:15px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #fc7318; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"><span style="font-size:24px;"><strong>SHIPPING ADDRESS</strong></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:15px;padding-left:15px;padding-right:15px;padding-top:5px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 18px; color: #555555; line-height: 1.5;">
                                                                        <p style="margin: 0; font-size: 14px; mso-line-height-alt: 21px;"><strong>HARRY MAC INTOSH</strong><br />123 Anywhere road<br />Anywhere, IT 82933</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0" class="button_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="left" class="alignment">
                                                                    <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" style="height:42px;width:192px;v-text-anchor:middle;" arcsize="36%" stroke="false" fillcolor="#fc7318"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Poppins, sans-serif; font-size:16px"><![endif]-->
                                                                    <div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#fc7318;border-radius:15px;width:auto;border-top:0px solid transparent;font-weight:undefined;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:5px;padding-bottom:5px;font-family:Poppins, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; word-break: break-word; line-height: 2; mso-line-height-alt: 32px;"><strong>Manage your order</strong></span></span></div>
                                                                    <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #FFFFFF; border-bottom: 18px solid #D6E7F0; border-left: 18px solid #D6E7F0; border-right: 18px solid #D6E7F0; border-top: 18px solid #D6E7F0; padding-bottom: 10px; padding-left: 15px; padding-top: 5px; vertical-align: top;" width="50%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:20px;padding-top:20px;width:100%;padding-right:0px;padding-left:0px;">
                                                                <div align="center" class="alignment" style="line-height:10px"><img alt="Image" src="https://blinkhub.co.ke/assets/imgs/email/001-receipt.png" style="display: block; height: auto; border: 0; width: 82px; max-width: 100%;" title="Image" width="82" /></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:5px;padding-left:15px;padding-right:15px;padding-top:15px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #2190E3; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"><span style="font-size:24px;"><strong>YOUR RECEIPT</strong></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:15px;padding-left:15px;padding-right:15px;padding-top:5px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 18px; color: #555555; line-height: 1.5;">
                                                                        <p style="margin: 0; font-size: 14px; mso-line-height-alt: 21px;"><strong>Nam consequat scelerisque finibus. Aliquam orci purus, blandit iaculis orci vel, lacinia egestas ante.</strong></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0" class="button_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="left" class="alignment">
                                                                    <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" style="height:42px;width:191px;v-text-anchor:middle;" arcsize="36%" stroke="false" fillcolor="#2190E3"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Poppins, sans-serif; font-size:16px"><![endif]-->
                                                                    <div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#2190E3;border-radius:15px;width:auto;border-top:0px solid transparent;font-weight:undefined;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:5px;padding-bottom:5px;font-family:Poppins, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;"><span dir="ltr" style="font-size: 16px; word-break: break-word; line-height: 2; mso-line-height-alt: 32px;"><strong>Download receipt pdf</strong></span></span></div>
                                                                    <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-11" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F0F0F0; color: #000000; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 18px solid #FFFFFF; border-left: 25px solid #FFFFFF; border-right: 25px solid #FFFFFF; border-top: 18px solid #FFFFFF; padding-bottom: 5px; padding-left: 35px; padding-right: 35px; padding-top: 15px; vertical-align: top;" width="100%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:10px;padding-left:15px;padding-right:15px;padding-top:15px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #052d3d; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 14.399999999999999px;"><span style="font-size:34px;"><strong><span style="font-size:34px;"><span style="color:#fc7318;font-size:34px;">Got a question?</span><br /></span></strong><span style="font-size:34px;">We\'re here to help you</span></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad" style="padding-bottom:30px;padding-left:10px;padding-right:10px;">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 18px; color: #787878; line-height: 1.5;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 27px;"><span style="font-size:18px;">Lorem ipsum dolor sit amet at <strong><a href="#" rel="noopener" style="text-decoration: none; color: #2190E3;" target="_blank">support@netshop.com</a></strong></span><br /><span style="font-size:18px;">or call us at <span style="color:#2190e3;font-size:18px;">(<strong>389</strong>)</span> <span style="color:#2190e3;font-size:18px;"><strong>839289328932</strong></span> <br /><strong>Monday through Friday 8:30-5:30 PST</strong></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-12" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; color: #000000; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                    <div class="spacer_block" style="height:20px;line-height:20px;font-size:1px;"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-13" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 60px; padding-top: 20px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                    <table border="0" cellpadding="10" cellspacing="0" class="social_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;" width="141px">
                                                                        <tr>
                                                                            <td style="padding:0 15px 0 0px;"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="https://blinkhub.co.ke/assets/imgs/email/facebook2x.png" style="display: block; height: auto; border: 0;" title="Facebook" width="32" /></a></td>
                                                                            <td style="padding:0 15px 0 0px;"><a href="https://twitter.com/" target="_blank"><img alt="Twitter" height="32" src="https://blinkhub.co.ke/assets/imgs/email/twitter2x.png" style="display: block; height: auto; border: 0;" title="Twitter" width="32" /></a></td>
                                                                            <td style="padding:0 15px 0 0px;"><a href="https://instagram.com/" target="_blank"><img alt="Instagram" height="32" src="https://blinkhub.co.ke/assets/imgs/email/instagram2x.png" style="display: block; height: auto; border: 0;" title="Instagram" width="32" /></a></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 18px; color: #555555; line-height: 1.5;">
                                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">NetShop - Lorem ipsum dolor sit amet hasellus sagittis aliquam luctus.</p>
                                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">Nairobi, Kenya</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0" class="divider_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="60%">
                                                                        <tr>
                                                                            <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px dotted #C4C4C4;"><span></span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0" class="text_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div style="font-family: Poppins, sans-serif">
                                                                    <div class="" style="font-size: 12px; font-family: Poppins, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #4F4F4F; line-height: 1.2;">
                                                                        <p style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 14.399999999999999px;"><span style="font-size:14px;"><a href="#" rel="noopener" style="text-decoration: none; color: #2190E3;" target="_blank"><strong>Help& FAQs</strong></a> | <strong><a href="#" rel="noopener" style="text-decoration: none; color: #2190E3;" target="_blank">Returns</a></strong> |<span style="background-color:transparent;font-size:14px;">1-998-9283-19832</span></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
    </table><!-- End -->
</body>

</html>
';

$subject    = APP_NAME . ' Order';
$name       = APP_NAME;

email($email, $subject, $name, $body);
$_SESSION["cart"] = array();
// header('location:../../payment?oid=' . $oid . '&amount=' . $total);
header('location:../../success');
