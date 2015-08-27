<?php
include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
$song_id = $_GET["id"];
$sql = "delete from songs where song_id = '$song_id'";
if (mysqli_query($Connect, $sql)) {
    $res1 = "Record with song id:$song_id removed successfully";
} else {
    $res1 = "Error deleting record: " . mysqli_error($Connect);
}
mysqli_close($Connect);		
header('Refresh: 2; songs_removal.php');									 
echo $res1;
echo "<br>";
echo "Please Wait while we redirect you";
								 
//header("Location: http://127.0.0.1/projects/16_Raagas/songs_removal.php?res=$res1");
?>
