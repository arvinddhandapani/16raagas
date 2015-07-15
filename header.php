	<div id="layout" class="full">
		<!-- popup login -->
			<div id="popupLogin">
				<div class="def-block widget">
					<h4> Sign In </h4><span class="liner"></span>
					<div class="widget-content row-fluid">
						<form id="popup_login_form">
							<input type="text" name="login_username" id="login_username" onfocus="if (this.value=='username') this.value = '';" onblur="if (this.value=='') this.value = 'username';" value="username" placeholder="username">
							<input type="password" name="login_password" id="login_password" onfocus="if (this.value=='password') this.value = '';" onblur="if (this.value=='') this.value = 'password';" value="password" placeholder="password">
							<a href="#" class="tbutton small"><span>Sign In</span></a>
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
					<div id="Login_PopUp_Link" class="sign-btn tbutton small"><span>Sign In / Register</span></div>
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