<?php
	session_start();
	header("Content-type: application/javascript");
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
		<script src="js/jquery.min.js"></script>
		<script src="js/ajaxGetPost.js">	</script>
	

	<script>
	var slider_img = [];
	window.onload = function() {
			
			
				
		//		window.alert("sometext");
			//var base_url="http://127.0.0.1/16raagas/v1/";
			//var base_url="http://localhost:8888/adhandapani/16raagas/16raagas/v1/";
			var url,encodedata;
			//$("#update").focus();

			/* Load Updates */
			url='slider';
			encodedata='';
			test_ajax_data('GET',url, function(data)
			{
				//alert (data.error);
				//var j=0;
				var j=0;
				$.each(data.slider1, function(i,slider1)
			{
				
				//slider_img.push("images/slides/"+slider1.image_name);
				var slider_name = "<img src='images/slides/"+slider1.image_name+"'alt='"+slider1.image_name+"'>";
				var sd = "sd"+i;
				$(slider_name).appendTo("#"+sd);
				//alert (sd+i);
			
			});
			});
			
			
		}
</script>
	</head>
<body>

		<!-- Start Revolution Slider -->
			<div class="sliderr">
				<div class="fullwidthbanner-container">					
					<div class="revolution">
						<ul>
							<li id="sd1" data-transition="random" data-slotamount="7" data-masterspeed="300" >
							<!--<div id="sd0"></div>	<img src="" id="image_id_here" width="300" height="400">-->
						
														
			<div class="tp-caption fade"  
					 data-x="566" 
					 data-y="306" 
					 data-speed="300" 
					 data-start="800" 
					 data-easing="easeInOutExpo"  ></div>
								
				<div class="tp-caption sfl"  
					 data-x="566" 
					 data-y="305" 
					 data-speed="300" 
					 data-start="1200" 
					 data-easing="easeInOutExpo"  ><div id="sd1"></div>
								
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
								
			<div class="tp-caption sfl"  
					 data-x="714" 
					 data-y="375" 
					 data-speed="300" 
					 data-start="2000" 
					 data-easing="easeInOutExpo"  ><a href="movie_single.html" class="tbutton small"><span>Buy Now</span></a></div>
							</li>

		<li id="sd0	" data-transition="random" data-slotamount="7" data-masterspeed="300" >
				
		</li>

		<li id="sd2" data-transition="random" data-slotamount="7" data-masterspeed="300" >
	
		</li> 

		</ul><!-- End Slides -->
			<div class="tp-bannertimer"></div><!-- Timer -->										
		</div>					
	</div>
</div>
		<!-- End Revolution Slider -->
	</body>