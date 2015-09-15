<script type="text/javascript">
setTimeout("window.location='songs_upload.php'",3000);
</script>
<?php
$album_name = $_POST['select1'];
$song_name = $_POST['song_name'];
$price = $_POST['price'];
$artist_details = $_POST['artist_details'];
$song_name_mp3 = $_FILES["uploadedfile_mp3"]["name"];
$song_name_wmv = $_FILES["uploadedfile_wmv"]["name"];
$song_name_demo = $_FILES["uploadedfile_mp3"]["name"];
include 'mp3file.class.php';
include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
$query = "SELECT `id` FROM `albums` where album_name='$album_name'";
$result = mysqli_query($Connect, $query)
or die('Error querying database');
$row = mysqli_fetch_array($result);
$album_id = $row['id'];
$is_mp3 = 0;
$is_wmv = 0;
$duration = "00:00:00";
$duration_wmv = "00:00:00";
$duration_demo = "00:00:00";
$name_mp3 = $_FILES["uploadedfile_mp3"]["name"];
$name_wmv = $_FILES["uploadedfile_wmv"]["name"];
$name_demo = $_FILES["uploadedfile_mp3"]["name"];
//$size = $_FILES['file']['size']
//$type = $_FILES['file']['type']
$tmp_name_mp3 = $_FILES['uploadedfile_mp3']['tmp_name'];
$tmp_name_wmv = $_FILES['uploadedfile_wmv']['tmp_name'];
//$tmp_name_demo = $_FILES['uploadedfile_demo']['tmp_name'];
$error_mp3 = $_FILES['uploadedfile_mp3']['error'];
if (!empty($name_mp3 or $name_wmv)) {
if (isset ($name_mp3)) {
	
    if (!empty($name_mp3)) {
    $is_mp3 = 1; 
    $location_mp3 = mp3_Songs;
	//Prepare Demo SOng
	require_once 'phpmp3.php';
	$mp3 = new PHPMP3($tmp_name_mp3);
	$mp3 = $mp3->extract(20, 10);
	$mp3->save(demo_songs.$name_mp3);
	$mp3file = new MP3File(demo_songs.$name_demo);
	$duration2 = $mp3file->getDuration();
	$duration_demo = MP3File::formatTime($duration2);
	
    echo 'Demo Song Uploaded Successfully';    
	echo "<br>";
    echo "<br>";
    if  (move_uploaded_file($tmp_name_mp3, $location_mp3.$name_mp3)){
		$mp3file = new MP3File($location_mp3.$name_mp3);
		$duration2 = $mp3file->getDuration();
		$duration = MP3File::formatTime($duration2);
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
		$mp3file = new MP3File($location_wmv.$name_wmv);
		$duration2 = $mp3file->getDuration();
		$duration_wmv = MP3File::formatTime($duration2);
        echo 'WMV Song Uploaded Successfully';    
		echo "<br>";
	    echo "<br>";
        } else {
          echo 'WAV Song not uploaded';
          }
        } 
    }
	$sql = "Insert into songs (album_id,song_name,main_song_mp3,main_song_duration,wmv_song_duration,main_song_wmv,demo_song,demo_song_duration,price,artist_details,is_MP3,is_WMV) values('$album_id','$song_name','$song_name_mp3','$duration','$duration_wmv','$song_name_wmv','$song_name_demo','$duration_demo','$price','$artist_details','$is_mp3','$is_wmv')";
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
?>