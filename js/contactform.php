<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/style.css" rel="stylesheet" media="screen">    
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/icons.css" rel="stylesheet" media="screen">
    <link href="../css/flexslider.css" rel="stylesheet" media="screen"/> 
    <link href="../css/responsive.css" rel="stylesheet" media="screen">  
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic%7CMontserrat:700%7CMerriweather:400italic' rel='stylesheet' type='text/css'>

<?php
 
if(isset($_POST['contact-email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "stevenmurrayr@gmail.com";
 
    $email_subject = "DDC Contact Form";
 
 
    function died($error) {
 
        // your error code can go here
 
        echo "Oh no! Something went wrong with the form you submitted. ";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
    // validation expected data exists
 
    if(!isset($_POST['contact-email']) ||
 
        !isset($_POST['contact-name']) ||
 
        !isset($_POST['contact-message'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }


    $first_name = $_POST['contact-name']; // required
 
    $email_from = $_POST['contact-email']; // required
 
    $comments = $_POST['contact-message']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'The email address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'The name you entered does not appear to be valid.<br />';
 
  }
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'The message you entered does not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n"; 
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }

    $email_message .= "Name: ".clean_string($first_name)." ".clean_string($last_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Message: ".clean_string($comments)."\n";
 
     
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->


<p>Thank you for contacting the Digital Debate Camp. We will be in touch with you soon.</p>
    
         
 
 
 
<?php
 
}
 
?>