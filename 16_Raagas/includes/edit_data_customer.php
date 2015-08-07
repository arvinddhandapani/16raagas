<?
//edit_data.php
 include 'psl-config.php';
 $Connect = mysql_connect(HOST, USER, PASSWORD);
$db = mysql_select_db(DATABASE,$Connect);

$id = $_POST["id"];
$full_name = $_POST["full_name"];
$phone_1 = $_POST["phone_1"];
$phone_2 = $_POST["phone_2"];
$cust_address = $_POST["cust_address"];
$credit_limit = $_POST["credit_limit"];
$lcr_limit = $_POST["lcr_limit"];

 if (!is_numeric($lcr_limit) and !is_numeric($lcr_limit)) {
	 header('Location: ../edit_form_customer.php?id='. $id. '&id1=1&id2=1');
 	 } elseif (!is_numeric($credit_limit)) {
	 	//echo "What is the ID:". $id;
	     header('Location: ../edit_form_customer.php?id='. $id. '&id1=1');
	 } elseif (!is_numeric($lcr_limit)) {
	     header('Location: ../edit_form_customer.php?id='. $id. '&id2=1');
	 } else {
	

	
	
	$order = "UPDATE cust_info SET full_name='$full_name',phone_1='$phone_1',phone_2='$phone_2',cust_address='$cust_address',credit_limit=$credit_limit,lcr_limit='$lcr_limit' 
	          WHERE 
		      cust_id='$id'";
	mysql_query($order);
	header('Location: ../index.php');
}





?>