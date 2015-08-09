<?php
$album_name = $_POST['album_name'];
$album_year = $_POST['album_year'];
$music_director = $_POST['music_director'];
$description = $_POST['description'];
$language = $_POST['language'];
$album_image_name = $_FILES["uploadedfile"]["name"];

include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
$sql = "Insert into albums (album_name,album_year,album_img,music_director,album_desc,language) values('$album_name',$album_year,'$album_image_name','$music_director','$description','$language')";

if ($Connect->query($sql) === TRUE) {
    echo "New record created successfully.";
	echo "<br>";
	echo "<br>";
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

    $location = album_image;

    if  (move_uploaded_file($tmp_name, $location.$name)){
        echo 'Album Image Uploaded Successfully';    
        }

        } else {
          echo 'Album Image not uploaded';
          }
    }

?>