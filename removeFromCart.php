<script src="js/jquery.min.js"></script>
<script src="js/ajaxGetPost.js"></script>

<script>
	$(document).ready(function()
	{
		var song_id = "<?php echo ($_GET['song_id']);?>";
		var album_id = "<?php echo ($_GET['album_id']);?>";
		var base_url_al = "<?php echo ($_GET['base_url_al']);?>";
		var url_final = base_url_al+"&a_id="+album_id;
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
	url='removeFromCart';
	
	post_ajax_data_header(url,encode,session_id_raagas, session_email_16raagas, function(data)
	{
	var error = (data.error);
	var message = (data.message);	
	
	window.location = url_final;
	<?php } else {?>
		var elem = document.getElementById("Login_PopUp_Link");
		if (typeof elem.onclick == "function") {
		    elem.onclick.apply(elem);
		}
	<?php }?>
});
});
		</script>