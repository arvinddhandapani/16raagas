<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8" />
<title>Siva Ventures</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" href="../css/style1.css" type="text/css" id="" media="print, projection, screen" />
<link media="screen" charset="utf-8" rel="stylesheet" href="../css/base.css" />
<link media="screen" charset="utf-8" rel="stylesheet" href="../css/skeleton.css" />
<link media="screen" charset="utf-8" rel="stylesheet" href="../css/layout.css" />
<link media="screen" charset="utf-8" rel="stylesheet" href="../css/child.css" />
<link rel="stylesheet" href="../css/animate.min.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="../css/jquery.onebyone.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
    <link href="../css/style.css" media="screen" rel="stylesheet" type="text/css"/>
    <link href="../css/uniform.css" media="screen" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.tools.js"></script>
    <script type="text/javascript" src="../js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/jquery-latest.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
		<script type="text/javascript">
		$(function() {
			$("table").tablesorter({debug: true});
		});
		</script>
<!--<script type="text/javascript" language="javascript" src="js/jquery-1-8-2.js"></script>  -->
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.carousel.js"></script>
<script type="text/javascript" src="js/jquery.color.animation.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js" charset="utf-8"></script>
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery.onebyone.min.js"></script>
<script type="text/javascript" src="js/jquery.touchwipe.min.js"></script>

<!-- color pickers -->
<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />
<script type="text/javascript" src="js/colorpicker.js"></script>
<!-- end of color pickers -->

</head>

<body>
<?php
$form = new ProcessForm();
$form->field_rules = array(
	'cust_name'=>''
);
$form->validate();

class ProcessForm
{
    public $field_rules;
    public $error_messages;
    public $fields;
    private $error_list;
    private $is_xhr;





    function __construct()
    {
        $this->error_messages = array(
            'required' => 'This field is required',
            'email' => 'Please enter a valid email address',
            'number' => 'Please enter a numeric value',
            'url' => 'Please enter a valid URL',
            'pattern' => 'Please correct this value',
            'min' => 'Please enter a value larger than the minimum value',
            'max' => 'Please enter a value smaller than the maximum value'
        );

        $this->field_rules = array();
        $this->error_list = '';
        $this->fields = $_POST;
        $this->is_xhr = $this->xhr();
    }





    function validate()
    {
        if (!empty($this->fields))
        {
            //Validate each of the fields
            foreach ($this->field_rules as $field => $rules)
            {
                $rules = explode('|', $rules);

                foreach ($rules as $rule)
                {
                    $result = null;

                    if (isset($this->fields[$field]))
                    {
                        $param = false;

                        if (preg_match("/(.*?)\[(.*?)\]/", $rule, $match))
                        {
                            $rule = $match[1];
                            $param = $match[2];
                        }

                        $this->fields[$field] = $this->clean($this->fields[$field]);

                        //if the field is a checkbox group create string
                        if (is_array($this->fields[$field]))
                            $this->fields[$field] = implode(', ', $this->fields[$field]);

                        // Call the function that corresponds to the rule
                        if (!empty($rule))
                            $result = $this->$rule($this->fields[$field], $param);

                        // Handle errors
                        if ($result === false)
                            $this->set_error($field, $rule);
                    }
                }
            }

            if (empty($this->error_list))
            {
                if ($this->is_xhr)
                    echo json_encode(array('status' => 'success'));

                $this->process();
            }
            else
            {
                if ($this->is_xhr)
                    echo json_encode(array('status' => 'invalid', 'errors' => $this->error_list));
                else echo $this->error_list;
            }
        }
    }





    function process()
    {
         /**
         * SUCCESS!!
         * There were no errors in the form. Insert your processing logic here (i.e. send an email, save to a
         * database etc.
         *
         * All of the submitted fields are available in the $this->fields variable.
         *
         * Example code to mail the results of the form:
         *
         * IMPORTANT - PLEASE READ:
         * 1. YOU MUST UNCOMMENT THE CODE FOR IT TO WORK.
         *    - This means removing the '//' in front of each line.
         *    - If you do not know what php comments are see here: http://php.net/manual/en/language.basic-syntax.comments.php
         *
         * 2. YOU CAN ENTER ANY EMAIL ADDRESS IN THE $from VARIABLE.
         *    - This is the address that will show in the From column in your mail application.
         *    - If your form contains an email field, and you want to use that value as the $from variable, you can set $from = $this->fields['name of your email field'];
         *    - As stated in the description on codecanyon, this code does not mail attachments. Google 'php html email attachments' for information on how to do this
         */
         foreach($this->fields as $key => $field)
     {
         if ($key == 'cust_name')
             $cust_name = $field;
	 }
  	 global $mysqli;
     global $con;
 
	 $get_cust_id = $mysqli->prepare("select cust_id from cust_info WHERE full_name = ?");
	 $get_cust_id->bind_param('s', $cust_name);
	 $get_cust_id->execute();
	 $get_cust_id->bind_result($cust_id1);
	 $get_cust_id->store_result();
     $get_cust_id->fetch();
     $get_cust_id->close();
	 
	 $credit_report_get = "Select t1.custi_id_fk, t1.today_date, t2.full_name, t3.full_name, t1.total_case_out, t1.total_case_in from outwards_LCR As t1 INNER JOIN cust_info As t2 ON t1.custi_id_fk = t2.cust_id INNER JOIN driver_info As t3 ON t3.driver_id = t1.driver_id_fk where t1.custi_id_fk = ". $cust_id1;
	 
	 $get_sum_lcr_outstanding = "Select sum(total_case_out) - sum(total_case_in) AS result from outwards_LCR where custi_id_fk = ". $cust_id1;
	 $sum_query = mysqli_query($con, $get_sum_lcr_outstanding);
	 $error = mysqli_error($con);
	 $get_sum_lcr_outstanding1 = mysqli_fetch_row($sum_query);
	
	 
	 
	 $get_cust_credit_report = mysqli_query($con, $credit_report_get);
	 $error = mysqli_error($con);
	 $relut = array();
	 
	 $rowCount = mysqli_num_rows($get_cust_credit_report);

	 if ($rowCount != 0) {
	 $get_sum_lcr_outstanding = $get_sum_lcr_outstanding1[0];
 } else {
 	$get_sum_lcr_outstanding = '0';
 } 
	 
	 if ($get_cust_credit_report){
		 ?>
		 Total LCR balance is <?php echo $get_sum_lcr_outstanding?>
		 
	  	<table id="rowspan" cellspacing="0" class="tablesorter">
	  	<thead>
	  		<tr>
			
	  			<!--<th>Customer ID</th>-->
	 			<th>Date</th>
	 			<th>Customer Name</th>
	 			<th>Line Agent Name</th>
	  			<th>LCR out</th>
	 			<th>LCR in</th>
	  		</tr>
	  	</thead>
	  	<tbody>
	 		<?php
	 		while ($row = mysqli_fetch_row($get_cust_credit_report)) {
	 			echo "<tr>";
				date_default_timezone_set('Asia/Calcutta');
				$newDate = date("d-m-Y", strtotime($row[1]));
	 			//echo "<td>". $row[0]. "</td>";
	 			echo "<td>". $newDate. "</td>";
	 			echo "<td>". $row[2]. "</td>";
	 			echo "<td>". $row[3]. "</td>";
	 			echo "<td>". $row[4]. "</td>";
	 			echo "<td>". $row[5]. "</td>";
	 			echo "</tr>";
	 		}
	 		?>
	 	</tbody>
	 </table>
	 <a href= export_customer_lcr.php?msg=<?php echo $cust_id1?>> Export </a>
		
		 <?php
		 
	 } else {
		 echo "Eroor". $error;
	 	//header('Location: ../credit_report_customer.php?msg=Some error'. $error);
	 }

         // $msg = "Form Contents: \n\n";
         // foreach($this->fields as $key => $field)
         //       $msg .= "$key :  $field \n";

         // $to = 'emailaddress@domain.com';
         // $subject = 'Form Submission';
         // $from = 'emailaddress@domain.com';

         // mail($to, $subject, $msg, "From: $from\r\nReply-To: $from\r\nReturn-Path: $from\r\n");


    }



    function set_error($field, $rule)
    {
        if ($this->is_xhr)
        {
            $this->error_list[$field] = $this->error_messages[$rule];
        }
        else $this->error_list .= "<div class='error'>$field: " . $this->error_messages[$rule] . "</div>";
    }





    function xhr()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    }





    /** Validation Functions */
    function required($str, $val = false)
    {

        if (!is_array($str))
        {
            $str = trim($str);
            return ($str == '') ? false : true;
        }
        else
        {
            return (!empty($str));
        }
    }





    function email($str)
    {
        return (!preg_match("/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD", $str)) ? false : true;
    }





    function number($str)
    {
        return (!is_numeric($str)) ? false : true;
    }





    function min($str, $val)
    {
        return ($str >= $val) ? true : false;
    }





    function max($str, $val)
    {
        return ($str <= $val) ? true : false;
    }





    function pattern($str, $pattern)
    {
        return (!preg_match($pattern, $str)) ? false : true;
    }





    function clean($str)
    {
        $str = is_array($str) ? array_map(array("ProcessForm", 'clean'), $str) : str_replace('\\', '\\\\', strip_tags(trim(htmlspecialchars((get_magic_quotes_gpc() ? stripslashes($str) : $str), ENT_QUOTES))));
        return $str;
    }
}


?>