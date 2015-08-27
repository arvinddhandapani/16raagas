<?php
//sec_session_start();
?>

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
                        <h2> Slider </h2>
                    </div>
                </div>

                <hr />
				
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Slider Image Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">	
												
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                 <thead>
                                     <tr>
                                         <th>Id</th>
                                         <th>Image Name</th>
                                         <th>Show-Hide Status</th>                                    
										<th>Select/Unselect Image</th>									       											
										<th>Set</th>
									 </tr>
								
                                 </thead>
								 
                                      <tbody>
									<?php
 								   include 'includes/psl-config.php';
   								 $Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
   							   	 $sql = "SELECT id,image_name,show_hide FROM main_slider";
   							  	  $result = mysqli_query($Connect, $sql);
								  while ($row=mysqli_fetch_assoc($result)){
									?>  
								<tr class="odd gradeX">
									<form action="slider_manage_handler.php" method="post">	
									<?php
									
									echo("<td><label>$row[id]</label><input type=text value=$row[id] name=sid hidden></input></td>");
									echo ("<td><input type=text value=$row[image_name] name=image_name disabled></input></td>");
									if ($row['show_hide']=='1'){
									echo("<td>Image Shown in Slider</td>");	
									}  elseif ($row['show_hide']=='0') {
										echo("<td>Image Not Shown</td>");	
									}							
                                     if ($row['show_hide']=='1'){
										?>
										<td><label><input type="radio" name="optionsRadios" id="optionsRadios1" value="selected" checked="True" /> Show</label><br>
									<label><input type="radio" name="optionsRadios" id="optionsRadios1" value="unselected" /> Hide</label></td>
									<?php	
									}  else {
										?>
										<td><label><input type="radio" name="optionsRadios" id="optionsRadios1" value="selected"  /> Show</label><br>
								<label><input type="radio" name="optionsRadios" id="optionsRadios1" value="unselected" checked="True" /> Hide</label></td>
									<?php
									}
									echo("<td><input type=submit name=submit value=Set></input></td>");										
									?>
										</form>	</tr>
									<?php							
       								} 
								 	?>	  
												  		
                                 </tbody>							
                                </table>		
													
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
