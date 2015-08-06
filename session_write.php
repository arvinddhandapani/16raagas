<?
session_start();

if (isset($_GET['session_id_raagas'])) {
	$_SESSION['session_id_raagas'] = $_GET['session_id_raagas'];
	$_SESSION['session_raagas_name'] = $_GET['session_raagas_name'];
	$_SESSION['session_email_16raagas'] = $_GET['session_email_16raagas'];
	//header('Location: '. $_GET['landing']);
	$landin_url = str_replace("andandand" , "&" , $_GET['landing']);
	//$landin_url = $_GET['landing'];
}
?>
<script>
window.location = "<?php echo $landin_url;?>";
</script>