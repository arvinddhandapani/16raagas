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
	'today_date'=>'required',
	'case_entry_amount'=>'required|number'
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
         elseif ($key == 'line_agent_name')
            $line_agent_name = $field;
         elseif ($key == 'today_date')
             $today_date = $field;
         elseif ($key == 'case_entry_amount')
             $case_entry_amount = $field;
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
	 
	 $query_sum_customer = "select sum(total_case_out) from outwards_LCR WHERE custi_id_fk = ". $cust_id1;
	 $query_sum_customer_in = "select sum(total_case_in) from outwards_LCR WHERE custi_id_fk = ". $cust_id1;
	 $query_lcr_limit_customer = "select lcr_limit from cust_info WHERE cust_id = ". $cust_id1;
	 
	 
	 $query_sum_line_out = "select sum(total_case_out) from outwards_LCR WHERE driver_id_fk = ". $driver_id1;
	 $query_sum_line_in = "select sum(total_case_in) from outwards_LCR WHERE driver_id_fk = ". $driver_id1;
	 $query_lcr_limit_line = "select lcr_limit from driver_info WHERE driver_id = ". $driver_id1;
	 
	 
     $query_string = "INSERT INTO outwards_LCR
     (custi_id_fk, driver_id_fk, total_case_out, today_date)
     VALUES
     ('$cust_id1', '$driver_id1', '$case_entry_amount', '$today_date')";
	 
	
	 $insert_lcr = mysqli_query($con, $query_string);
	 $error = mysqli_error($con);
	
	 $cust_lcr_limit1 = mysqli_query($con, $query_lcr_limit_customer);
     $error1 = mysqli_error($con);
	 $cust_lcr_limit2 = mysqli_fetch_row($cust_lcr_limit1);
	 $cust_lcr_limit = $cust_lcr_limit2[0];
	 
	 $total_outstanding1 = mysqli_query($con, $query_sum_customer);
     $error2 = mysqli_error($con);
	 $total_outstanding2 = mysqli_fetch_row($total_outstanding1);
	 $total_outstanding = $total_outstanding2[0];
	 
	 $total_income1= mysqli_query($con, $query_sum_customer_in);
     $error2 = mysqli_error($con);
	 $total_income2 = mysqli_fetch_row($total_income1);
	 $total_income = $total_income2[0];
	
	 $total_out_customer_lcr = $total_outstanding - $total_income;
	 
	 
	 $line_lcr_limit1 = mysqli_query($con, $query_lcr_limit_line);
     $error3 = mysqli_error($con);
	 $line_lcr_limit2 = mysqli_fetch_row($line_lcr_limit1);
	 $line_lcr_limit = $line_lcr_limit2[0];
	 
	 
	 $line_total_outstanding1 = mysqli_query($con, $query_sum_line_out);
     $error4 = mysqli_error($con);
	 $line_total_outstanding2 = mysqli_fetch_row($line_total_outstanding1);
	 $line_total_outstanding = $line_total_outstanding2[0];
	 
	
	 
	 $total_line_income1= mysqli_query($con, $query_sum_line_in);
     $error2 = mysqli_error($con);
	 $total_income2 = mysqli_fetch_row($total_income1);
	 $total_income_line = $total_income2[0];
	
	 $total_out_line_lcr = $line_total_outstanding - $total_income_line;

	 $lcr_customer_flag = '1';
	 $lcr_line_flag = '1';
	 
	 
	 if ($cust_lcr_limit < $total_out_customer_lcr){
		// echo "inside if";
		$lcr_customer_flag = '0';
		 $lcr_customer_msg = "LCR limit for the customer exceeded. Total amount pending is: $total_out_customer_lcr";
		 
		 //echo $credit_customer_flag;
	 }
	 

		 
	 if ($line_lcr_limit < $total_out_line_lcr){
		// echo "inside if";
		$lcr_line_flag = '0';
		 $lcr_line = "LCR limit for the Line Agent exceeded. Total amount pending is: $total_out_line_lcr";
		 
		 //echo $credit_customer_flag;
	 } 

	 if ($insert_lcr){
		 //echo $credit_customer_flag;
		 if ($lcr_customer_flag == 0 && $lcr_line_flag == 1){
			 header('Location: ../lcr_entry.php?msg='. "\t" .'LCR entered successfully'. "\t". $lcr_customer_msg);
	  	 } elseif ($lcr_line_flag == 0 && $lcr_customer_flag ==1) {
			 header('Location: ../lcr_entry.php?msg='. "\t" .'LCR entered successfully'. "\t". $lcr_line);
	  	 } elseif ($credit_line_flag == 0 && $credit_customer_flag ==0) {
			 header('Location: ../lcr_entry.php?msg='. "\t" .'LCR entered successfully'. "\t". $lcr_customer_msg. "\t". $lcr_line);
	  	 } else {
	  		header('Location: ../lcr_entry.php?msg= LCR entered successfully');
	  }
	  } else {
		  header('Location: ../lcr_entry.php?msg='. "\t" . $error);
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