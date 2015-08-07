<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<meta charset="utf-8" />
<title>Siva Ventures</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link media="screen" charset="utf-8" rel="stylesheet" href="css/base.css" />
<link media="screen" charset="utf-8" rel="stylesheet" href="css/skeleton.css" />
<link media="screen" charset="utf-8" rel="stylesheet" href="css/layout.css" />
<link media="screen" charset="utf-8" rel="stylesheet" href="css/child.css" />
<link rel="stylesheet" href="css/animate.min.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="css/jquery.onebyone.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
    <link href="css/style.css" media="screen" rel="stylesheet" type="text/css"/>
    <link href="css/uniform.css" media="screen" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.tools.js"></script>
    <script type="text/javascript" src="js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
<!--[if (IE 6)|(IE 7)]>
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
<![endif]-->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--><script type="text/javascript" language="javascript" src="js/jquery-1-8-2.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.carousel.js"></script>
<script type="text/javascript" src="js/jquery.color.animation.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js" charset="utf-8"></script>
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery.onebyone.min.js"></script>
<script type="text/javascript" src="js/jquery.touchwipe.min.js"></script>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 

<!-- color pickers -->
<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />
<script type="text/javascript" src="js/colorpicker.js"></script>
<!-- end of color pickers -->

</head>

<body>
	
    <div class="page-wrapper">
        <div class="slug-pattern slider-expand">
            <div class="background-image" id="1"></div>
            <div class="overlay"><div class="slug-cut"></div>
        </div></div>
        <div class="header slider-expand">
            <div class="nav">
	        <?php if (login_check($mysqli) == true) : ?>
	            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
                <div class="container">
                
                    <!-- Standard Nav (x >= 768px) -->
                    <div class="standard">
                    
                        <div class="five column alpha">
                            <div class="logo">
                                <a href="index.html"><img src="images/logo.png" /></a><!-- Large Logo -->
                            </div>
                        </div>
                    
                        <div class="eleven column omega tabwrapper">
                            <div class="menu-wrapper">
                                <ul class="tabs menu">
                                    <li>
                                       <a href="index.php" class="active"><span>Home</span></a>
                                    
                                    </li>
                                    <li><a href="#">Add/Edit</a>
                                        <ul class="child">
                                            <li><a href="index.php">Customers</a>
                                                <ul>
                                            <li><a href="add_customer.php">Add</a></li>
                                            <li><a href="edit_customer.php">Edit</a></li>
										</ul>
                                            </li>
                                       
                                            <li><a href="index.php">Line Managers</a>
                                                <ul>
                                                    <li><a href="add_agent.php">Add</a></li>
                                                    <li><a href="edit_lcr.php">Edit</a></li>
                                                </ul>
                                            </li>
										</ul>
									</li>
                                  
                                            <li>
												<a href="index.php">Daily Entry</a>
											<ul class="child">
												<li><a href="index.php">Dispatch</a>
												<ul>
                                           		 	<li><a href="credit_entry.php">Credit</a></li>
                                           	  		<li><a href="lcr_entry.php">LCR</a></li>
                                        		</ul>
											</li>
											<li><a href="index.php">Returns</a>
												<ul>
                                           		 	<li><a href="credit_collection.php">Credit</a></li>
                                            		<li><a href="LCR_collection.php">LCR</a></li>
                                       		 	</ul>
                                    </li>
								</ul>
							</li>
							
							<!--Reports--> 
							
                                  
                                            <li>
												<a href="index.php">Reports</a>
											<ul class="child">
												<li><a href="index.php">Outstanding Amount</a>
												<ul>
                                           		 	<li><a href="total_report.php">Total Outstanding Credits</a></li>
                                           	  		<li><a href="credit_report_customer.php">Customer Wise</a></li>
													<li><a href="line_report_customer.php">Line Agent Wise</a></li>
                                        		</ul>
											</li>
											<li><a href="index.php">Outstanding LCR</a>
												<ul>
                                           		 	<li><a href="total_lcr_report.php">Total Outstanding LCR</a></li>
                                            		<li><a href="lcr_report_customer.php">Customer Wise</a></li>
													<li><a href="lcr_report_line.php">Line Agent Wise</a></li>
                                       		 	</ul>
                                    		</li>
											<li><a href="index.php">Transaction Details</a>	
                                    		</li>
											<li><a href="index.php">Bill Reports</a>	
                                    		</li>
								</ul>
							</li>
                          </div>
                        </div>
                    </div>
					
					<!-- ENd of Index Page header id logged in -->
				
		     <?php else : ?>

				<!-- Start login authentication page -->
    <!--    <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?> -->
        <form action="includes/process_login.php" method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
        <p>If you don't have a login, please <a href="register.php">register</a></p>
        <p>If you are done, please <a href="includes/logout.php">log out</a>.</p>
        <p>You are currently logged <?php echo $logged ?>.</p>
													     <?php endif; ?>
		                                        </div>
		                                    </div>
		                                </div>
										<!-- end of login page -->
								 
		                        <div class="sixteen columns alpha omega">
		                        	<div class="foot-nav-bg"></div>
		                            <div class="foot-nav">
		                                <div class="copy">
		                                    Coptyright © 
		                                </div>
		                                <!--<div class="nav">
		                                    <a href="#">Home</a>
		                                    <a href="#">Portfolio</a>
		                                    <a href="#">Contact Us</a>
		                                    <a href="#">Terms of Use</a>
		                                    <a href="#">Privacy</a>
		                               	</div> -->
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		    </div>
        
		    <script type="text/javascript">
		    <!--
		        $(window).load(function(){
		            // Setup Slider
		            $(".onebyone.hide").fadeIn(1000);
		            $('.onebyone').oneByOne({
		                className: 'oneByOne1',	             
		                easeType: 'random',
		                autoHideButton: false,
		                width: 960,
		                height: 840,
		                minWidth: 680,
		                slideShow: true
		            });
		             $("a[class^='prettyPhoto']").prettyPhoto({social_tools: '' });
		        });
		        $(document).ready(function() {
		            $('.slidewrap, .slidewrap2').carousel({
		                slider: '.slider',
		                slide: '.slide',
		                slideHed: '.slidehed',
		                nextSlide : '.next',
		                prevSlide : '.prev',
		                addPagination: false,
		                addNav : false
		            });
					$('.slide.testimonials').contentSlide();
					$('.bbss').contentSlide();
		        });
		    // -->
		    </script>
			<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
		    <script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/EmpiricalThemes.json?callback=twitterCallback2&count=2"></script>
			</div>
		</body>

		</html>
    </body>
</html>
