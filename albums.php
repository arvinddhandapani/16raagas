<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie9" xmlns="http://www.w3.org/1999/xhtml" lang="en-US"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<!--<![endif]-->
<head>
	<title>MP3 Track Missing You  | 16RaaGas</title>
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
		<!--<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>-->
		<link id="light" media="screen" href="styles/light.css" type="text/css" rel="stylesheet">

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
				var myPlaylist = [];
				<?php if (!isset($_GET['album']) || !isset($_GET['a_id'])) {?>
					window.location.href="mp3s.php";
					<?} else {?>
			
						var encode="<?php echo $_GET['a_id'];?>";
				
					
			
				url='album/'+encode;
				encodedata='';
				test_ajax_data('GET',url, function(data)
				{
					var j=0;
					//description
					var album_desc="<p>"+data.tasks[0].album_desc+"</p>";
					$(album_desc).appendTo("#description");
					
					//tags
					var tag="<span> Tags: </span><a href='search.php?artist="+data.tasks[0].artist_details +"'class='#'>"+data.tasks[0].artist_details+" </a>,<a href='mp3s.php?lang="+ data.tasks[0].language +"'class='#'>"+data.tasks[0].language+" </a>";
					$(tag).appendTo("#tags");
					
					//Breadcrumbs
					var bred="<li><a href='index.html' class='toptip' title='Homepage'> <i class='icon-home'></i> </a></li><li><a href='mp3s.html'> Songs </a></li>\<li><a href='mp3s.php?lang="+data.tasks[0].language+"'>"+data.tasks[0].language+"</a></li><li> "+data.tasks[0].album_name+" </li>";
					$(bred).appendTo("#breadcrumbs");
					
					$.each(data.tasks, function(i,tasks)
				{
					//alert (data.tasks);
					
					
					$.each(data.tasks[j], function(i,tasks)
					{
					/*	myplaylist[
							mp3:'music/Bagulu Odayum Dagulu Mari.mp3',
							oga:'music/5.ogg',
							title:'ok kanmani',
							artist:'A. R. Rahman',
							rating:5,
							buy:'#',
							price:'29.99',
							duration:'03.25',
							cover:'music/maari.jpg'	];
							$('.music-single').ttwMusicPlayer(myPlaylist, {
								currencySymbol:'<del>&#2352;</del>',
								buyText:'Add to Cart',
								tracksToShow:3,
								ratingCallback:function(index, playlistItem, rating){
									//some logic to process the rating, perhaps through an ajax call
								},
								jPlayer:{
									swfPath:'../../../www.jplayer.org/2.1.0/js'
								},
								autoPlay:false
							});
						});
						}*/
						
					
		
				j=j+1;
			
			});
				});
				});
				<?php }?>
			});
		</script>
		
		
		
</head>
<body id="fluidGridSystem">
	<div id="layout" class="full">	
	   <?php include 'header.php'; ?>
	
		<div class="under_header">
			<img src="images/assets/breadcrumbs2.png" alt="#">
		</div><!-- under header -->

		<div class="page-content back_to_up">
			<div class="row clearfix mb">
				<div class="breadcrumbIn">
					<ul>
						
						<div id="breadcrumbs"></div>
					</ul>
				</div><!-- breadcrumb -->
			</div><!-- row -->

			<div class="row row-fluid clearfix mbf">
				<div class="span8 posts">
					<div class="def-block">
						<div class="post row-fluid clearfix">
							<div class="music-single mbf clearfix"></div><!-- Player -->
							
							<div id="description"></div>
							<p>
								
								<div id="tags"></div>
							</p><!-- tags -->

							<div class="meta">
								<span> <i class="icon-user mi"></i> Admin </span>
								<span> <i class="icon-time mi"></i>June 10, 2015 2:00 AM </span>
							</div><!-- meta -->
						</div><!-- post -->
					</div><!-- def block -->
				</div><!-- span8 posts -->

				<div class="span4 sidebar">
					<div class="def-block widget">
						<h4> Popular By <span>A. R. Rahman</span> </h4><span class="liner"></span>
						<div class="widget-content row-fluid">
							<div class="mtracks popular-by-person">
								<div class="content">
									<ul class="tab-content-items">
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander1.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Roja 1992</a></h3>
											<span> A. R. Rahman </span>
											<span> 922,250 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander2.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Gentleman 1993</a></h3>
											<span> A. R. Rahman </span>
											<span> 838,879 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander3.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Duet 1994</a></h3>
											<span> A. R. Rahman </span>
											<span> 772,240 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander4.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Kadhalan 1994</a></h3>
											<span> A. R. Rahman </span>
											<span> 668,471 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander1.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Bombay 1995</a></h3>
											<span> A. R. Rahman </span>
											<span> 550,105 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander2.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Indian 1996</a></h3>
											<span> A. R. Rahman </span>
											<span> 441,748 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander3.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Jeans 1998</a></h3>
											<span> A. R. Rahman </span>
											<span> 382,250 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander4.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Jodi 1999</a></h3>
											<span> A. R. Rahman </span>
											<span> 228,879 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander3.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Rhythm 2000</a></h3>
											<span> A. R. Rahman </span>
											<span> 122,240 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander4.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Lagaan 2001</a></h3>
											<span> A. R. Rahman </span>
											<span> 80,471 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander1.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Boys 2003</a></h3>
											<span> A. R. Rahman </span>
											<span> 80,105 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander2.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">New 2004</a></h3>
											<span> A. R. Rahman </span>
											<span> 60,748 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander3.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Guru 2007</a></h3>
											<span> A. R. Rahman </span>
											<span> 509,240 Plays </span>
										</li>
										<li>
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/alexander4.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Raavan 2010</a></h3>
											<span> A. R. Rahman </span>
											<span> 48,471 Plays </span>
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
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/jquery.jplayer.js"></script>
	<script type="text/javascript" src="js/ttw-music-player-min.js"></script>
	<script type="text/javascript" src="music/single-track.js"></script>
	<script type="text/javascript" src="js/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>