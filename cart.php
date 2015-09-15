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
		<link rel="stylesheet" type="text/css" href="include/popupmodal.css" media="screen" />
		
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
		
		<script>
		var totalPrice = 0.00;
		</script>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/theme20.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
		<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
	
			
		<script src="js/jquery.min.js"></script>
		<script src="js/ajaxGetPost.js"></script>
		<script>
		
			$(document).ready(function()
			{
				//alert (<?php echo $_SESSION['session_id_raagas'];?>);
				<?php if (isset($_SESSION['session_id_raagas']) && isset($_SESSION['session_raagas_name'])) {?>
			var encode="user_id=<?php echo ($_SESSION['session_email_16raagas']);?>";
			var session_id_raagas="<?php echo ($_SESSION['session_id_raagas'])?>";
			var session_email_16raagas="<?php echo ($_SESSION['session_email_16raagas'])?>";
			var url;
			url='cart';
			//alert (encode);
			//alert (encodeheader);
			var j =0;
			var totalPrice =0;
			
			post_ajax_data_header(url,encode,session_id_raagas, session_email_16raagas, function(data)
			{
				
				$.each(data.tasks, function(i,tasks)
			{
				
				var html =
				    "<div class=\"product\" id=\"" +
				    data.tasks[j].cart_id +
				    "\"><div class=\"product-image\"><img src=\"images/albums/" +
				    data.tasks[j].album_img +
				    "\"></div><div class=\"product-details\"><div class=\"product-title\">" +
				    data.tasks[j].song_name +
				    "</div><div id=\"cart1\"></div></div><div class=\"product-price\">" +
				    data.tasks[j].price +
				    "</div><div class=\"product-removal\"><button class=\"remove-product\" onclick=\"removeItem(" +
				    data.tasks[j].cart_id +
				    ")\">Remove</button></div><div class=\"product-line-price\">" +
				    data.tasks[j].price +
				    "</div></div>";
				$(html).appendTo("#cart1");
				
				totalPrice = eval(totalPrice) + eval(data.tasks[j].price);
			j=j+1;
			});
			var html1 = "<div class=\"totals-value\" id=\"cart-total\">"+totalPrice+"</div>";
			$(html1).appendTo("#total1");
				});
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
			
			
	
				/*
				var elem = document.getElementById("Login_PopUp_Link");
								if (typeof elem.onclick == "function") {
								    elem.onclick.apply(elem);*/
				
				//}
			<?php }?>
		});
			</script>
		
		
</head>
<body id="fluidGridSystem">
	<div id="layout" class="full">
		<?php include 'header.php'; ?>
		<div class="under_header">
			
		</div><!-- under header -->

		<div class="page-content back_to_up">
			<div class="row clearfix mb">
				<div class="breadcrumbIn">
					<ul>
						<li><a href="index.php" class="toptip" original-title="Homepage"> <i class="icon-home"></i> </a></li>
						<li> Cart </li>
					</ul>
				</div><!-- breadcrumb -->
			</div><!-- row -->

			<div class="row row-fluid clearfix mbf">
				<div class="posts">
					<div class="def-block">
						<h4> Shopping Cart </h4><span class="liner"></span>

						<div class="shopping-cart">

						  <div class="column-labels">
							<label class="product-image">Image</label>
							<label class="product-details">Product</label>
							<label class="product-price">Price</label>
							
							<label class="product-removal">Remove</label>
							<label class="product-line-price">Total</label>
						  </div>

						<div id="cart1"></div>

						 

						  <div class="totals">
							<!--
							<div class="totals-item">
														  <label>Subtotal</label>
														  <div class="totals-value" id="cart-subtotal">71.97</div>
														</div>
														<div class="totals-item">
														  <label>Tax (5%)</label>
														  <div class="totals-value" id="cart-tax">3.60</div>
														</div>
														<div class="totals-item">
														  <label>Shipping</label>
														  <div class="totals-value" id="cart-shipping">15.00</div>
														</div>-->
							
							<div class="totals-item totals-item-total">
							  <label>Grand Total</label>
							  <div id="total1"></div>
							 <!-- <div class="totals-value" id="cart-total"><script>totalPrice;</script></div>-->
							</div>
						  </div>
							  <div class="checkout16raagas">
								  <div id="checkboxbutton"></div>
								  

								   <input type="checkbox" name="option-5" id="option-5" onchange="buttonEnableDisable();"> <label for="option-5">I have read and Understood the <a class="tosLink" href="#tosLink">Terms of Service.</a></label>
							  <button class="tbutton1" id="ckButton" disabled >Checkout</button>
							  </div>
						</div>
						
					</div><!-- def block -->
				</div><!-- posts -->

			</div><!-- row clearfix -->
		 
		</div><!-- end page content -->
<?php include 'footer.php'; ?>

	</div><!-- end layout -->
<!-- Scripts -->
	<script type="text/javascript">
	/* Set rates + misc */
		var taxRate = 0.00;
		var shippingRate = 0.00; 
		var fadeTime = 300;
		
		function buttonEnableDisable() {
			if($('#option-5').is(':checked')) {
			  $('#ckButton').removeAttr('disabled');
			  $('#ckButton').removeAttr("class");
			  $('#ckButton').attr("class", "tbutton color2 checkout");
			} else {
			 $('#ckButton').attr('disabled', 'disabled');
  			  $('#ckButton').removeAttr("class");
  			  $('#ckButton').attr("class", "tbutton1");
		}
	}
		
		function removeItem1(val) {
			 //$(this).closest("div").remove();
			 var a = document.getElementById(val);
			 //removeItem(a);
			 a.parentNode.removeChild(a);
		  
						}
		
		

		/* Assign actions */
		$('.product-quantity input').change( function() {
			
		});

		$('cart1 product-removal button').click( function() {
		  removeItem(this);
		});
		
		$('.checkout16raagas button').click( function() {
			myDivObj = document.getElementById("cart-total");
			var totalAmount = myDivObj.innerHTML;
			var prefixURL = "checkout.php?totalAmount="+totalAmount;
			//alert (totalAmount);
		  window.location = prefixURL+"&userEmail=<?php echo ($_SESSION['session_email_16raagas']);?>";
		});


		/* Recalculate cart */
		function recalculateCart()
		{
		  var subtotal = 0;
		
		  /* Sum up row totals */
		  $('.product').each(function () {
			subtotal += parseFloat($(this).children('.product-line-price').text());
		  });
	  
		  /* Calculate totals */
		  var tax = subtotal * taxRate;
		  var shipping = (subtotal > 0 ? shippingRate : 0);
		  var total = subtotal + tax + shipping;
	  
		  /* Update totals display */
		  $('.totals-value').fadeOut(fadeTime, function() {
			$('#cart-subtotal').html(subtotal.toFixed(2));
			$('#cart-tax').html(tax.toFixed(2));
			$('#cart-shipping').html(shipping.toFixed(2));
			$('#cart-total').html(total.toFixed(2));
			if(total == 0){
			  $('.checkout').fadeOut(fadeTime);
			}else{
			  $('.checkout').fadeIn(fadeTime);
			}
			$('.totals-value').fadeIn(fadeTime);
		  });
		}


		/* Update quantity */
		function updateQuantity(quantityInput)
		{
		  /* Calculate line price */
		  var productRow = $(quantityInput).parent().parent();
		  var price = parseFloat(productRow.children('.product-price').text());
		  var quantity = $(quantityInput).val();
		  var linePrice = price * quantity;
	  
		  /* Update line price display and recalc cart totals */
		  productRow.children('.product-line-price').each(function () {
			$(this).fadeOut(fadeTime, function() {
			  $(this).text(linePrice.toFixed(2));
			  recalculateCart();
			  $(this).fadeIn(fadeTime);
			});
		  });  
		}


		/* Remove item from cart */
		function removeItem(removeButton)
		{
		  /* Remove row from DOM and recalc cart total */
			var id_cart = removeButton;
			var encode="cart_id="+id_cart;
		//	alert (encode);
			var session_id_raagas="<?php echo ($_SESSION['session_id_raagas'])?>";
			var session_email_16raagas="<?php echo ($_SESSION['session_email_16raagas'])?>";
			
			var url;
			url='removeFromCart';
			post_ajax_data_header(url,encode,session_id_raagas, session_email_16raagas, function(data)
			{
				var a = document.getElementById(removeButton);
	   			a.parentNode.removeChild(a);
	   		 // var productRow = $(removeButton).parent().parent();
	   		  //productRow.slideUp(fadeTime, function() {
	   			//productRow.remove();
	   			recalculateCart();
				
			});
			 
		 // });
		}
	</script>
</body>
</html>