<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie9" xmlns="http://www.w3.org/1999/xhtml" lang="en-US"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<!--<![endif]-->
<head>
	<title>Contact | 16RaaGas - Music Download</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Seo Meta -->
		<meta name="description" content="16RaaGas - Music & Music Store">
		<meta name="keywords" content="16RaaGas, music, light, MP3 Store">

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
</head>
<body id="fluidGridSystem">
	<div id="layout" class="full">
		
		<?php include 'header.php'; ?>
		
		<div class="under_header">
			<img src="images/assets/breadcrumbs.png" alt="#">
		</div><!-- under header -->

		<div class="page-content back_to_up">
			<div class="row clearfix mb">
				<div class="breadcrumbIn">
					<ul>
						<li><a href="index.html" class="toptip" title="Homepage"> <i class="icon-home"></i> </a></li>
						<li> Contact </li>
					</ul>
				</div><!-- breadcrumb -->
			</div><!-- row -->

			<div class="row row-fluid clearfix mbf">
				<div class="span8 posts">
					<div class="def-block clearfix">
						<h4> Contact With US </h4><span class="liner"></span>
						<p>  </p>
						<form method="post" id="contactForm" action="">
							<div class="clearfix">
								<div class="grid_6 alpha fll"><input type="text" name="senderName" id="senderName" placeholder="Name *" class="requiredField" /></div>
								<div class="grid_6 omega flr"><input type="text" name="senderEmail" id="senderEmail" placeholder="Email Address *" class="requiredField email" /></div>
							</div>
							<div><textarea name="message" id="message" placeholder="Message *" class="requiredField" rows="8" column="10" ></textarea></div>
							<input type="submit" id="sendMessage" name="sendMessage" value="Send Email" />
							<span>  </span>
						</form><!-- end form -->
					</div><!-- def block -->
				</div><!-- span8 posts -->

				<div class="span4 sidebar">
					<div class="def-block widget">
						<h4> Get in Touch </h4><span class="liner"></span>
						<div class="widget-content">
							<div id="map" class="mb"></div>
							<p>Raam Data Systems,
							"LAKSHMI VILAS", 
							1st floor, No. 16, Arokia Madha Nagar 1st Street,  
							Little Mount,
							Chennai - 600 015,
							Tamilnadu, India. </p>
							<p>Phone: <strong> +91 44 22300310, 22200310.</strong> <br> Email: <strong>saravinds@hotmail.com </strong></p>
						</div><!-- widget content -->
					</div><!-- def block widget details -->

					<div class="def-block widget">
						<h4> NewsLetters </h4><span class="liner"></span>
						<div class="widget-content">
							<p>It has survived not only five centuries, but also the leap into electronic typesetting.</p>
							<form id="newsletters" method="post" action="http://feedburner.google.com/fb/a/mailverify" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=sevenpsd', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
								<input type="email" onfocus="if (this.value=='Type Your Email') this.value = '';" onblur="if (this.value=='') this.value = 'Type Your Email';" value="Type Your Email" placeholder="Type Your Email" required="required">
								<button type="submit"><i class="icon-ok"></i></button>
							</form>
						</div><!-- widget content -->
					</div><!-- def block widget NewsLetters -->

				</div><!-- span4 sidebar -->
			</div><!-- row clearfix -->
		</div><!-- end page content -->

		<?php include 'footer.php'; ?>

	</div><!-- end layout -->
<!-- Scripts -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/theme20.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/gmap3.js"></script>
	<script type="text/javascript">
	/* <![CDATA[ */
		jQuery(function () {
		    jQuery("#map").gmap3({
		        marker: {
		            address: "Chennai"
		        },
		        map: {
		            options: {
		                zoom: 10
		            }
		        }
		    });
		});
	/* ]]> */
	</script>
</body>
</html>