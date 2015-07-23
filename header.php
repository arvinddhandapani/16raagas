<?php
	session_start();
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
		
	</style>

		<script src="js/jquery.min.js"></script>
		<script src="js/ajaxGetPost.js"></script>

		<script>
function login() {
	
			var update=$('#login_username').val();
			
		var encode="email="+$('#login_username').val()+"&"+"password="+$('#login_password').val();
		var base_url="http://localhost:8888/adhandapani/16raagas/16raagas/v1/";
		url=base_url+'login';
		if(update.length>0)
		{
			post_ajax_data(url,encode, function(data)
			{
				   if(data.error===true){
					   var msg="<span>"+data.message+"</span>";
					   $(msg).appendTo("#loginfailedmsg");
					   //alert(data.message);
					} else {
						alert (data.name);
						alert (data.email);
					window.location.href="session_write.php?session_id_raagas="+data.song_session+"&session_raagas_name="+data.name+"&session_email_16raagas="+data.email+"&landing="+window.location.href;
					}
			});
		}
		//});
}
		</script>	
		
<div id="layout" class="full">
		<!-- popup login -->
			<div id="popupLogin">
				<div class="def-block widget">
					<h4> Sign In </h4><span class="liner"></span>
					<div class="widget-content row-fluid">
					<form id="popup_login_form">
											     <div id="loginfailedmsg">
												 </div>
												<input type="text" name="login_username" id="login_username" onfocus="if (this.value=='username') this.value = '';" onblur="if (this.value=='') this.value = 'username';" value="username" placeholder="username">
												<input type="password" name="login_password" id="login_password" onfocus="if (this.value=='password') this.value = '';" onblur="if (this.value=='') this.value = 'password';" value="password" placeholder="password">
												<!--<input type="submit" value="Sign in" class="tbutton small"> -->
											<a href="#" class="tbutton small" onClick="login()"><span>Sign In</span></a>
												<a href="register.php" class="tbutton color2 small"><span>Register</span></a>
											</form><!-- login form -->
					</div><!-- content -->
				</div><!-- widget -->
				<div id="popupLoginClose">x</div>
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
						<ul class="nav navbar-nav m-n hidden-xs nav-user user">
						<li class="hidden-xs">
							<a href="#" class="dropdown-toggle lt" data-toggle="dropdown">
							  <i class="icon-shopping-cart"></i>
							  <span class="badge badge-sm up bg-danger count">2</span>
							</a>
							<section class="dropdown-menu aside-xl animated fadeInUp">
							  <section class="panel bg-white">
								<div class="panel-heading b-light bg-light">
								  <strong>You have <span class="count">2</span> Items</strong>
								</div>
								<div class="list-group list-group-alt">
								  <a href="#" class="media list-group-item">
									<span class="pull-left thumb-sm">
									  <img src="images/a0.png" alt="..." class="img-circle">
									</span>
									<span class="media-body block m-b-none">
									  Use awesome animate.css<br>
									  <small class="text-muted">10 minutes left</small>
									</span>
								  </a>
								  <a href="#" class="media list-group-item">
									<span class="media-body block m-b-none">
									  1.0 initial released<br>
									  <small class="text-muted">30 minutes left</small>
									</span>
								  </a>
								</div>
								<div class="panel-footer text-sm">
								  <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
								  <a href="#" class="tbutton small"><span>Check Out</span></a>
								  <a href="cart.php" class="tbutton color2 small"><span>Continue Shopping</span></a>
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
								<a href="#">
								  <span class="badge bg-danger pull-right">3</span>
								  Notifications
								</a>
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
							<li class="current selectedLava"><a href="index.php">Home</a></li>
							<li><a href="index.php">About Us</a></li>
							<li><a href="mp3s.php">MP3<span class="sub"></span></a>
								<ul>
									<li><a href="mp3s.php?lang=tamil">Tamil</a></li>
									<li><a href="mp3s.php?lang=telugu">Telugu</a></li>
									<li><a href="mp3s.php?lang=hindi">Hindi</a></li>
									<li><a href="mp3s.php?lang=malayalam">Malayalam</a></li>
								</ul>
							</li>
							<!--<li><a href="archive.php">Archive</a></li>-->
							<!--<li><a href="profile.php">Profile</a></li>	-->						
						</ul><!-- end menu -->
					</nav><!-- end nav -->
				</div><!-- row -->
			</div><!-- headdown -->
		</header><!-- end header -->