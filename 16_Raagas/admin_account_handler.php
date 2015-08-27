<?php
include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);

$id = $_POST['sid'];
$error_msg = "";

$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
if (strlen($password) != 128) {
    // The hashed pwd should be 128 characters long.
    // If it's not, something really odd has happened
    $error_msg .= '<p class="error">Invalid password configuration.</p>';
}

if (empty($error_msg)) {
    // Create a random salt
    //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

    // Create salted password 
    $password = hash('sha512', $password . $random_salt);



$sql = "UPDATE members SET password ='$password', salt ='$random_salt' where id = '$id'";
if ($Connect->query($sql) === TRUE) {
	header( "refresh:2; url=admin_account.php" );
    echo "Admin Password has been update successfully.";
	echo "<br>";
	echo "<br>";
	
} else {
    echo "Error: " . $sql . "<br>" . $Connect->error;
}
} else {
	header( "refresh:2; url=admin_account.php" );
    echo $error_msg;
}
$Connect->close();

?>