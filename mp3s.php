<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie9" xmlns="http://www.w3.org/1999/xhtml" lang="en-US"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<!--<![endif]-->
<head>
	<title>16RaaGas - Music Download</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Seo Meta -->
		<meta name="description" content="16RaaGa - Music & Music Store">
		<meta name="keywords" content="16RaaGa, music, light, MP3 Store">

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
		<script src="js/jquery.min.js"></script>
		<script src="js/ajaxGetPost.js"></script>
		<script>
			$(document).ready(function()
			{
				
			<?php if (!isset($_GET['sort'])) {?>
			var encode="<?php if (isset($_GET['lang'])) {
			echo ($_GET['lang']);
			} else {
				echo "tamil";
				};?>";
	
			
			var url,encodedata;
			//$("#update").focus();

			/* Load Updates */
			//url=base_url+'albumsLanguage/'+encode;
			url='albumsLanguage/'+encode;
			encodedata='';
			//ajax_data('GET',url, function(data)
			test_ajax_data('GET',url, function(data)
			{
				var j=0;
				$.each(data.tasks, function(i,tasks)
			{
				//alert (data.tasks);
				$.each(data.tasks[j], function(i,tasks)
				{
					//alert (data.tasks[j].album_name);	
					var html="<li class='grid_6'><a class='m-thumbnail' href='mp3_single_half.php'><img width='50' height='50' src='images/albums/"+data.tasks[j].album_img+"' alt='#'></a><h3><a href='albums.php?album="+data.tasks[j].album_name+"&a_id="+data.tasks[j].id+"'>"+data.tasks[j].album_name+"</a></h3><span>"+data.tasks[j].music_director+" </span></li>";
				//var html="<div class='news row-fluid animtt' data-gen='fadeUp'><div class='span5'><img class='four-radius' src='images/albums/"+data.tasks[j].album_img+"'alt='#'></div><div class='span7'><h3 class='news-title'> <a href='mp3_single_half.php'>"+data.tasks[j].album_name+"</a> </h3><p>"+data.tasks[j].album_desc+"</p><a href='' class='sign-btn tbutton small'><span>Buy Now</span></a></div></div>";
			$(html).appendTo("#songlist");
		
			j=j+1;
			
		});
			});
			});
			<?php } else {?>
				var encode="<?php if (isset($_GET['lang'])) {
				echo ($_GET['lang']);
				} else {
					echo "tamil";
					};?>";
					var sort="<?php echo ($_GET['sort']);?>"
			
				var url,encodedata;
				url='albumsLanguageSwitch/'+encode+'/'+sort;
				encodedata='';
				test_ajax_data('GET',url, function(data)
				{
					var j=0;
					$.each(data.tasks, function(i,tasks)
				{
					//alert (data.tasks);
					$.each(data.tasks[j], function(i,tasks)
					{
						var html="<li class='grid_6'><a class='m-thumbnail' href='mp3_single_half.php'><img width='50' height='50' src='images/albums/"+data.tasks[j].album_img+"' alt='#'></a><h3><a href='albums.php?album="+data.tasks[j].album_name+"&a_id="+data.tasks[j].id+"'>"+data.tasks[j].album_name+"</a></h3><span>"+data.tasks[j].music_director+" </span></li>";
				$(html).appendTo("#songlist");
		
				j=j+1;
			
			});
				});
				});
				<?php }?>
			});
		</script>

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/icons/font-awesome-ie7.min.css" />
	<![endif]-->
</head>
<body id="fluidGridSystem">
	<div id="layout" class="full">
		<?php include 'header.php';?>

		<div class="under_header">
			<img src="images/assets/breadcrumbs10.png" alt="#">
		</div><!-- under header -->

		<div class="page-content back_to_up">
			<div class="row clearfix mb">
				<div class="Alphabet">
					<ul>
						<?php
						if (isset($_GET['lang'])) {
							$language = $_GET['lang'];
						} else {
							$language = "tamil";
						}
						?>
						<li class="active"><a href="?lang=<?php echo $language;?>&sort=all"> Browse All </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=A"> A </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=B"> B </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=C"> C </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=D"> D </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=E"> E </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=F"> F </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=G"> G </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=H"> H </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=I"> I </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=J"> J </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=K"> K </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=L"> L </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=M"> M </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=N"> N </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=O"> O </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=P"> P </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=Q"> Q </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=R"> R </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=S"> S </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=T"> T </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=U"> U </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=V"> V </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=W"> W </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=X"> X </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=Y"> Y </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=Z"> Z </a></li>
						<li><a href="?lang=<?php echo $language;?>&sort=all"> 0-9 </a></li>
						<li><a href="#"> Other Artists </a></li>
					</ul>
				</div><!-- breadcrumb -->
			</div><!-- row -->

			<div class="row row-fluid clearfix mbf">
				<div class="span8 posts">
					<div class="def-block">
						<ul class="tabs">
							<li><a href="#Latest" class="active"> Latest MP3's </a></li>
						<!--
							<li><a href="#Featured"> Featured </a></li>
													<li><a href="#Albums"> New Albums</a></li>
													<li><a href="#Soon"> Comming Soon </a></li>-->
						
						</ul><!-- tabs -->

						<ul class="tabs-content">
							<li id="Latest" class="active">
								<div class="post no-border no-mp clearfix">
									<ul class="tab-content-items">
										<div id="songlist"></div>
									</ul>
								</div><!-- latest -->
							</li><!-- tab content -->

							<li id="Featured">
								<div class="post no-border no-mp clearfix">
									<ul class="tab-content-items">
										<li class="grid_6">
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/thumb-mp3-6.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Skyfool ( Dubstep Remix )</a></h3>
											<span> Babel </span>
											<span> 4,451,748 Plays </span>
										</li>
										<li class="grid_6">
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/thumb-mp3-7.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Don’t go mary ( Remix )</a></h3>
											<span> Alexander </span>
											<span> 3,582,250 Plays </span>
										</li>
										<li class="grid_6">
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/thumb-mp3-8.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">That's My Kind Of Night </a></h3>
											<span> Alexander Mikoole </span>
											<span> 3,258,879 Plays </span>
										</li>
										<li class="grid_6">
											<a class="m-thumbnail" href="mp3_single_half.php"><img width="50" height="50" src="images/assets/thumb-mp3-9.jpg" alt="#"></a>
											<h3><a href="mp3_single_half.php">Magna Carta... Holy Grail </a></h3>
											<span> Joe </span>
											<span> 1,992,244 Plays </span>
										</li>
									</ul>
								</div><!-- latest -->
							</li><!-- tab content -->

							<li id="Albums">
								<div class="mp3-albums">
									<a href="mp3_play_list.html" class="grid_3">
										<img src="images/assets/album1.jpg" alt="#">
										<span><strong>Michele Jordan</strong>New Day</span>
									</a>
									<a href="mp3_play_list.html" class="grid_3">
										<img src="images/assets/album2.jpg" alt="#">
										<span><strong>Dj Alaska</strong>No Name No Number</span>
									</a>
									<a href="mp3_play_list.html" class="grid_3">
										<img src="images/assets/album3.jpg" alt="#">
										<span><strong>Alexander Lea</strong>R.T.O 2</span>
									</a>
									<a href="mp3_play_list.html" class="grid_3">
										<img src="images/assets/album4.jpg" alt="#">
										<span><strong>Jessica Alma</strong>Love Rock'n Roll</span>
									</a>
									<a href="mp3_play_list.html" class="grid_3">
										<img src="images/assets/album5.jpg" alt="#">
										<span><strong>Bob Jexman</strong>Your Heart in my Hand</span>
									</a>
									<a href="mp3_play_list.html" class="grid_3">
										<img src="images/assets/album6.jpg" alt="#">
										<span><strong>Abele</strong>Set Rain to The Fire</span>
									</a>
								</div><!-- mp3 albums -->
							</li><!-- tab content -->

							<li id="Soon">
								<p>Nulla id ligula arcu. Integer et tincidunt lectus. Duis id ligula diam, quis dapibus erat. Curabitur nec libero et est vulputate sollicitudin. Fusce sit amet turpis sed mauris volutpat posuere.</p>
								<div class="news row-fluid">
									<div class="span5"><img class="four-radius" src="images/assets/news1.jpg" alt="#"></div>
									<div class="span7">
										<h3 class="news-title"> Michele Jordan Release New Album in September 2014 </h3>
										<p>Nine Inch Nails aren't on the bill, and they won't play the fest anytime soon. Soundwave promoter AJ Maddah started a Twitter war-of-words with a few choice comments about NIN's Trent Reznor. mauris volutpat posuere. Morbi vulputate, odio eget adipiscing faucibus, lorem ipsum facilisis justo, gravida tempus orci nisi ac eros. Pellentesque metus dolor.</p>
									</div><!-- span7 -->
								</div><!-- news -->
								<div class="news row-fluid">
									<div class="span5"><img class="four-radius" src="images/assets/news3.jpg" alt="#"></div>
									<div class="span7">
										<h3 class="news-title"> New Track Named Without You (Remix) </h3>
										<p>Nine Inch Nails aren't on the bill, and they won't play the fest anytime soon. Soundwave promoter AJ Maddah started a Twitter war-of-words with a few choice comments about NIN's Trent Reznor. mauris volutpat posuere. Morbi vulputate, odio eget adipiscing faucibus, lorem ipsum facilisis justo, gravida tempus orci nisi ac eros. Pellentesque metus dolor.</p>
									</div><!-- span7 -->
								</div><!-- news -->
							</li><!-- tab content -->

						</ul><!-- end tabs -->

					</div><!-- def block -->
				</div><!-- span8 posts -->

				<div class="def-block widget animtt" data-gen="fadeUp" style="opacity:0;">
						<h4> Tags </h4><span class="liner"></span>
						<div class="widget-content tags">
							<a href="#" class="#" title="17 topic"><i class="icon-tag"></i> mp3 </a>
							<a href="#" class="#" title="44 topic"><i class="icon-tag"></i> interview </a>
							<a href="#" class="#" title="10 topic"><i class="icon-tag"></i> video </a>
							<a href="#" class="#" title="20 topic"><i class="icon-tag"></i> ogg </a>
							<a href="#" class="#" title="2 topic"><i class="icon-tag"></i> fl studio </a>
							<a href="#" class="#" title="29 topic"><i class="icon-tag"></i> dj angel </a>
							<a href="#" class="#" title="4 topic"><i class="icon-tag"></i> remix </a>
						</div><!-- widget content -->
					</div><!-- def block widget tags -->
			</div><!-- row clearfix -->
		</div><!-- end page content -->

		<?php include 'footer.php'; ?>

	</div><!-- end layout -->
<!-- Scripts -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/theme20.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>