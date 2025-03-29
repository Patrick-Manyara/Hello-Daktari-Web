<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once MAIL_SRC . 'Exception.php';
require_once MAIL_SRC . 'PHPMailer.php';
require_once MAIL_SRC . 'SMTP.php';

require_once MAIL_PATH . 'autoload.php';

if (!defined('auth')) {
    http_response_code(401);
    exit();
}

function email($email, $subject, $header, $message)
{
    global $error;

    $sender = MAIL_SENDER;

    $mail               = new PHPMailer();
    $mail->isSMTP();
    $mail->Host         = MAIL_HOST;
    $mail->SMTPAuth     = TRUE;
    $mail->SMTPSecure   = 'ssl';
    $mail->Port         = 465;
    $mail->isHTML(true);
    $mail->Username     = $sender;
    $mail->Password     = MAIL_PASS;

    $mail->Subject = $subject;
    $mail->SetFrom($sender, $header);
    $mes = email_header($message);
    $mes.=email_footer();
    $mail->Body = $mes;
    $mail->AddAddress($email);

    if (!$mail->Send()) {
        $mail->smtpClose();
        return $error[] = 127;
    }

    $mail->smtpClose();

    return "success";
}

function email_header($me){
    $mes = '
    <table style="max-width:900px;border-width:0px 8px 15px 8px;border-style:solid;border-color:#f5f7f8;background-color:#f5f7f8" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody>
		<tr>
			<td style="background-color:#f5f7f8" valign="top" align="center">
				<table class="m_4489084039273311747wrapper" style="max-width:600px" width="600" cellspacing="0" cellpadding="0" border="0" align="center">
					<tbody>
						<tr>
							<td align="center">
								<table class="m_4489084039273311747wrapper" width="600" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody>
										<tr>
											<td style="padding:5% 0%" align="center">
												<a
													href="https://lunahealth.co"
												>
													<img
														class="m_4489084039273311747logo CToWUd"
														src="https://hello.angacinemas.com/assets/img/images/logo3.png"
														alt='.APP_NAME.'
														style="width:120px;height:auto;display:block"
														data-bit="iit"
														width="120"
														height="auto"
														border="0"
													/>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="m_4489084039273311747wrapper" style="max-width:600px;width:600px" width="600" cellspacing="0" cellpadding="0" border="0" align="center">
					<tbody>
						<tr>
							<td style="background-color:#ffffff" align="center">
								<table class="m_4489084039273311747wrapper" style="background-color:transparent;width:100%" width="600" cellspacing="0" cellpadding="0" border="0" align="center">
									<tbody>
										<tr>
											<td style="background-color:transparent;font-size:0px;line-height:5px" height="5"><span style="font-size:0px;line-height:5px">&nbsp; </span></td>
										</tr>
									</tbody>
								</table>
								<table class="m_4489084039273311747wrapper" dir="ltr" width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="left">
									<tbody>
										<tr>
											<td style="Arial,sans-serif;background-color:#ffffff;" valign="top" align="left">
												<table class="m_4489084039273311747wrapper" dir="ltr" width="600" cellspacing="0" cellpadding="0" border="0" align="left">
													<tbody>
														<tr>
															<td style="Arial,sans-serif;padding:0% 5% 0% 5%;text-align:left" align="left">
															
																
																<span style="font-size:16px;line-height:20px;color:#1f1f1f">
																	'.$me.'
																</span>
															
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
				</table>
			
			</td>
		</tr>
	</tbody>
</table>

    ';
   
    return $mes;
}

function email_footer(){
    $mes = '<table role="presentation" style="border-collapse:collapse!important;border-spacing:0;font-family:sans-serif;color:#333333" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody>
		<tr>
			<td style="font-family:Arial,Helvetica,sans-serif;padding-top:10px;padding-bottom:10px;padding-right:0;padding-left:0" valign="top" align="center">
				

				<table role="presentation" style="border-collapse:collapse!important;border-spacing:0;font-family:sans-serif;color:#333333;width:70%;max-width:420px" width="420" cellspacing="0" cellpadding="0" border="0" align="right">
					<tbody>
						<tr>
							<td style="font-family:Arial,Helvetica,sans-serif;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0" valign="top" align="right">
								<table role="presentation">
									<tbody>
										<tr>
											<td style="padding-right:8px;padding-top:0;padding-bottom:0;padding-left:0">
												<a href="https://web.facebook.com/luna4africa" rel="noopener" style="vertical-align:top" target="_blank">
													<img
														src="https://vesencomputing.com"
														style="border-width:0;height:auto;line-height:100%;outline-style:none;text-decoration:none;width:18px!important;height:20px!important;font-size:10px"
														alt="iOS"
														class="CToWUd"
														data-bit="iit"
														width="18"
														height="20"
													/>
												</a>
											</td>
											<td style="padding-right:8px;padding-top:0;padding-bottom:0;padding-left:0">
												<a href="https://vesencomputing.com" rel="noopener" style="vertical-align:top" target="_blank">
													<img
														src="https://luna-africa.com/instagram.png"
														style="border-width:0;height:auto;line-height:100%;outline-style:none;text-decoration:none;width:18px!important;height:20px!important;font-size:10px"
														alt="iOS"
														class="CToWUd"
														data-bit="iit"
														width="18"
														height="20"
													/>
												</a>
											</td>
											<td style="padding-right:8px;padding-top:0;padding-bottom:0;padding-left:0">
												<a href="https://vesencomputing.com" rel="noopener" style="vertical-align:top" target="_blank">
													<img
														src="https://luna-africa.com/twitter.png"
														style="border-width:0;height:auto;line-height:100%;outline-style:none;text-decoration:none;width:18px!important;height:20px!important;font-size:10px"
														alt="iOS"
														class="CToWUd"
														data-bit="iit"
														width="18"
														height="20"
													/>
												</a>
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
</table>
';
    return $mes;
}
