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
		<meta name="description" content="Contact | Remix - Music & Band Site Template HTML5 and CSS3">
		<meta name="keywords" content="remix, music, light, dark, themeforest, multi purpose, band, css3, html5">

	<!-- Styles -->
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
  background: #fefefe url('../images/bg.jpg') no-repeat;
  background-size: cover;
}
.page-content {
  margin: 20px 0;
}
.company-name {
  height: 50px;
  border-bottom: 1px solid rgba(161, 161, 161, 0.25);
}
.company-name .company {
  width: 150px;
  margin: 0 auto;
}
.company-name .company a {
  text-decoration: none;
  line-height: 80px;
}
.register-main {
  margin-top: 10px;
}
.register-main p {
  color: #000000;
  font-family: 'Raleway', sans-serif;
  font-size: 24px;
  font-weight: 600;
  text-transform: uppercase;
  text-align: center;
}
p {
  margin-bottom: 0px;
}

.register-main .register-block {
  margin-top: 20px;
  background: rgba(17, 17, 17, 0.5);
}
.register-main .register-block .sign-up {
  padding-top: 24px;
  padding-bottom: 60px;
}
.register-main .register-block .sign-up p {
  font-family: 'Raleway', sans-serif;
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  color: #ffffff;
  text-align: center;
  padding-bottom: 30px;
  border-bottom: 2px solid rgba(161, 161, 161, 0.25);
  margin-bottom: 22px;
  letter-spacing: 0.5px;
}
.register-main .register-block .sign-up p span a {
  font-family: 'Raleway', sans-serif;
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  color: #33b5e5;
  text-decoration: none;
  text-align: center;
}
.register-main .register-block .sign-up label {
  color: #ffffff;
  font-family: 'Raleway', sans-serif;
  font-size: 14px;
  font-weight: 600;
  text-transform: capitalize;
  line-height: 20px;
}
.register-main .register-block .sign-up input {
  background-color: #f9f9f9;
}
.register-main .register-block .sign-up .form-control {
  border-radius: 0;
  height: 45px;
  border: 0;
}
.register-main .register-block .sign-up .form-control:focus {
  outline: 0;
  box-shadow: none;
  border: 0;
}
.register-main .register-block .sign-up .submit-btn {
  margin-top: 18px;
  border-radius: 0;
  border: 0;
  height: 48px;
  width: 100%;
  background-color: #33b5e5;
  color: #ffffff;
  font-family: 'Raleway', sans-serif;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  line-height: 48px;
  padding: 0px;
  -webkit-transition: all 0.2s ease-in-out;
  -moz-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  border: 1px solid #33b5e5;
}
.register-main .register-block .sign-up .submit-btn:focus {
  outline: 0;
  box-shadow: none;
  border: 0;
  background: #ffffff;
  color: #33b5e5;
}
.register-main .register-block .sign-up .submit-btn:hover {
  background: #1a9bcb;
  color: #FFFFFF;
}
	</style>
	
</head>
<body id="fluidGridSystem">

<div class="page-content">

<div class="company-name">
        <div class="container company">
            <a href="#">
                <img src="images/logo.png" alt="logo">
            </a>
        </div>
    </div>
    <!--    end of company-name-->
    <!--    register-block-->
    <div class="register-main">
        <div class="container">
            <p>register</p>
            <div class="col-md-offset-4 col-md-4 register-block">
                <!--                sign-up-->
                <div class="sign-up">
                    <p>Already have an account? <span><a href="#">Sign in Now</a></span>
                    </p>
                    <form role="form" method="post" action="index.html">
                        <div class="form-group">
                            <label for="username">user name</label>
                            <input type="text" class="form-control" id="username" placeholder="UserName *" required="">
                        </div>
                        <div class="form-group">
                            <label for="email-addr">Email address</label>
                            <input type="email" class="form-control" id="email-addr" placeholder="Email Address *" required="">
                        </div>
                        <div class="form-group">
                            <label for="Password1">Password</label>
                            <input type="password" class="form-control" id="Password1" placeholder="Password *" required="">
                        </div>
                        <div class="form-group">
                            <label for="Password2">Confirm Password</label>
                            <input type="password" class="form-control" id="Password2" placeholder="Confirm Password *" required="">
                        </div>
                        <button type="submit" class="btn btn-default submit-btn">Submit now</button>
                    </form>
                </div>
                <!--                end of sign-up-->
            </div>
        </div>
    </div>
</div>
		<?php include 'footer.php'; ?>

	</div><!-- end layout -->
<!-- Scripts -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	
</body>
</html>