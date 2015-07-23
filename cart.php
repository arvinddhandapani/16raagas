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
				//alert (<?php echo $_SESSION['session_id_raagas'];?>);
				<?php if (isset($_SESSION['session_id_raagas']) && isset($_SESSION['session_raagas_name'])) {?>
			var encode="user_id=<?php echo ($_SESSION['session_email_16raagas']);?>";
			var session_id_raagas="<?php echo ($_SESSION['session_id_raagas'])?>";
			var session_email_16raagas="<?php echo ($_SESSION['session_email_16raagas'])?>";
			var url;
			url='cart';
			//alert (encode);
			//alert (encodeheader);
			var j = 0;
			post_ajax_data_header(url,encode,session_id_raagas, session_email_16raagas, function(data)
			{
				
				$.each(data.tasks, function(i,tasks)
			{
				var album_name=data.tasks[j].album_name;
				document.getElementById("album_name").innerHTML=album_name;
			
				
		
		
		
			});
				});
			<?php } else {?>
				var elem = document.getElementById("Login_PopUp_Link");
				if (typeof elem.onclick == "function") {
				    elem.onclick.apply(elem);
				}
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
						<li><a href="index.html" class="toptip" original-title="Homepage"> <i class="icon-home"></i> </a></li>
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
							<label class="product-quantity">Quantity</label>
							<label class="product-removal">Remove</label>
							<label class="product-line-price">Total</label>
						  </div>

						  <div class="product">
							<div class="product-image">
							  <img src="images/a0.png">
							</div>
							<div class="product-details">
							  <div class="product-title">Dingo Dog Bones</div>
							 <!-- <p class="product-description">The best dog bones of all time. Holy crap. Your dog will be begging for these things! I got curious once and ate one myself. I'm a fan.</p>-->
							 <div id="cart1"></div>
							</div>
							<div class="product-price">12.99</div>
							<div class="product-quantity">
							  <input type="text" value="2" min="1">
							</div>
							<div class="product-removal">
							  <button class="remove-product">
								Remove
							  </button>
							</div>
							<div class="product-line-price">25.98</div>
						  </div>

						  <div class="product">
							<div class="product-image">
							  <img src="images/a0.png">
							</div>
							<div class="product-details">
							  <div class="product-title"><p id='album_name'></p></div>
							  <p class="product-description"><!--<?php //echo $cart_items[0][0].": In stock: ".$cart_items[0][1].", sold: ".$cart_items[0][2].".<br>";?>--></p>
							</div>
							<div class="product-price">45.99</div>
							<div class="product-quantity">
							  <input type="text" value="1" min="1">
							</div>
							<div class="product-removal">
							  <button class="remove-product">
								Remove
							  </button>
							</div>
							<div class="product-line-price">45.99</div>
						  </div>

						  <div class="totals">
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
							</div>
							<div class="totals-item totals-item-total">
							  <label>Grand Total</label>
							  <div class="totals-value" id="cart-total">90.57</div>
							</div>
						  </div>
							  
							  <button class="tbutton color2 checkout">Checkout</button>

						</div>
						
					</div><!-- def block -->
				</div><!-- posts -->

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
	<script type="text/javascript" src="js/twitter/jquery.tweet.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script type="text/javascript">
	/* Set rates + misc */
		var taxRate = 0.05;
		var shippingRate = 15.00; 
		var fadeTime = 300;


		/* Assign actions */
		$('.product-quantity input').change( function() {
		  updateQuantity(this);
		});

		$('.product-removal button').click( function() {
		  removeItem(this);
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
		  var productRow = $(removeButton).parent().parent();
		  productRow.slideUp(fadeTime, function() {
			productRow.remove();
			recalculateCart();
		  });
		}
	</script>
</body>
</html>