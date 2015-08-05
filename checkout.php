<?php
session_start();
?>
<script src="js/jquery.min.js"></script>
<script src="js/ajaxGetPost.js"></script>
<script>
	$(document).ready(function()
	{	
	var totalAmount="<?php echo ($_GET['totalAmount'])?>";
	var emailAddress="<?php echo ($_GET['userEmail'])?>";
	/*First Check if the Amount is same in the Cart Table*/
	//alert (emailAddress);
	var url = 'checkCorrectAmount/'+totalAmount+'/'+emailAddress;
	test_ajax_data('GET',url, function(data){
		if (data.error === true) {
	window.location.href="cart.php?error=We could not process your request at this time. Please try again Later";
		}else{
			<?php 
			if(isset($_SESSION['amount'])){
			unset($_SESSION['amount']);
			}
			$_SESSION['amount'] = $_GET['totalAmount'];
			?>
			//alert ("else");
			window.location.href="transaction/TestSsl.php";
		}
		
		
	});
});
	</script>