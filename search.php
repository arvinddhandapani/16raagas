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

	<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="style.css" id="dark" media="screen" />
		<link id="light" media="screen" href="styles/light.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/icons/icons.css" media="screen" />
		<!--<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>-->

	<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/icons/font-awesome-ie7.min.css" />
	<![endif]-->
			<script src="js/jquery.min.js"></script>
		<script src="js/ajaxGetPost.js"></script>
		<script>
			$(document).ready(function()
			{
				var encode="<?php if (isset($_GET['search'])) {
				echo ($_GET['search']);
				} else {
					echo "all";
					};?>";
	
			
				var url;
			
				url='search/'+encode;
		
				test_ajax_data('GET',url, function(data)
				{
					
					var j=0;
					$.each(data.tasks, function(i,tasks)
				{
					
					$.each(data.tasks[j], function(i,tasks)
					{
						var html="<li><a class=\"m-thumbnail\" href='albums.php?album="+data.tasks[j].album_name+"&a_id="+data.tasks[j].id+"'><img width=\"50\" height=\"50\" src='images/albums/"+data.tasks[j].album_img+"' alt='#'></a><h3><a href='albums.php?album="+data.tasks[j].album_name+"&a_id="+data.tasks[j].id+"'>"+data.tasks[j].album_name+"</a></h3><span>Music Director: "+data.tasks[j].music_director+"</span></li>";
						
						
					
				$(html).appendTo("#albumList");
				j=j+1;
				});
				});
				});
				var url1;
				url1='searchSong/'+encode;
		
				test_ajax_data('GET',url1, function(data)
				{
					
					var j=0;
					$.each(data.tasks, function(i,tasks)
				{
					
					$.each(data.tasks[j], function(i,tasks)
					{
						var html="<li><a class=\"m-thumbnail\" href='albums.php?album="+data.tasks[j].album_name+"&a_id="+data.tasks[j].id+"'><img width=\"50\" height=\"50\" src='images/albums/"+data.tasks[j].album_img+"' alt='#'></a><h3><a href='albums.php?album="+data.tasks[j].album_name+"&a_id="+data.tasks[j].id+"'>"+data.tasks[j].album_name+"</a></h3><h9>Song Name: "+data.tasks[j].song_name+"</h9><span>Artists: "+data.tasks[j].artist_details+"</span><span>Music Director: "+data.tasks[j].music_director+"</span></li>";
						
						
					
				$(html).appendTo("#songList");
				j=j+1;
				});
				});
				});
				
		});
			</script>
		
		
		
		
		
</head>
<body id="fluidGridSystem">
	<div id="layout" class="full">
		<?php include 'header.php'; ?>

		<div class="under_header">
			<img src="images/assets/breadcrumbs5.png" alt="#">
		</div><!-- under header -->

		<div class="page-content back_to_up">
			<div class="row clearfix mb">
				<div class="breadcrumbIn">
					<ul>
						<li><a href="index.html" class="toptip" title="Homepage"> <i class="icon-home"></i> </a></li>
						<li> Search for: Item </li>
					</ul>
				</div><!-- breadcrumb -->
			</div><!-- row -->

			<div class="row row-fluid clearfix mbf">
				<div class="posts">
					<div class="grid_5">
						<div class="def-block widget">
							<h4> Albums </h4><span class="liner"></span>
							<div class="widget-content">
								<ul class="tab-content-items">
										<div id="albumList"></div>
								</ul>
							</div><!-- widget content -->
						</div><!-- block -->
					</div><!-- grid -->
					<div class="grid_5">
						<div class="def-block widget">
							<h4> Songs </h4><span class="liner"></span>
							<div class="widget-content">
								<ul class="tab-content-items">
										<div id="songList"></div>
								</ul>
							</div><!-- widget content -->
						</div><!-- block -->
					</div><!-- grid -->
				<!--
					<div class="grid_7">
										<div class="def-block widget">
											<h4> Videos </h4><span class="liner"></span>
											<div class="widget-content">
												<div class="video-grid clearfix">
													<a href="video_single_wide.html" class="grid_6">
														<img src="images/assets/videos3.jpg" alt="#">
														<span><strong>Alfered Graceful</strong>Tonight (Remix)</span>
													</a>
													<a href="video_single_wide.html" class="grid_6">
														<img src="images/assets/videos6.jpg" alt="#">
														<span><strong>Dj Back</strong>I Like It (Radio Edit)</span>
													</a>
													<a href="video_single_wide.html" class="grid_6">
														<img src="images/assets/videos7.jpg" alt="#">
														<span><strong>Anna</strong>Bad Dog</span>
													</a>
													<a href="video_single_wide.html" class="grid_6">
														<img src="images/assets/videos8.jpg" alt="#">
														<span><strong>Armando</strong>On Time</span>
													</a>
												</div>
											</div><!-- widget content -->
										<!--</div>--><!-- block -->
									<!--</div>--><!-- grid -->-->
				

				</div><!-- posts -->

			</div><!-- row clearfix -->
		</div><!-- end page content -->

		<?php include 'footer.php'; ?>

	</div><!-- end layout -->
<!-- Scripts -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/theme20.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	
</body>
</html>