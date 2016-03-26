<?php

	session_start();
	
	$now = time();
	$expiry = time()+5;
	
	if (isset($_SESSION["expiry_time"])) {
		if ($now < $_SESSION["expiry_time"]) {
			exit(json_encode(["code"=>-1, "message"=>"Your first email has not yet been sent."]));
		}
	}
	$_SESSION["expiry_time"] = $expiry;
	
	$theMessage = $_POST["the_message"];
	
	//send email
	$to1 = $_POST["the_email"];
	$subject1 = "Your message to TheRookieBlogger has been sent!";
	$subject2 = "new Inquiry from TheRookieBlogger!";

	$message1 = "
		<html>
			<head>
				<title>Email Received...</title>
			</head>
			<body>
				<h2 style='background-color:#e6f7ff;padding:10px;'>Your email has been sent...</h2>
				<h3>This was the message you sent:</h3>
				<p>".$theMessage."</p>
			</body>
		</html>
	";
	
	$message2 = "
		<html>
			<head>
				<title>New Inquiry for TheRookieBlogger</title>
			</head>
			<body>
				<h2 style='background-color:#e6f7ff;padding:10px;'>New Inquiry for TheRookieBlogger</h2>
				<h3>Message:</h3>
				<p>".$theMessage."</p>
			</body>
		</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: TheRookieBlogger<no-reply@therookieblog.com>' . "\r\n";

	mail($to1,$subject1,$message1,$headers);
	mail("jamesnogra@gmail.com",$subject2,$message2,$headers);
	
	exit(json_encode(["code"=>1, "message"=>"Your email has been successfully sent."]));

?>