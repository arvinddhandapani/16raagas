<?php
error_reporting(E_ERROR);
include_once 'admin_include/db_connect.php';
include_once 'admin_include/functions.php';
 
sec_session_start();
?>
<?php if (login_check($mysqli) == true) : ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>Admin Page 16 Raagas</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- END PAGE LEVEL  STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
     <!-- END HEAD -->
     <!-- BEGIN BODY -->
<body class="padTop53 " >

     <!-- MAIN WRAPPER -->
    <div id="wrap">

<?php include 'header_admin.php'; ?>
<?php include 'side_menu.php'; ?>

        <!--PAGE CONTENT -->
        <div id="content">

            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Album List</h2>
                    </div>
                </div>

                <hr />
				
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Albums availabe in system
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Album Id</th>
                                            <th>Album Name</th>
                                            <th>Album Year</th>
                                        	<th>Album Image Name</th>
											<th>Music Director</th>
											<th>Album Description</th>
											<th>Language</th> 
											<th>Date Created</th>
                                            <th>Delete Album</th>											
                                        </tr>
                                    </thead>
									 
                                         <tbody>
										<?php
	 								   include 'includes/psl-config.php';
      								 $Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
      							   	 $sql = "SELECT * FROM albums";
      							  	  $result = mysqli_query($Connect, $sql);
									  while ($row=mysqli_fetch_assoc($result)){
										  ?>
									<tr class="odd gradeX">
										<?php
										 echo ("<td>$row[id]</td>");
										echo ("<td>$row[album_name]</td>");
										echo ("<td>$row[album_year]</td>");
										echo("<td>$row[album_img]</td>");										
										echo("<td>$row[music_director]</td>");	
										echo("<td>$row[album_desc]</td>");
										echo("<td>$row[language]</td>");
										echo ("<td>$row[date_created]</td>");										
										echo ("<td><a href=\"albums_removal_handler.php?id=$row[id]\">Delete</a></td></tr>");
	       													      }
									 	?>	  							  		
                                    </tbody>
                                </table>
                            </div>
                            <div>
							<?php
							if (isset($_GET['res'])){
							$result = $_GET['res'];
							echo "<b>" . $result . "<b>";
							}
							?>
						   </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
       <!--END PAGE CONTENT -->


    </div>

      <?php else : ?>
	         <p>
	             <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
	         </p>
	     <?php endif; ?>
     <!--END MAIN WRAPPER -->
	 <?php// else : ?>
	         <!--<p>
	             <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
	         </p>--!>
	     <?php// endif; ?>

   <!-- FOOTER -->
    <div id="footer">
        <p>&copy;  binarytheme &nbsp;2014 &nbsp;</p>
    </div>
    <!--END FOOTER -->
     <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
        <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
     <!-- END PAGE LEVEL SCRIPTS -->
</body>
     <!-- END BODY -->
</html>
