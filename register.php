<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie9" xmlns="http://www.w3.org/1999/xhtml" lang="en-US"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<!--<![endif]-->
<head>
	<title>Contact | Remix - Music & Band Site Template HTML5 and CSS3</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Seo Meta -->
		<meta name="description" content="16RaaGas - Music & Music Store">
		<meta name="keywords" content="16RaaGas, music, light, MP3 Store">

	<!-- Styles -->
		<link href='css/style.css' rel='stylesheet' type='text/css'/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="style.css" id="dark" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/icons/icons.css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		<link id="light" media="screen" href="styles/light.css" type="text/css" rel="stylesheet">

	<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/icons/font-awesome-ie7.min.css" />
	<![endif]-->
	
	<style > 
	body {
	  margin: 0;
	  background: #eee url("../images/bg/light_bg.png") repeat scroll 0 0;
	  background-size: cover;
	}
	p {
	  margin-bottom: 0px;
	}
	</style>
			<script src="js/jquery.min.js"></script>
			<script src="js/ajaxGetPost.js"></script>

			<script>
	function register() {
		var username=$('#username').val();
		var emailaddr=$('#emailaddr').val();
		var Password1=$('#Password1').val();
		var Password2=$('#Password2').val();
		var msg="Password and Confirm Password did not match";
	 	$(msg).appendTo("#registerfailedmsg");
		if(Password1===Password2)
		{	
			
		var update=$('#username').val();
			
			var encode="name="+$('#username').val()+"&"+"email="+$('#emailaddr').val()+"&"+"password="+$('#Password1').val();
			var base_url="http://localhost:8888/adhandapani/16raagas/16raagas/v1/";
			url=base_url+'register';
			if(update.length>0)
			{
				post_ajax_data(url,encode, function(data)
				{
					   if(data.error===true){
						   var msg12="<span>"+data.message+"</span>";
						   $(msg12).appendTo("#loginfailedmsg");
						   window.location.href="register.php?register="+data.message;
						   
						   //alert(data.message);
						} else {
 						   var msg12="<span>"+data.message+"</span>";
						   alert(data.url1);
 						   $(msg12).appendTo("#loginfailedmsg");
						   window.location.href="register.php?register=success";
						   
							//alert(data.message);
						//window.location.href="session_write.php?session_id_raagas="+data.session_id_raagas+"&session_raagas_name="+data.name+"&landing="+window.location.href;
						}
				});
			}

			
	} else {
		//alert("fail");
		var msg="Password and Confirm Password did not match";
	   $(msg).appendTo("#registerfailedmsg");
	}
}
			</script>
	
</head>
<body id="fluidGridSystem">

<div class="page-content">

	<div class="company-name">
        <div class="container company">
            <a href="index.php">
                <img src="images/logo.png" alt="logo">
            </a>
        </div>
    </div>
    <!--    end of company-name-->
	
	<!-- popup login -->
	<div id="popupLogin">
		<div class="def-block widget">
			<h4> Sign In </h4><span class="liner"></span>
			<div class="widget-content row-fluid">
				<form id="popup_login_form">
					<input type="text" name="login_username" id="login_username" onfocus="if (this.value=='username') this.value = '';" onblur="if (this.value=='') this.value = 'username';" value="username" placeholder="username">
					<input type="password" name="login_password" id="login_password" onfocus="if (this.value=='password') this.value = '';" onblur="if (this.value=='') this.value = 'password';" value="password" placeholder="password">
					<a href="#" class="tbutton small"><span>Sign In</span></a>
				</form><!-- login form -->
			</div><!-- content -->
		</div><!-- widget -->
		<div id="popupLoginClose">x</div>
	</div><!-- popup login -->
	<div id="LoginBackgroundPopup"></div>
	
    <!--    register-block-->
    <div class="register-main">
		
		<?php
		if (!isset($_GET['register']) || $_GET['register']!="success") {
		?>
		
        <div class="container">
            <p>register</p>
            <div class="col-md-offset-4 col-md-4 register-block">
              
                <div class="sign-up">
					<?php
					if (!isset($_GET['register'])){
					?>
                    <p>Already have an account? <span><a id="Login_PopUp_Link" >Sign in Now</a>
					<?php
				} else {
					?>
					<p><?php echo $_GET['register'];?>
					<?php } ?>
                    </p></span>
					
                    <form role="form" method="post" onsubmit="return false;">
                        <div class="form-group">
                            <label for="username">user name</label>
                            <input type="text" class="form-control" id="username" placeholder="UserName *" required="">
                        </div>
                        <div class="form-group">
                            <label for="email-addr">Email address</label>
                            <input type="email" class="form-control" id="emailaddr" placeholder="Email Address *" required="">
                        </div>
                        <div class="form-group">
                            <label for="Password1">Password</label>
                            <input type="password" class="form-control" id="Password1" placeholder="Password *" required="">
                        </div>
                        <div class="form-group">
                            <label for="Password2">Confirm Password</label>
                            <input type="password" class="form-control" id="Password2" placeholder="Confirm Password *" required="">
                        </div>
                        <!--<div class="form-group">
                            <label for="username">Phone Number</label>
                            <input type="text" class="form-control" id="phone" placeholder="UserName *" required="">
                        </div>-->
                        <button type="submit" class="btn btn-default submit-btn" onClick="register()">Submit now</button>
                    </form>
                </div>
                <!--                end of sign-up-->
            </div>
        </div>
    </div>
	<?
} else {

	?>
    <div class="col-md-offset-4 col-md-4 register-block">
        <!--                sign-up-->
        <div class="sign-up">
            <p>A mail has been sent to you registered mail ID. Please click the link to Activate your account.</p>
		</div>
	</div>
	<?php
}
	?>
</div>
		<?php include 'footer.php'; ?>

	</div><!-- end layout -->
<!-- Scripts -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	
</body>
</html>