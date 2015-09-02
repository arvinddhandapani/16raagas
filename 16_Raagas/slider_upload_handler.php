<?php
$slider_image_name = $_FILES["uploadedfile"]["name"];

include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
$sql = "Insert into main_slider (image_name) values('$slider_image_name')";

if ($Connect->query($sql) === TRUE) {
    echo "New record created successfully.  ";
	} else {
    echo "Error: " . $sql . "<br>" . $Connect->error;
}

$Connect->close();

$name = $_FILES["uploadedfile"]["name"];
//$size = $_FILES['file']['size']
//$type = $_FILES['file']['type']

$tmp_name = $_FILES['uploadedfile']['tmp_name'];
$error = $_FILES['uploadedfile']['error'];

if (isset ($name)) {
    if (!empty($name)) {

    $location = slider_image_path;
    
    if  (move_uploaded_file($tmp_name, $location.$name)){
		echo "Image Uploaded Successfully.";	
        }

        } else {
          echo "Slider Image not uploaded.";
          }
    }


?>