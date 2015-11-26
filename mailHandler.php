<?php
function sendmail($to, $subject, $message) {
        //path to PHPMailer class
        require('phpmailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;
        $mail->CharSet = "UTF-8";
        // telling the class to use SMTP
        $mail->IsSMTP();
        // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPDebug = 2;
        // enable SMTP authentication
        $mail->SMTPAuth = true;
        // sets the prefix to the servier
        $mail->SMTPSecure = "tls";
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.netsite.dk";
        // set the SMTP port for the GMAIL server
        $mail->Port = 587;
        // GMAIL username
        $mail->Username = "projektstyring@vonbulow.org";
        // GMAIL password
        $mail->Password = "Mark1Annette2";
        //Set reply-to email this is your own email, not the gmail account 
        //used for sending emails
        $mail->SetFrom('projektstyring@vonbulow.org', 'Projektstyring');
//        $mail->FromName = "Projektstyring";
        // Mail Subject
        $mail->Subject = $subject;
        //Main message
//        $mail->MsgHTML($message);
        $mail->isHTML(true);
        $mail->Body = $message;
        //Your email, here you will receive the messages from this form. 
        //This must be different from the one you use to send emails, 
        //so we will just pass email from functions arguments
        $mail->AddAddress($to, "");
        if (!$mail->send()) {
            echo $mail->ErrorInfo;
            return false;
        } else {
            //successfully sent
            return true;
        }
    }