<?php
$album_name = $_POST['select1'];
$song_name = $_POST['song_name'];
$price = $_POST['price'];
$artist_details = $_POST['artist_details'];
$song_name_mp3 = $_FILES["uploadedfile_mp3"]["name"];
$song_name_wmv = $_FILES["uploadedfile_wmv"]["name"];

include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);

$query = "SELECT `id` FROM `albums` where album_name='$album_name'";
$result = mysqli_query($Connect, $query)
or die('Error querying database');
$row = mysqli_fetch_array($result);
$album_id = $row['id'];

$is_mp3 = 0;
$is_wmv = 0;

if(isset($_POST['submit'])){
$name_mp3 = $_FILES["uploadedfile_mp3"]["name"];
$name_wmv = $_FILES["uploadedfile_wmv"]["name"];
//$size = $_FILES['file']['size']
//$type = $_FILES['file']['type']
$tmp_name_mp3 = $_FILES['uploadedfile_mp3']['tmp_name'];
$tmp_name_wmv = $_FILES['uploadedfile_wmv']['tmp_name'];
$error_mp3 = $_FILES['uploadedfile_mp3']['error'];
if (!empty($name_mp3 or $name_wmv)) {
if (isset ($name_mp3)) {
	
    if (!empty($name_mp3)) {
    $is_mp3 = 1; 
    $location_mp3 = mp3_Songs;
    if  (move_uploaded_file($tmp_name_mp3, $location_mp3.$name_mp3)){
        echo 'MP3 Song Uploaded Successfully';    
		echo "<br>";
	    echo "<br>";
	} else {
          echo 'MP3 Song not uploaded';
          }
        } 
    }	  
		  
if (isset ($name_wmv)) {
	
    if (!empty($name_wmv)) {
    $is_wmv = 1; 
    $location_wmv = wmv_songs;
    if  (move_uploaded_file($tmp_name_wmv, $location_wmv.$name_wmv)){
        echo 'WMV Song Uploaded Successfully';    
		echo "<br>";
	    echo "<br>";
        } else {
          echo 'WMV Song not uploaded';
          }
        } 
    }
	$sql = "Insert into songs (album_id,song_name,main_song_mp3,main_song_wmv,price,artist_details,is_MP3,is_WMV) values('$album_id','$song_name','$song_name_mp3','$song_name_wmv','$price','$artist_details','$is_mp3','$is_wmv')";
	if ($Connect->query($sql) === TRUE) {
    echo "New record created successfully.";
	
    } else {
      echo "Error: " . $sql . "<br>" . $Connect->error;
           }
		   
    $Connect->close();
}
else      {
          echo 'Please choose atleast one file to upload';
          }
}
?>