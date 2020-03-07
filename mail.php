<?php

require_once "recaptchalib.php";
    
// your secret key
$secret = $_ENV["CAPTCHA_SECRET"];
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);
    
// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

if ($response != null && $response->success) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $from = 'Site web : Elves Must Live'; 
    $to = $_ENV["MAIL_TO"];
    $subject = 'Nouvelle demande de contact sur Elves Must Live !';
    $human = $_POST['human'];
			
    $body = "En provenance de : $name\nE-Mail du visiteur : $email\nMessage :\n$message";
				
    if ($_POST['submit']) 
    {				 
        if (mail ($to, $subject, $body, $from)) 
        { 
	    echo '<p>Votre message a été envoyé. Redirection dans 3 secondes !</p>';
	    
	    header('refresh:3;url=index.html');  
		
  		exit();
	    } else { 
	    echo '<p>Oups, retentez plus tard !</p>'; 
	    header('refresh:3;url=index.html');  
	    exit();
	    } 
    } 

} else {
    
	    echo '<p>Oups, captcha invalide ! !</p>'; 
	    header('refresh:3;url=index.html');  
	    exit();
}
    
?>
