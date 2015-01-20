<?php
if (isset($_POST['submit']) && $_POST['submit'] == "Send Message" ){
$contactus_message = "";
if ( $_POST['name'] == "" ){
    $contactus_message .= "<br/> Please Fill Name.";
}
if ( $_POST['email'] == "" ){
    $contactus_message .= "<br/> Please Fill Email";
}

if ( $_POST['message'] == "" ){
    $contactus_message .= "<br/> Please Fill Message".$MSG_empty_content;
}

if ( $_POST['captcha'] == "" || $_POST['captcha'] !=$_SESSION[SESSION_TITLE.'security_code'] ){
    $contactus_message .= "<br/> Please Fill Captcha".$MSG_empty_content;
}



if ( isset($contactus_message) && $contactus_message == "" ){


            $str_subject = "Contact Information from kolapillyayurveda.com";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: '.$_POST['name'].' <'.$_POST['email'].'>'."\r\n";
            $message = "Contact Information <br>
                 Name: " . $_POST['name'] . "<br>
                 Email: " . $_POST['email'] . "<br>
                 Message: " . $_POST['message'] . "<br>
                <br /><br />

                Thanks,<br /><br />
                kolapillyayurveda.com<br />";
               mail("kolapillyayurveda@gmail.com",$str_subject,$message,$headers);
                //mail("pramodgmenon@gmail.com",$str_subject,$message,$headers);
								$contactus_message = "Thank you for contacting us.";
}


}
?>

