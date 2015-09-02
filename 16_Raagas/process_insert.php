	<?php
	 include 'includes/db_connect.php';
    include 'includes/psl-config.php';
    global $con;
    $con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
		$target_dir = "uploads";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		$file_tmp =$_FILES['file']['tmp_name'];
		$file_name = $_FILES["file"]["name"];
	   if(is_dir($target_dir)==false)
		{
			mkdir("$target_dir", 0700);	// Create directory if it does not exist
		}
	   if(is_dir("$target_dir/".$file_name)==false)
		{
			move_uploaded_file($file_tmp,"$target_dir/".$file_name);
		}
	  else
		{									// rename the file if another one exist
			$new_dir="$desired_dir/".$file_name.time();
			rename($file_tmp,$new_dir);	
			move_uploaded_file($file_tmp,"$target_dir/".$file_name);			
		}
		
    }

	
	?>