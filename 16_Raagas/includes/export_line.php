<?php
		 include 'psl-config.php';
		 $filename = "excelfilename";
 	  $cust_name = $_GET['msg'];
	  //$cust_name = 1;
      $Connect = mysql_connect(HOST, USER, PASSWORD);
	  $db = mysql_select_db(DATABASE,$Connect); 
 	  $sql_q = "Select t1.custi_id_fk, t1.date_out, t2.full_name, t3.full_name, t1.settlement_no, t1.bill_no, t1.amount from outwards_credit As t1 INNER JOIN cust_info As t2 ON t1.custi_id_fk = t2.cust_id INNER JOIN driver_info As t3 ON t3.driver_id = t1.driver_id_fk where t1.bill_state = 0 and t1.driver_id_fk = ". $cust_name;
	  $result = @mysql_query($sql_q,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
	  $file_ending = "xls";
	  //header info for browser
	  header("Content-type: application/vnd.ms-excel; name='excel'");
	  header("Content-Disposition: attachment; filename=$filename.xls");  
	  header("Pragma: no-cache"); 
	  header("Expires: 0");
	  /*******Start of Formatting for Excel*******/   
	  //define separator (defines columns in excel & tabs in word)
	  $sep = "\t"; //tabbed character
	  //start of printing column names as names of MySQL fields
	  for ($i = 0; $i < mysql_num_fields($result); $i++) {
	  echo mysql_field_name($result,$i) . "\t";
	  }
	  print("\n");    
	  //end of printing column names  
	  //start while loop to get data
	      while($row = mysql_fetch_row($result))
	      {
	          $schema_insert = "";
	          for($j=0; $j<mysql_num_fields($result);$j++)
	          {
	              if(!isset($row[$j]))
	                  $schema_insert .= "NULL".$sep;
	              elseif ($row[$j] != "")
	                  $schema_insert .= "$row[$j]".$sep;
	              else
	                  $schema_insert .= "".$sep;
	          }
	          $schema_insert = str_replace($sep."$", "", $schema_insert);
	          $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	          $schema_insert .= "\t";
	          print(trim($schema_insert));
	          print "\n";
		  }
	 ?>