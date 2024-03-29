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
		<script src="js/ttw-music-player-min.js"></script>
		<script>
		var myPlaylist = [];
			$(document).ready(function()
			{
				
				
				<?php if (!isset($_GET['a_id'])) {?>
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
					var tag="<span> Tags: </span><a href='search.php?search="+data.tasks[0].artist_details +"'class='#'>"+data.tasks[0].artist_details+" </a> <a href='mp3s.php?lang="+ data.tasks[0].language +"'class='#'>"+data.tasks[0].language+" </a> <a href='search.php?search="+ data.tasks[0].music_director +"'class='#'>"+data.tasks[0].music_director+" </a>";
					$(tag).appendTo("#tags");
					
					//Breadcrumbs
					var bred="<li><a href='index.php' class='toptip' title='Homepage'> <i class='icon-home'></i> </a></li><li><a href='mp3s.php'> Songs </a></li>\<li><a href='mp3s.php?lang="+data.tasks[0].language+"'>"+data.tasks[0].language+"</a></li><li> "+data.tasks[0].album_name+" </li>";
					$(bred).appendTo("#breadcrumbs");
					
					$.each(data.tasks, function(i,tasks)
				{
					//alert (data.tasks);
				
					
					$.each(data.tasks[j], function(i,tasks)
					{
						
					myPlaylist[j] = {
					mp3: 'music/demo_songs/'+data.tasks[j].demo_song,
					//oga: 'music/5.ogg',
					title: data.tasks[j].song_name,
					artist: data.tasks[0].music_director,
					rating: '3',
					//buy:'addtocart.php?song_id='+data.tasks[j].song_id+'&album_id='+data.tasks[j].album_id+'&base_url_al='+window.location.href,
					buy:'addtocart.php?song_id='+data.tasks[j].song_id+'&album_id='+data.tasks[j].album_id,
					price: data.tasks[j].price,
					duration: data.tasks[j].demo_song_duration,
					cover: 'images/albums/'+data.tasks[j].album_img};
				    
					//console.log (myPlaylist[j]);
					
					
		
				j=j+1;
			
			});
				});
				});
				<?php }?>
			});
		</script>
			
			<!-- start Related search -->
			<script>
			var albumId="<?php echo $_GET['a_id'];?>";
			url='relatedalbums/'+albumId;
			
			var j=0;
			test_ajax_data('GET',url, function(data)
			{
				$.each(data.tasks[j], function(i,tasks)
				{
					var relatedSearch = "<li><a class=\"m-thumbnail\" href=\"albums.php?a_id="+data.tasks[j].id+"\"><img width=\"50\" height=\"50\" src='images/albums/"+data.tasks[j].album_img+"' alt='#'></a><h3><a href=\"albums.php?a_id="+data.tasks[j].id+"\">"+data.tasks[j].album_name+"</a></h3><span> "+data.tasks[j].music_director+" </span><span> "+data.tasks[j].album_year+" </span></li>";	
					j=j+1;
					$(relatedSearch).appendTo("#relatedSearch");
					
					var relatedheader = "<h4> Popular By <span>"+data.tasks[j].music_director+"</span> </h4><span class=\"liner\"></span>";
					$(relatedheader).appendTo("#relatedheader");
				});
				
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
								<!-- <span> <i class="icon-user mi"></i> Admin </span>
								<span> <i class="icon-time mi"></i>June 10, 2015 2:00 AM </span> -->
							</div><!-- meta -->
						</div><!-- post -->
					</div><!-- def block -->
				</div><!-- span8 posts -->

				<div class="span4 sidebar">
					<div class="def-block widget">
						<div id="relatedheader"></div>
						<div class="widget-content row-fluid">
							<div class="mtracks popular-by-person">
								<div class="content">
									<ul class="tab-content-items">
									<div id="relatedSearch"></div>
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