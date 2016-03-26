<!DOCTYPE html>


<html>

	<head>
		<title>James Arnold Nogra Website - Free Surveys - Free Tunnel - The Rookie Blogger</title>
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/my.css">
		<script>
			$(document).ready(function() {
				hideEmailForm();
				
				$("#cancel-email-form-btn").click(function() {
					hideEmailForm();
				});
				
				$("#send-email-btn").click(function() {
					showEmailForm();
				});
				
				$("#send-email-form-btn").click(function() {
					var theEmail = $("#email").val();
					var theMessage = $("#message").val();
					if (theEmail.length < 5) {
						$("#email-form-error-message").html("Email is required.");
						return;
					}
					if (theMessage.length < 5) {
						$("#email-form-error-message").html("Message is too short.");
						return;
					}
					if (!validateEmail(theEmail)) {
						$("#email-form-error-message").html("Email is not valid.");
						return;
					}
					$("#email-form-error-message").html("");
					$.post("send_email.php", {"the_email":theEmail, "the_message":theMessage}, function(result){
						var allResults = JSON.parse(result);
						if (allResults.code == -1) {
							$("#email-form-error-message").html(allResults.message);
						} else {
							hideEmailForm();
						}
					});
				});
			});
			
			function showEmailForm() {
				$("#fullscreen").show();
				$("#email-form-container").show();
			}
			function hideEmailForm() {
				$("#fullscreen").hide();
				$("#email-form-container").hide();
			}
			
			/*FROM http://stackoverflow.com/questions/46155/validate-email-address-in-javascript*/
			function validateEmail(email) {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(email);
			}
		</script>
	</head>
	
	<body>
		<div class="my-cloud" id="cloud-3"></div>
		<div id="thumbnail-container">
			<a href="http://jsurveys.therookieblog.com/"><div class="thumbnail-each" style="background-image: url('img/1.jpg');"><div class="thumbnail-each-label">jSurveys</div></div></a>
			<a href="http://babydesertwolf.blogspot.com/"><div class="thumbnail-each" style="background-image: url('img/2.jpg');"><div class="thumbnail-each-label">The Rookie Blogger</div></div></a>
			<a href="http://jtunnel.therookieblog.com/"><div class="thumbnail-each" style="background-image: url('img/3.jpg');"><div class="thumbnail-each-label">jTunnel</div></div></a>
		</div>
		<div class="my-btn" id="send-email-btn">Send Email</div>
		<div class="my-cloud" id="cloud-1"></div>
		<div class="my-cloud" id="cloud-2"></div>
		
		<!-- For the email form -->
		<div id="fullscreen"></div>
		<div id="email-form-container">
			<div class="for-padding">
				<input type="text" name="email" id="email" placeholder="Email" class="my-input" />
				<div class="my-spacer"></div>
				<textarea id="message" name="message" class="my-input" rows="5" placeholder="Your message here..."></textarea>
				<div class="my-spacer"></div>
				<div class="error-message" id="email-form-error-message"></div>
				<div class="my-btn" id="send-email-form-btn">Send Email</div>
				<div class="my-btn" id="cancel-email-form-btn">Cancel</div>
			</div>
		</div>
		
	</body>

</html>