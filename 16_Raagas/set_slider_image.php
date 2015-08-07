<?php
include 'includes/psl-config.php';
$Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
$image_id = $_POST['sid'];
echo $image_id;

/*if(isset($_POST['slider_check']) && 
   $_POST['slider_check'] == 'Yes') 
{
    echo "Yes";
}
else
{
    echo "No";
}*/    

/*$sql1 = "update main_slider set show_hide = '1' where id = $image_id";
$sql2 = "update main_slider set show_hide = '0' where id = $image_id";
if ($select_flag=1) {
if (mysqli_query($Connect, $sql1)) {
    echo "Record with user id:$user_id updated successfully";
                                   } else {
                                     echo "Error updating record: " . mysqli_error($Connect);
                                          }
                     } else {
						 if (mysqli_query($Connect, $sql2)) {
                         echo "Record with user id:$user_id updated successfully";
                                                            } else {
                                                              echo "Error updating record: " . mysqli_error($Connect);
                                                                    }
					        }
						 
mysqli_close($Connect);										 
header("Location: http://127.0.0.1/projects/16_Raagas/user_account.php");*/
?>
