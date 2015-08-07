<?php
	include 'db_connect.php'; 
	$q=$_GET['q'];
	$my_data=mysql_real_escape_string($q);
	$sql="SELECT full_name FROM cust_info WHERE full_name LIKE '%$my_data%' ORDER BY full_name";
	$result = mysqli_query($mysqli,$sql) or die(mysqli_error());
	
	if($result)
	{
		while($row=mysqli_fetch_array($result))
		{
			
			echo $row['full_name']."\n";
		}
	}
?>