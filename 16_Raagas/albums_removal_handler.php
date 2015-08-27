<?php
include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
$album_id = $_GET["id"];
$sql = "delete from albums where id = '$album_id'";
if (mysqli_query($Connect, $sql)) {
    $res1 = "Record with album id:$album_id removed successfully";
} else {
    $res1 = "Error deleting record: " . mysqli_error($Connect);
}
mysqli_close($Connect);	
echo $res1;
echo "<br>";
echo "Please Wait while we redirect you";
header('Refresh: 2; albums_removal.php');									 
//header("Location: albums_removal.php?res=$res1");
?>
