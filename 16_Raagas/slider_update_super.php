<?php
$id = $_POST['sid'];
$optionsRadios = $_POST['optionsRadios'];
$image_name = $_POST['image_name'];

echo $id;	
echo $optionsRadios;
echo $image_name;

if ($optionsRadios == "selected"){
	$selection = 1;
} else {
	$selection = 0;
}


include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);



$sql = "UPDATE main_slider SET show_hide ='$selection' where id = '$id'";

if ($Connect->query($sql) === TRUE) {
    echo "New record created successfully.";
	echo "<br>";
	echo "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $Connect->error;
}
$Connect->close();





?>