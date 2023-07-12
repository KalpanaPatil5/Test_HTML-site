<?php
    require_once 'function_send_mail.php';

    function sendMail($user_id, $user_mail, $new_user_token){
        $url= 'http://localhost/Test%20HTML%20site/controller/apis/verify_user.php?token='.$new_user_token;

        $buttonText = 'Verify Email';

        $body = '
        <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        line-height: 1.4;
                        color: #333333;
                        background-color: #f8f8f8;
                        margin: 0;
                        padding: 0;
                    }

                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                    }

                    .header {
                        background-color: #f1f1f1;
                        padding: 20px;
                        text-align: center;
                    }

                    .header h1 {
                        margin: 0;
                        font-size: 24px;
                    }

                    .content {
                        background-color: #ffffff;
                        padding: 20px;
                    }

                    .footer {
                        background-color: #f1f1f1;
                        padding: 20px;
                        text-align: center;
                    }

                    .footer p {
                        margin: 0;
                    }

                    .alert {
                        padding: 10px;
                        border-radius: 4px;
                        color: #fff;
                        font-weight: bold;
                        margin-bottom: 10px;
                      }
                      
                      .alert-success {
                        background-color: #28a745;
                      }
                      
                      .alert-error {
                        background-color: #dc3545;
                      }
                      

                    @media only screen and (max-width: 600px) {
                        .container {
                            max-width: 100%;
                            padding: 10px;
                        }
                    }
                </style>
            </head>

            <body>
            <div id="notification" class="alert"></div>
                <div class="container">
                    <div class="header">
                        <h1>Email Verification</h1>
                    </div>
                    <div class="content">
                        <p>Dear User,</p>
                        <p>Thank you for registering. To complete your email verification, please click the link below:</p>
                        <p>
                            <a id="verifyLink" href="'.$url.'">'.$buttonText.'</a>
                        </p>
                        <p>If you did not register on our website, please ignore this email.</p>
                    </div>
                    <div class="footer">
                        <p>Thank you,</p>
                        <p>Your Website Team</p>
                    </div>
                </div>
            </body>
            </html>
        ';

        $subject = 'Verification of mail !!';
        if(isset($user_id)){
            $mail_status = smtp_mailer($user_mail, $subject, $body);
            if($mail_status['status']){
                return array( "status" => true, "message" => "Mail sent successfully." );
            } else {
                return array( "status" => false, "message" => "Something went wrong." );
            }
        }
    }
?>
