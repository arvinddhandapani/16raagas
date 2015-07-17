<?php
	session_start();
	header("Content-type: application/javascript");
?>

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
					window.location.href="session_write.php?session_id_raagas="+data.session_id_raagas+"&session_raagas_name="+data.name+"&landing="+window.location.href;
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
					<!-- <div class="rege-btn tbutton color2 small"><a href="register.php"><span>Register</span></a></div> -->
					<?php
					
					// Start the session
					session_start();
					if(isset($_SESSION['session_id_raagas'])){
					?>
					<div class="sign-btn tbutton small"><span><a href="session_die.php"><?php echo $_SESSION['session_raagas_name'];?></a></span></div>
					
						
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
							<li><a href="index.php">About</a></li>
							<li><a href="mp3s.php">MP3<span class="sub"></span></a>
								<ul>
									<li><a href="#">Tamil</a></li>
									<li><a href="#">Telugu</a></li>
									<li><a href="#">Hindi</a></li>
									<li><a href="#">Malayalam</a></li>
								</ul>
							</li>
							<li><a href="archive.php">Archive</a></li>
							<li><a href="profile.php">Profile</a></li>							
						</ul><!-- end menu -->
					</nav><!-- end nav -->
				</div><!-- row -->
			</div><!-- headdown -->
		</header><!-- end header -->