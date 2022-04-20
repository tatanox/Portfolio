<?php

include_once("config.php");

$email = mysqli_real_escape_string($con, $_POST["em1"]);

$emailclean = filter_var($email, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);

$sub = mysqli_real_escape_string($con, $_POST["sub1"]);

$subclean = filter_var($sub, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

$com = mysqli_real_escape_string($con, $_POST["com1"]);

$comclean = filter_var($com, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

//insert into database

mysqli_query($con,"INSERT INTO contact('email', 'subject', 'comments')VALUES("$emailclean","$subclean","$comclean")");

//email the form to yourself

$to="gallandludinard.a@gla-web.fr";

$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= "From: <you@yourwebsite.com>" . "\r\n";

$headers .= "Cc: another@email.com" . "\r\n";

$message='<table width="100%"" border="1" cellspacing="1" cellpadding="2">

<tr><td colspan="2">Someone Contacted You On Your Website</td></tr>

<tr><td>Subject</td><td>".$subclean."</td></tr>

<tr><td>Message</td><td>".$comclean."</td></tr>

<tr><td colspan="2"><img src="https://a1websitepro.com/wp-content/uploads/2014/09/logo200.png" width="300px"/></td></tr>

</table>';

mail($to,$subclean,$message,$headers);

//send message back to AJAX

echo '<div class="alert alert-success">Thank you for contacting us. Someone will get back to you within 1 Business Day.</div>';

$con->close();

?>