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

<script src="js/jquery.min.js"></script>
<script src="js/ajaxGetPost.js"></script>

<script>
	$(document).ready(function()
	{
		var song_id = "<?php echo ($_GET['song_id']);?>";
		var album_id = "<?php echo ($_GET['album_id']);?>";
		var base_url_al = "<?php echo ($_GET['base_url_al']);?>";
		var url_final = "albums.php"+"?a_id="+album_id;
		<?php
		// Start the session
		session_start();
		?>
		<?php if (isset($_SESSION['session_id_raagas']) && isset($_SESSION['session_raagas_name'])) {?>
	var encode = "song_id="+song_id+"&album_id="+album_id;
	//alert (encode);
	var session_id_raagas="<?php echo ($_SESSION['session_id_raagas'])?>";
	var session_email_16raagas="<?php echo ($_SESSION['session_email_16raagas'])?>";
	var url;
	url='addToCart';
	
	post_ajax_data_header(url,encode,session_id_raagas, session_email_16raagas, function(data)
	{
	var error = (data.error);
	var message = (data.message);	
	//alert (error);
	window.location = url_final;	
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
	//}
<?php }?>
});
		</script>
</head>
<body id="fluidGridSystem">
	<?php include 'header.php'; ?>
</body>
	