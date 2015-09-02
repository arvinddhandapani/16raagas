<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start();

	 //I will get the values here from DB
	 $cust_name = $_GET['cust_name'];
	 $cust_name = $_GET['field1'];
	 $cust_id = $_GET['custi_id'];
	 echo $_GET['cust_name'];
	 echo $_GET['field1'];
	 
	 $get_cust_id = $mysqli->prepare("select cust_id from cust_info WHERE full_name = ?");
	 $get_cust_id->bind_param('s', $cust_name);
	 $get_cust_id->execute();
	 $get_cust_id->bind_result($cust_id1);
	 $get_cust_id->store_result();
     $get_cust_id->fetch();
     $get_cust_id->close();
	 echo "Customer ID:". $cust_id1;
	 $get_user_details = "Select t1.custi_id_fk, t2.full_name, t2.phone_1, t2.phone_2, t1.amount from outwards_credit As t1 INNER JOIN cust_info As t2 ON t1.custi_id_fk = t2.cust_id where t1.bill_state = 0 and t1.custi_id_fk = ". $cust_id1;
	 //$get_user_details = "Select custi_id_fk, sum(amount) from outwards_credit where bill_state = 0 group by custi_id_fk";
	 $credit_query = mysqli_query($con, $get_user_details);
	 $error1 = mysqli_error($con);
	 echo $error1;
	 header('Location: ../customer_report_credit.php?msg='. $credit_query1);
	 
     ?>