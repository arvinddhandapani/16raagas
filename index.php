<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie9" xmlns="http://www.w3.org/1999/xhtml" lang="en-US"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<!--<![endif]-->
<head>
	<title>16RaaGa - Music Store</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Seo Meta -->
		<meta name="description" content="16RaaGa - Music & Music Store">
		<meta name="keywords" content="16RaaGa, music, light, MP3 Store">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="style.css" id="dark" media="screen" />
	<link id="light" media="screen" href="styles/light.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles/icons/icons.css" media="screen" />
	<!-- <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'> -->
	
	<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
		<script src="js/jquery.min.js"></script>
		<script src="js/ajaxGetPost.js"></script>
		<script>
			$(document).ready(function()
			{
			//var base_url="http://127.0.0.1/16raagas/v1/";
			var base_url="http://localhost:8888/adhandapani/16raagas/16raagas/v1/";
			var url,encodedata;
			//$("#update").focus();

			/* Load Updates */
			url=base_url+'albums';
			encodedata='';
			ajax_data('GET',url, function(data)
			{
				var j=0;
				$.each(data.tasks, function(i,tasks)
			{
				$.each(data.tasks[j], function(i,tasks)
				{
					if (j<4){
						
				var html="<div class='news row-fluid animtt' data-gen='fadeUp'><div class='span5'><img class='four-radius' src='images/albums/"+data.tasks[j].album_img+"'alt='#'></div><div class='span7'><h3 class='news-title'> <a href='mp3_single_half.php'>"+data.tasks[j].album_name+"</a> </h3><p>"+data.tasks[j].album_desc+"</p><a href='' class='sign-btn tbutton small'><span>Buy Now</span></a></div></div>";
			$(html).appendTo("#mainContent");
		}
			j=j+1;
			
		});
			});
			});
			});
		</script>

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/icons/font-awesome-ie7.min.css" />
	<![endif]-->
</head>
<body id="fluidGridSystem">
<?php include 'header.php'; ?>
<?php include 'slider.php'; ?>

		<div class="page-content">
			<div class="row clearfix mbf">
				<div class="music-player-list"></div>
			</div><!-- row music player -->

			<div class="row row-fluid clearfix mbf">
				<div class="span8">
					<div class="def-block">
						<h4> Latest Releases </h4><span class="liner"></span>
							<div id="mainContent">
								
							</div>
						<div class="load-news tac"><a href="#" class="tbutton small"><span>Load More</span></a></div>
					</div><!-- def block -->
				</div><!-- span8 news -->

				<div class="span4">
					<div class="def-block widget animtt" data-gen="fadeUp" style="opacity:0;">
						<h4> Events </h4><span class="liner"></span>
						<div class="widget-content row-fluid">
							<div class="span3 tac">
								<span class="event-date">25</span>
								<span class="event-month">aug</span>
							</div>
							<div class="span9">
								<p>Bono Serenades Warren Buffet at NYC Event.</p>
								<a href="#" class="tbutton buy-ticket small"><span>Buy Ticket</span></a>
							</div>
						</div><!-- widget content -->
					</div><!-- def block widget events -->

					<div class="def-block widget animtt" data-gen="fadeUp" style="opacity:0;">
						<h4> Featured Videos </h4><span class="liner"></span>
						<div class="widget-content row-fluid">
							<div class="videos clearfix flexslider">
								<ul class="slides">
									<li class="featured-video">
										<a href="video_single_wide.html">
											<img src="images/assets/video1.jpg" alt="#">
											<i class="icon-play-sign"></i>
											<h3>I Know You Want Me</h3>
											<span>Fitbull</span>
										</a>
									</li><!-- slide -->
									<li class="featured-video">
										<a href="video_single_wide.html">
											<img src="images/assets/video2.jpg" alt="#">
											<i class="icon-play-sign"></i>
											<h3>I Like It</h3>
											<span>Enrique</span>
										</a>
									</li><!-- slide -->
									<li class="featured-video">
										<a href="video_single_wide.html">
											<img src="images/assets/video3.jpg" alt="#">
											<i class="icon-play-sign"></i>
											<h3>Tommorow</h3>
											<span>Dj Michele</span>
										</a>
									</li><!-- slide -->
								</ul>
							</div>
						</div><!-- widget content -->
					</div><!-- def block widget videos -->

					<div class="def-block widget animtt" data-gen="fadeUp" style="opacity:0;">
						<h4> Popular Tracks </h4><span class="liner"></span>
						<div class="widget-content row-fluid">
							<div class="mtracks">
								<div class="content">
									<ul class="tab-content-items">
										<li class="clearfix">
											<a class="m-thumbnail" href="mp3_single.html"><img width="50" height="50" src="images/assets/thumb-mp3-1.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.html">Kaladi Kanmani</a></h3>
											<span> Illayaraja </span>
											<span> 1,892,250 Plays </span>
										</li>
										<li class="clearfix">
											<a class="m-thumbnail" href="mp3_single.html"><img width="50" height="50" src="images/assets/thumb-mp3-2.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.html">Nan Kadavul</a></h3>
											<span> Yuvan Shankar Raja </span>
											<span> 998,879 Plays </span>
										</li>
										<li class="clearfix">
											<a class="m-thumbnail" href="mp3_single.html"><img width="50" height="50" src="images/assets/thumb-mp3-3.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.html">Ok Kanmani 2015 </a></h3>
											<span> A.R Rahaman </span>
											<span> 792,240 Plays </span>
										</li>
										<li class="clearfix">
											<a class="m-thumbnail" href="mp3_single.html"><img width="50" height="50" src="images/assets/thumb-mp3-4.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.html">Maari 2015</a></h3>
											<span> Anirudh R </span>
											<span> 788,471 Plays </span>
										</li>
										<li class="clearfix">
											<a class="m-thumbnail" href="mp3_single.html"><img width="50" height="50" src="images/assets/thumb-mp3-5.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.html">Burning For you</a></h3>
											<span> GV Prakash </span>
											<span> 710,105 Plays </span>
										</li>
										<li class="clearfix">
											<a class="m-thumbnail" href="mp3_single.html"><img width="50" height="50" src="images/assets/thumb-mp3-6.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.html">Skyfool</a></h3>
											<span> A.R Rahaman </span>
											<span> 611,748 Plays </span>
										</li>
									</ul>
								</div>
							</div>
						</div><!-- widget content -->
					</div><!-- def block widget popular items -->
				</div><!-- span4 sidebar -->
			</div><!-- row clearfix -->
		</div><!-- end page content -->

	<?php include 'footer.php'; ?>

	</div><!-- end layout -->
<!-- Scripts -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/theme20.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/rs-plugin/pluginsources/jquery.themepunch.plugins.min.js"></script>	
	<script type="text/javascript" src="js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/jquery.jplayer.js"></script>
	<script type="text/javascript" src="js/ttw-music-player-min.js"></script>
	<script type="text/javascript" src="music/myplaylist.js"></script>
	<script type="text/javascript" src="js/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script type="text/javascript">	
	/* <![CDATA[ */
		var tpj=jQuery;
		tpj.noConflict();
		tpj(document).ready(function() {
		if (tpj.fn.cssOriginal!=undefined)
			tpj.fn.css = tpj.fn.cssOriginal;
			var api= tpj('.revolution').revolution({
				delay:9000,
				startheight:380,
				startwidth:960,
				hideThumbs:200,
				thumbWidth:80,
				thumbHeight:50,
				thumbAmount:5,
				navigationType:"none",
				navigationArrows:"verticalcentered",
				navigationStyle:"square",	
				touchenabled:"on", 
				onHoverStop:"on", 
				navOffsetHorizontal:0,
				navOffsetVertical:20,
				shadow:0
			});
		});
	/* ]]> */
	</script>
</body>
</html>