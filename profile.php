<!DOCTYPE html>
<?php
	session_start();
	header("Content-type: application/javascript");
?>
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
		<link rel="stylesheet" href="styles/profile.css" type="text/css" />

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
			//alert ("myorder");
		
			//alert ("<?php echo $_SESSION['session_id_raagas'];?>");
			
			<?php if (isset($_SESSION['session_id_raagas']) && isset($_SESSION['session_raagas_name'])) {?>
		var encode="user_id=<?php echo ($_SESSION['session_email_16raagas']);?>";
		var session_id_raagas="<?php echo ($_SESSION['session_id_raagas'])?>";
		var session_email_16raagas="<?php echo ($_SESSION['session_email_16raagas'])?>";
		var url;
		url='myOrder';
		var url1;
		url1='orderList';
		var j = 0;
		var k = 0;
	//Start Downloadable details
		post_ajax_data_header(url,encode,session_id_raagas, session_email_16raagas, function(data)
		{
			if (data.tasks.length > 0) {
				
			$.each(data.tasks, function(i,tasks)
				{
					if (data.tasks[j].main_song!=""){
						var mp3_download = "<small class=\"pull-right\"><a href=\"download.php?file=user_songs/"+data.tasks[j].song_sub+"/mp3/"+data.tasks[j].main_song+"\" > <i class=\"fa icon-download fa-big\"></i></a></small>";
					} else {
						var mp3_download = "";
					}
					if (data.tasks[j].main_song_wmv!=""){
						var wmv_download = "<small class=\"pull-right\"><a href=\"download.php?file=user_songs/"+data.tasks[j].song_sub+"/wmv/"+data.tasks[j].main_song_wmv+"\" > <i class=\"fa icon-download fa-big\"></i></a></small>";
					} else {
						var wmv_download = "";
					}
					//alert (data.tasks[j].main_song_wmv);
					var html ="<li class=\"list-group-item\"><a href=\""+data.tasks[j].song_name+"/"+data.tasks[j].song_name+"\" class=\"thumb-sm pull-left m-r-sm\"><img src=\"images/a0.png\" class=\"img-circle\"></a>"+mp3_download+wmv_download+"<strong class=\"block\">"+data.tasks[j].album_name+"<br><br> </strong><small>"+data.tasks[j].song_name+"</small></li>";
					$(html).appendTo("#cart1");
					
					j = j+1;
					});
			}
			else {
				var html ="<li class=\"list-group-item\"><strong class=\"block\"> Sorry there are no Songs Purchased.<br><br> </strong></li>";
				$(html).appendTo("#cart1");
			}
			/*
		
					*/
		
		});
		//End Downloadable Details
		//Start Order History
		post_ajax_data_header(url1,encode,session_id_raagas, session_email_16raagas, function(data)
		{
			if (data.tasks.length > 0) {
			$.each(data.tasks, function(i,tasks)
				{
					var orderHtml="<li class=\"list-group-item\"><strong class=\"block\"><a href=\"invoice.php?order_id="+data.tasks[k].order_id+"\">"+data.tasks[k].order_id+"</strong><small> "+data.tasks[k].order_update_date+"          </small><br><small>Rs."+data.tasks[k].order_amount+"</small></li>";
					$(orderHtml).appendTo("#orderHtml");
					k = k+1;
				});
			
			}
		});
		
		
		
		//end Order history
		
		<?php } else {?>
		   var msg="<span>Please login to Continue</span>";
		   $(msg).appendTo("#loginfailedmsg");
		var popupStatus = 0;
		//Aligning our box in the middle
		var windowWidth = document.documentElement.clientWidth;
		var windowHeight = document.documentElement.clientHeight;
		var popupHeight = $("#popupLogin").height();
		var popupWidth = $("#popupLogin").width();
		// Centering
		$("#popupLogin").css({
			"top": windowHeight / 2 - popupHeight / 2,
			"left": windowWidth / 2 - popupWidth / 2
		});
		// Aligning bg
		$("#LoginBackgroundPopup").css({"height": windowHeight});

		// Pop up the div and Bg
		if (popupStatus == 0) {
			$("#LoginBackgroundPopup").css({"opacity": "0.7"});
			$("#LoginBackgroundPopup").fadeIn("slow");
			$("#popupLogin").addClass('zigmaIn').fadeIn("slow");
			popupStatus = 1;
		}
			//}
		<?php }?>
	});
		</script>
	
</head>
<body id="fluidGridSystem">
	<div id="layout" class="full">
	<?php include 'header.php'; ?>
		<div class="under_header">
			<img src="images/assets/breadcrumbs4.png" alt="#">
		</div><!-- under header -->

		<div class="page-content left-sidebar back_to_up">
			<div class="row clearfix mb">
				<div class="breadcrumbIn">
					<ul>
						<li><a href="index.html" class="toptip" title="Homepage"> <i class="icon-home"></i> </a></li>
						<li> Profile </li>
					</ul>
				</div><!-- breadcrumb -->
			</div><!-- row -->

			<div class="row row-fluid clearfix mbf">
			
			<!--
				<div class="span4 sidebar">
								<div class="def-block widget">
									<h4> User Info </h4><span class="liner"></span>
									<div class="wrapper">
			                        <div class="text-center m-b m-t">
			                          <a href="#" class="thumb-lg">
			                            <img src="images/a0.png" class="img-circle">
			                          </a>
			                          <div>
			                            <div class="h3 m-t-xs m-b-xs">Rajkamal T</div>
			                            <small class="text-muted"><i class="fa fa-map-marker"></i> TamilNadu, India</small>
			                          </div>                
			                        </div>                 
			                        <div>
			                          <small class="text-uc text-xs text-muted">about me</small>
			                          <p>Web Designer </p>
			                          <small class="text-uc text-xs text-muted">info</small>
			                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat.</p>
			                          <div class="line"></div>
			                        </div>
			                      </div>
								</div>
							</div><!-- span4 sidebar -->
			
			
				<div class="span8 posts">
					<div class="def-block">
						<header class="header bg-light lt">
							<?php
							if (isset($_GET["message"])) {
								if ($_GET["message"] == "0") {
									echo "Transaction Failed. Please Try Again";
								} else {
									echo "Transaction Successful";
								}
							}
							?>
                      <ul class="nav nav-tabs nav-white">
						  
                        <li class="active"><a href="#activity" data-toggle="tab">Download History</a></li>
                        <li class=""><a href="#events" data-toggle="tab">Purchase History</a></li>
                        <!-- <li class=""><a href="#interaction" data-toggle="tab">Interaction</a></li> -->
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activity">
							
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div id="cart1"></div>
                          </ul>
                        </div>
                        <div class="tab-pane" id="events">
                         <!-- <div class="text-center wrapper">-->
							  <div id="orderHtml"></div>
							  
                        <!--
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                                                  </div>-->
                        
                        </div>
                        <!--<div class="tab-pane" id="interaction">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div> -->
                      </div>
                    </section>
                  </section>
				<br>
					<!--
					<div class="pagination-tt clearfix">
											<ul>
												<li><span class="deactive">1</span></li>
												<li><a href="#" class="tbutton"><span>2</span></a></li>
												<li><a href="#" class="tbutton"><span>3</span></a></li>
												<li><span class="deactive">...</span></li>
												<li><a href="#" class="tbutton"><span>8</span></a></li>
											</ul>
											<span class="pages">Page 1 of 8</span>
										</div>-->
					<!-- pagination -->
				</div><!-- def block -->
			</div><!-- span8 posts -->

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
	<script type="text/javascript" src="js/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>