<?
session_start();

if (isset($_GET['session_id_raagas'])) {
	$_SESSION['session_id_raagas'] = $_GET['session_id_raagas'];
	$_SESSION['session_raagas_name'] = $_GET['session_raagas_name'];
	header('Location: '. $_GET['landing']);
}
?>