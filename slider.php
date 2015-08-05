<?php
	session_start();
	header("Content-type: application/javascript");
    require_once dirname(__FILE__) . '/include/DbConnect.php';
    // opening db connection
    $db = new DbConnect();
    $conn = $db->connect();
	
		
        $stmt = $conn->prepare("SELECT a.* FROM main_slider a where a.show_hide = 1");
      
        $stmt->execute();
        $tasks = $stmt->get_result();
      
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
		<script src="js/jquery.min.js"></script>
		<script src="js/ajaxGetPost.js">	</script>
	

	
	
	</head>
<body>

		<!-- Start Revolution Slider -->
					<div class="sliderr">
						<div class="fullwidthbanner-container">					
							<div class="revolution">
								<ul>
								<!--
									<li data-transition="random" data-slotamount="7" data-masterspeed="300" >
																<img src="images/slides/slider1.jpg" alt="slider" >-->
								
														
						<!--
						<div class="tp-caption fade"  
													 data-x="566" 
													 data-y="306" 
													 data-speed="300" 
													 data-start="800" 
													 data-easing="easeInOutExpo"  ><img src="images/slides/slide1-cap1.png" alt="Image 2"></div>
														
												<div class="tp-caption sfl"  
													 data-x="566" 
													 data-y="305" 
													 data-speed="300" 
													 data-start="1200" 
													 data-easing="easeInOutExpo"  ><img src="images/slides/slide1-cap2.png" alt="Image 3"></div>
														
												<div class="tp-caption sfr"  
													 data-x="741" 
													 data-y="305" 
													 data-speed="300" 
													 data-start="1200" 
													 data-easing="easeInOutExpo"  ><img src="images/slides/slide1-cap3.png" alt="Image 4"></div>
														
												<!-- <div class="tp-caption sfr"  
													 data-x="711" 
													 data-y="374" 
													 data-speed="300" 
													 data-start="2000" 
													 data-easing="easeInOutExpo"  ><img src="images/slides/slide1-cap4.png" alt="Image 5"></div> -->
														
											<!--
												<div class="tp-caption sfl"  
																								 data-x="714" 
																								 data-y="375" 
																								 data-speed="300" 
																								 data-start="2000" 
																								 data-easing="easeInOutExpo"  ><a href="movie_single.html" class="tbutton small"><span>Buy Now</span></a></div>-->
											
						
									</li>
									<?php
									while($row = $tasks->fetch_assoc()){?>
										<li data-transition="random" data-slotamount="7" data-masterspeed="300" >
											<img src="images/slides/<?php echo $row['image_name']?>" alt="<?php echo $row['image_name']?>" >
										</li>
									<?php	
									   // echo $row['image_name'] . '<br />';
									}
									$stmt->close();
									?>
									

				

				</ul><!-- End Slides -->
					<div class="tp-bannertimer"></div><!-- Timer -->										
				</div>					
			</div>
		</div>
				<!-- End Revolution Slider -->
	</body>