<?php
/**
 * Created with WebFormGenerator.eu
 * Powered by www.easyclick.ch
 */
include 'db_connect.php';
include 'psl-config.php';
$form = new ProcessForm();
$form->field_rules = array(
	'cust_name'=>'required',
	'line_agent_name'=>'required',
	'settlement_number'=>'required',
	'today_date'=>'required',
	'bill_number'=>'required',
	'credit_entry_amount'=>'required|number'
);
$form->validate();

class ProcessForm
{

    public $field_rules;
    public $error_messages;
    public $fields;
    private $error_list;
    private $is_xhr;
	public $credit_customer_flag;
	public $credit_line_flag;





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


	function check_bill_customer($cust_id1)
	{
	 	global $mysqli;
	    global $con;
   	 $get_amount_customer = $mysqli->prepare("select sum(amount) from outward_credit WHERE custi_id_fk = ? and bill_state = 0");
   	 $get_amount_customer->bind_param('i', $cust_id1);
   	 $get_amount_customer->execute();
   	 $get_amount_customer->bind_result($amount_total);
   	 $get_amount_customer->store_result();
     $get_amount_customer->fetch();
     $get_amount_customer->close();
	 return $amount_total;	
	}
	
	
	function get_credit_limit($cust_id1)
	{
	 	global $mysqli;
	    global $con;
   	 $get_cust_credit_limit = $mysqli->prepare("select credit_limit from cust_info WHERE custi_id = ?");
   	 $get_cust_credit_limit->bind_param('i', $cust_id1);
   	 $get_cust_credit_limit->execute();
   	 $get_cust_credit_limit->bind_result($credit_limit);
   	 $get_cust_credit_limit->store_result();
     $get_cust_credit_limit->fetch();
     $get_cust_credit_limit->close();
	 return $credit_limit;	
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
         elseif ($key == 'line_agent_name')
            $line_agent_name = $field;
         elseif ($key == 'settlement_number')
             $settlement_number = $field;
         elseif ($key == 'today_date')
             $today_date = $field;
         elseif ($key == 'bill_number')
             $bill_number = $field;
         elseif ($key == 'credit_entry_amount')
             $credit_entry_amount = $field;
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
	 $get_line_id = $mysqli->prepare("select driver_id from driver_info where full_name = ?");
	 $get_line_id->bind_param('s', $line_agent_name);
	 $get_line_id->execute();
	 $get_line_id->bind_result($driver_id1);
	 $get_line_id->store_result();
     $get_line_id->fetch();
     $get_line_id->close();
	 
	 
	 date_default_timezone_set('Asia/Calcutta');
	 $timestamp = strtotime($today_date);
	 $today_date = date('Y-m-d',$timestamp );
	 
	 
	 $query_sum_customer = "select sum(amount) from outwards_credit WHERE bill_state = 0 and custi_id_fk = ". $cust_id1;
	 $query_credit_limit_customer = "select credit_limit from cust_info WHERE cust_id = ". $cust_id1;
	 $query_sum_line = "select sum(amount) from outwards_credit WHERE bill_state = 0 and driver_id_fk = ". $driver_id1;
	 $query_credit_limit_line = "select credit_limit from driver_info WHERE driver_id = ". $driver_id1;
     $query_string = "INSERT INTO outwards_credit
     (custi_id_fk, driver_id_fk, bill_no, settlement_no, date_out, amount)
     VALUES
     ('$cust_id1', '$driver_id1', '$bill_number', '$settlement_number', '$today_date', '$credit_entry_amount')";
    
	
	 $insert_credit = mysqli_query($con, $query_string);
	 $error = mysqli_error($con);
	 
	 $cust_credit_limit1 = mysqli_query($con, $query_credit_limit_customer);
     $error1 = mysqli_error($con);
	 $cust_credit_limit2 = mysqli_fetch_row($cust_credit_limit1);
	 $cust_credit_limit = $cust_credit_limit2[0];
	 
	 
	 $total_outstanding1 = mysqli_query($con, $query_sum_customer);
     $error2 = mysqli_error($con);
	 $total_outstanding2 = mysqli_fetch_row($total_outstanding1);
	 $total_outstanding = $total_outstanding2[0];
	 
	 $line_credit_limit1 = mysqli_query($con, $query_credit_limit_line);
     $error3 = mysqli_error($con);
	 $line_credit_limit2 = mysqli_fetch_row($line_credit_limit1);
	 $line_credit_limit = $line_credit_limit2[0];
	 
	 
	 $line_total_outstanding1 = mysqli_query($con, $query_sum_line);
     $error4 = mysqli_error($con);
	 $line_total_outstanding2 = mysqli_fetch_row($line_total_outstanding1);
	 $line_total_outstanding = $line_total_outstanding2[0];


	 $credit_customer_flag = '1';
	 $credit_line_flag = '1';
	 
	 
	 if ($cust_credit_limit < $total_outstanding){
		// echo "inside if";
		$credit_customer_flag = '0';
		 $credit_customer = "Credit limit for the customer exceeded. Total amount pending is: $total_outstanding";
		 
		 //echo $credit_customer_flag;
	 }
	 

	 if ($line_credit_limit < $line_total_outstanding){
		// echo "inside if";
		$credit_line_flag = '0';
		 $credit_line = "Credit limit for the Line Agent exceeded. Total amount pending is: $line_total_outstanding";
		 
		 //echo $credit_customer_flag;
	 } 

	 if ($insert_credit){
		 //echo $credit_customer_flag;
		 if ($credit_customer_flag == 0 && $credit_line_flag == 1){
			 header('Location: ../credit_entry.php?msg=Bill'. "\t" . $bill_number. "\t" .'entered successfully'. "\t". $credit_customer);
	  	 } elseif ($credit_line_flag == 0 && $credit_customer_flag ==1) {
			 header('Location: ../credit_entry.php?msg=Bill'. "\t" . $bill_number. "\t" .'entered successfully'. "\t". $credit_line);
	  	 } elseif ($credit_line_flag == 0 && $credit_customer_flag ==0) {
			 header('Location: ../credit_entry.php?msg=Bill' . $bill_number. 'entered successfully'. $credit_line. "\t". $credit_customer);
	  	 } else {
	  		header('Location: ../credit_entry.php?msg=Bill'. "\t" . $bill_number. "\t" .'entered successfully');
	  }
	  } else {
		  header('Location: ../credit_entry.php?msg=Bill'. "\t" . $error);
	  	echo $error;
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