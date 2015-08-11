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
  
  
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="style.css" id="dark" media="screen" />
  <link id="light" media="screen" href="styles/light.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="styles/profile.css" type="text/css" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  
  
  <!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/icons/font-awesome-ie7.min.css" />
	<![endif]-->
	  
	  <!-- Start of all functional codes -->
  	<script src="js/jquery.min.js"></script>
  	<script src="js/ajaxGetPost.js"></script>
	<script>
	
		$(document).ready(function()
		{
				
			//alert ("<?php echo $_SESSION['session_id_raagas'];?>");
			<?php if (isset($_SESSION['session_id_raagas']) && isset($_SESSION['session_raagas_name'])) {?>
				//alert ("hi");
		var encode="order_id=<?php echo ($_GET['order_id']);?>";
		var orderId1="<?php echo ($_GET['order_id']);?>";
		var session_id_raagas="<?php echo ($_SESSION['session_id_raagas'])?>";
		var session_email_16raagas="<?php echo ($_SESSION['session_email_16raagas'])?>";
		var url;
		url='orderDetails';
	
		//alert (encode);
		//alert (encodeheader);
		var j =0;
		var totalPrice =0;
		var k =1;
		
		post_ajax_data_header(url,encode,session_id_raagas, session_email_16raagas, function(data)
		{
			var orderId="<p class=\"h4\">"+orderId1+"</p>";
			$(orderId).appendTo("#orderId");
			
			var date123 = "<B>"+data.order[0].order_update_date+"</B>";
			$(date123).appendTo("#date123");
		
			var orderTotalAmount = " <p class=\"m-t m-b\">Amount Paid: <i class=\"fa fa-inr\"></i>"+data.order[0].order_amount+"</p>";
			$(orderTotalAmount).appendTo("#orderAmount");
			
			$.each(data.tasks, function(i,tasks)
		{
			
			
			var html ="<tr><td>"+k+"</td><td>"+data.tasks[j].song_name+"</td><td>"+data.tasks[j].album_name+"</td><td>"+data.tasks[j].price+"</td></tr>";
			$(html).appendTo("#odersList");
			j=j+1;
			k=k+1;
		//	totalPrice = eval(totalPrice) + eval(data.tasks[j].price);
		
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
	<!-- End of Functional Code -->
	  
	
	
</head>
<body class="">


  <section class="vbox">
    
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
       
        <!-- /.aside -->
        <section id="content">
          <section class="vbox bg-white">
            <header class="header bg-light lter hidden-print">
              <a href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</a>
              <p>Invoice</p>
            </header>
            <section class="scrollable wrapper">
             
              <div class="row">
                <div class="col-xs-6">
                  <h4>16RaaGas.</h4>
                  <p><a href="http://www.16raagas.com">www.16raagas.com</a></p>
                  <p>"LAKSHMI VILAS",<br>
                    1st floor, No. 16, Arokia Madha Nagar 1st Street,<br>
                    Little Mount, Chennai - 600 015,<br>
					Tamilnadu, India.
                  </p>
                  <p>
                    Telephone:  +91 44 22300310<br>
                    Fax:  044 22200310
                  </p>
                </div>
                <div class="col-xs-6 text-right">
                  <div id="orderId"></div>
                  <h5><div id="date123"></div></h5>           
                </div>
              </div>          
            
             
             
				 <div id="orderAmount"></div>
				 
              
              <div class="line"></div>
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 60px">Sl. No.</th>
                    <th>SONG NAME</th>
                    <th style="width: 140px">ALBUM</th>
                    <th style="width: 90px">TOTAL</th>
                  </tr>
                </thead>
                <tbody id="odersList">
				 
               
                 
  			
                  
  		
                </tbody>
              </table>              
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
      </section>
    </section>    
  </section>
    
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="bootstrap/js/bootstrap.js"></script>
</body>
</html>