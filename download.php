<?php
$file = $_GET['file'];
$filename = basename($file);

header ("Content-type: octet/stream");
header('Content-Disposition: attachment; filename="'.$filename.'"');
//header ("Content-disposition: attachment; filename=".$file.";");
header("Content-Length: ".filesize($file));
readfile($file);
exit;
?>