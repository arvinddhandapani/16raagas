<?php
	session_start();
	error_reporting(0);
	header("Content-type: application/javascript");
?>

	<link rel="stylesheet" href="styles/profile.css" type="text/css" />
	<style>
		.clear {
			clear: none;
			height: auto;
			visibility: visible;
			width: auto;
		}
		.close {
  background: none !important;
  color: #000 !important;
  line-height: 35px;
  position: static !important;
  text-align: center;
  width: 35px;
  text-decoration: none !important;
  font-weight: bold;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px !important;
  box-shadow: none !important;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  -moz-transition: all 0.5s ease-out;
  -webkit-transition: all 0.5s ease-out;
  -o-transition: all 0.5s ease-out;
  transition: all 0.5s ease-out !important;
  -webkit-transition-delay: 0.2s;
  -moz-transition-delay: 0.2s;
  -o-transition-delay: 0.2s;
  -transition-delay: 0.2s;
  opacity: 0.2;
}
.close .ie7 {
  filter: progid:DXImageTransform.Microsoft.Shadow(color='#000000', Direction=135, Strength=3);
}
.close:hover {
  background: none;
  color: #000;
  opacity: 0.4;
  -moz-transition: all 0.5s ease-out;
  -webkit-transition: all 0.5s ease-out;
  -o-transition: all 0.5s ease-out;
  transition: all 0.5s ease-out;
}
	</style>

		<script src="js/jquery.min.js"></script>
		<script src="js/ajaxGetPost.js"></script>
	<script>
	
		$(document).ready(function()
		{
		<?php if (isset($_SESSION['session_id_raagas']) && isset($_SESSION['session_raagas_name'])) {?>
		var encode="user_id=<?php echo ($_SESSION['session_email_16raagas']);?>";
		var session_id_raagas="<?php echo ($_SESSION['session_id_raagas'])?>";
		var session_email_16raagas="<?php echo ($_SESSION['session_email_16raagas'])?>";
		var url;
		url='cart';
		var j = 0;
	
		post_ajax_data_header(url,encode,session_id_raagas, session_email_16raagas, function(data)
		{
		$.each(data.tasks, function(i,tasks)
				{
					var itemDrop = "<a href=\"cart.php\" class=\"media list-group-item\"><span class=\"pull-left thumb-sm\"><img src=\"images/albums/" +
				    data.tasks[j].album_img +
				    "\" class=\"img-circle\"></span><span class=\"media-body block m-b-none\">"+data.tasks[j].song_name+"<br><small class=\"text-muted\">10 minutes left</small></span></a>";
					$(itemDrop).appendTo("#itemDrop");
					j = j+1;
				});
				item = "<span class=\"badge badge-sm up bg-danger count\">"+j+"</span>";
				$(item).appendTo("#badgeItem");
				iite = "<strong>You have <span class=\"count\">"+j+"</span> Items</strong>"
				$(iite).appendTo("#badgeItem2");
		});
		<?php } ?>
		});
		</script>
	
		<script>
		function login() {
	
			var update=$('#login_username').val();
			var current_url=window.location.href;
		var encode="email="+$('#login_username').val()+"&"+"password="+$('#login_password').val();
		
		url='login';
		if(update.length>0)
		{
			post_ajax_data_w(url,encode, function(data)
			{
				$("#loginfailedmsg").empty();
				   if(data.error===true){
					   $("#loginfailed").show();
					   var msg="<span>"+data.message+"</span>";
					   $(msg).appendTo("#loginfailedmsg");
				
					} else {
					;
						str2 = current_url.replace ("&", "andandand");
					window.location.href="session_write.php?session_id_raagas="+data.song_session+"&session_raagas_name="+data.name+"&session_email_16raagas="+data.email+"&landing="+str2;
					
					}
			});
		}	
}

	function loginClose() {
	//if (popupStatus == 1) {
		$("#LoginBackgroundPopup").fadeOut("slow");
		$("#popupLogin").removeClass('zigmaIn').fadeOut("slow");
		popupStatus = 0;
		//alert (window.location.href);
		//}
			
}
function warningClose() {
		$("#loginfailed").fadeOut("slow");
}
		</script>	
		
<div id="layout" class="full">
		<!-- popup login -->
			<div id="popupLogin">
				<div class="def-block widget">
					<h4> Sign In </h4><span class="liner"></span>
					<div class="widget-content row-fluid">
					<form id="popup_login_form">
											     <div class="alert alert-danger" style="display: none" role="alert" id="loginfailed">
                                                 <button type="button" class="close" onClick="warningClose()">&times;</button>
  <strong>Warning!</strong>
                                                 <div id="loginfailedmsg"></div>
												 </div>
												<input type="text" name="login_username" id="login_username" onfocus="if (this.value=='username') this.value = '';" onblur="if (this.value=='') this.value = 'username';" value="username" placeholder="username">
												<input type="password" name="login_password" id="login_password" onfocus="if (this.value=='password') this.value = '';" onblur="if (this.value=='') this.value = 'password';" value="password" placeholder="password">
												<!--<input type="submit" value="Sign in" class="tbutton small"> -->
											<a href="#" class="tbutton small" onClick="login()"><span>Sign In</span></a>
												<a href="register.php" class="tbutton color2 small"><span>Register</span></a>
											</form><!-- login form -->
					</div><!-- content -->
				</div><!-- widget -->
				<div id="popupLoginClose" onClick="loginClose()">x</div>
			</div><!-- popup login -->
			<div id="LoginBackgroundPopup"></div>
		<!-- popup login -->

		<header id="header" class="glue">
			<div class="row clearfix">
				<div class="little-head">				  
					<!--<div id="Login_PopUp_Link" class="sign-btn tbutton small"><span>Sign In / Register</span></div>-->
					
					<?php
					
					// Start the session
					session_start();
					if(isset($_SESSION['session_id_raagas'])){
					?>
			
					<div class="navbar-right">
						<ul class="nav navbar-nav m-n nav-user user">
						<li>
							<div id="badgeItem"></div>
							<a href="#" class="dropdown-toggle lt" data-toggle="dropdown">
								<!---->
							  <i class="icon-shopping-cart" style="font-size:1.3em"></i>
							  
							<!--  <span class="badge badge-sm up bg-danger count">2</span>-->
							</a>
							<section class="dropdown-menu aside-xl animated fadeInUp">
							  <section class="panel bg-white">
								<div class="panel-heading b-light bg-light">
									<div id="badgeItem2"></div>
								<!--  <strong>You have <span class="count">2</span> Items</strong>-->
								</div>
								<div class="list-group list-group-alt">
								<div id="itemDrop"></div>
								</div>
								<div class="panel-footer text-sm">
								  <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
								  <a href="cart.php" class="tbutton small"><span>Check Out</span></a>
								  <a href="mp3s.php" class="tbutton color2 small"><span>Continue Shopping</span></a>
								</div>
							  </section>
							</section>
						  </li>
						  <li class="dropdown">
							<a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
							 <!-- <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
								<img src="images/a0.png" alt="...">
							  </span> -->
							  <?php echo strtoupper($_SESSION['session_raagas_name']);?> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu animated fadeInRight">            
							  <li>
								<span class="arrow top"></span>
								<a href="#">Settings</a>
							  </li>
							  <li>
								<a href="profile.php">Profile</a>
							  </li>
							  <li>
								<a href="#">Help</a>
							  </li>
							  <li class="divider"></li>
							  <li>
								<a href="session_die.php" >Logout</a>
							  </li>
							</ul>
						  </li>
						</ul>
					  </div><!---end of User Profile -->
					
						
						<?php
					} else {
						?>
						<div id="Login_PopUp_Link" class="sign-btn tbutton small"><span>Sign In / Register</span></div>
							<?php
						}
							?>
					
					
					  
					<div class="search">
						<form action="search.php" id="search" method="get">
							<input id="inputhead" name="search" type="text" onfocus="if (this.value=='Start Searching...') this.value = '';" onblur="if (this.value=='') this.value = 'Start Searching...';" value="Start Searching..." placeholder="Start Searching ...">
							<button type="submit"><i class="icon-search"></i></button>
						</form><!-- end form -->
					</div><!-- search -->
				</div><!-- little head -->
			</div><!-- row -->

			<div class="headdown">
				<div class="row clearfix">
					<div class="logo bottomtip" title="Best and Most Popular Musics">
						<a href="index.php"><img src="images/logo.png" alt="Best and Most Popular Musics"></a>
					</div><!-- end logo -->
					<nav>
						<ul class="sf-menu">
							<?php
							$current_file = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
							if ($current_file == "mp3s.php") {
								
							
							?>
							<li ><a href="index.php">Home</a></li>
							<li><a href="aboutus.php">About Us</a></li>
							<li class="current selectedLava"> <a href="mp3s.php">MP3<span class="sub"></span></a>
								<?php
									
								} elseif ($current_file == "aboutus.php") {
									
								?>
								<li><a href="index.php">Home</a></li>
								<li class="current selectedLava"><a href="index.php">About Us</a></li>
								<li > <a href="mp3s.php">MP3<span class="sub"></span></a>

<?php } else {?>
	<li class="current selectedLava"><a href="index.php">Home</a></li>
	<li><a href="aboutus.php">About Us</a></li>
	<li > <a href="mp3s.php">MP3<span class="sub"></span></a>
	<?php
}
	?>
								<ul>
									<li><a href="mp3s.php?lang=tamil">Tamil</a></li>
									<li><a href="mp3s.php?lang=telugu">Telugu</a></li>
									<li><a href="mp3s.php?lang=malayalam">Malayalam</a></li>
									<li><a href="mp3s.php?lang=kannada">Kannada</a></li>
									<li><a href="mp3s.php?lang=hindi">Hindi</a></li>
									<li><a href="mp3s.php?lang=english">English</a></li>
								</ul>
							</li>
							<!--<li><a href="archive.php">Archive</a></li>-->
							<!--<li><a href="profile.php">Profile</a></li>	-->						
						</ul><!-- end menu -->
					</nav><!-- end nav -->
				</div><!-- row -->
			</div><!-- headdown -->
		</header><!-- end header -->
