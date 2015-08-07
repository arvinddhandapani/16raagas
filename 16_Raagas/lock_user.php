<?php
include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
$user_id = $_GET["id"];
$sql = "update users set status = '2' where id = $user_id";
if (mysqli_query($Connect, $sql)) {
    echo "Record with user id:$user_id updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($Connect);
}
mysqli_close($Connect);										 
header("Location: http://127.0.0.1/projects/16_Raagas/user_account.php");
?>
