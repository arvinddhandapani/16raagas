﻿<?php
//sec_session_start();
?>
<?php// if (login_check($mysqli) == true) : ?>
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


         <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="index1.html" class="navbar-brand">
                    <img src="assets/img/logo.png" alt="" /></a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">

                

                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="icon-user"></i> User Profile </a>
                            </li>
                            <li><a href="#"><i class="icon-gear"></i> Settings </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="login.html"><i class="icon-signout"></i> Logout </a>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
       <div id="left">
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.jpg" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading"> Jayakumar</h5>
                    <ul class="list-unstyled user-info">
                        
                        <li>
                             <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                           
                        </li>
                       
                    </ul>
                </div>
                <br />
            </div>

            <ul id="menu" class="collapse">

                
                <li class="panel">
                    <a href="index1.html" >
                        <i class="icon-table"></i> Dashboard
	   
                       
                    </a>                   
                </li>

                <li class="panel active">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-tasks"> </i> User     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       &nbsp; <span class="label label-default">2</span>&nbsp;
                    </a>
                    <ul class="in" id="component-nav">
						 <li><a href="user_account.php"><i class="icon-table"></i> User Account </a></li>
						 <li><a href="user_order.php"><i class="icon-table"></i> User Order </a></li>
                    </ul>
                </li> 
 
				<li class="panel active">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-tasks"> </i> Slider     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       &nbsp; <span class="label label-default">2</span>&nbsp;
                    </a>
                    <ul class="in" id="component-nav">
						 <li><a href="slider_upload.php"><i class="icon-table"></i> Slider Upload </a></li>
						 <li><a href="slider_manage.php"><i class="icon-table"></i> Slider Manage </a></li>
                    </ul>
                </li> 
				
				<li class="panel active">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-tasks"> </i> Albums     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       &nbsp; <span class="label label-default">2</span>&nbsp;
                    </a>
                    <ul class="in" id="component-nav">
						 <li><a href="albums_upload.html"><i class="icon-table"></i> Albums Upload </a></li>
						 <li><a href="albums_removal.php"><i class="icon-table"></i> Albums Removal </a></li>
                    </ul>
                </li> 

				<li class="panel active">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-tasks"> </i> Songs     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       &nbsp; <span class="label label-default">2</span>&nbsp;
                    </a>
                    <ul class="in" id="component-nav">
						 <li><a href="songs_upload.php"><i class="icon-table"></i> Songs Upload </a></li>
						 <li><a href="songs_removal.php"><i class="icon-table"></i> Songs Removal </a></li>
                    </ul>
                </li> 
				
				<li class="panel active">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-tasks"> </i> Orders     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       &nbsp; <span class="label label-default">2</span>&nbsp;
                    </a>
                    <ul class="in" id="component-nav">
						 <li><a href="payment_gateway.php"><i class="icon-table"></i> Payment Gateway Details </a></li>
						 <li><a href="order_history.php"><i class="icon-table"></i> Order History </a></li>
                    </ul>
                </li> 
				
                <li><a href="tables.html"><i class="icon-table"></i> Data Tables </a></li>
                
                <li><a href="login.html"><i class="icon-signin"></i> Login Page </a></li>


        </div>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content">

            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2> User Account </h2>
                    </div>
                </div>

                <hr />
				
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User Account Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                        	<th>Verification Code</th>
											<th>Status</th>
											<th>Created At</th>
											<th>Browser</th>
											<th>Lock Account</th>
											<th>Resend Code</th>
                                        </tr>
                                    </thead>
									 
                                         <tbody>
										<?php
	 								   include 'includes/psl-config.php';
      								 $Connect = mysqli_connect(HOST,USER, PASSWORD, DATABASE);
      							   	 $sql = "SELECT u.id, name, u.email, verification_code, status, created_at,song_session FROM users u left join login_details l on u.email = l.email";
      							  	  $result = mysqli_query($Connect, $sql);
									  while ($row=mysqli_fetch_assoc($result)){
										  ?>
									<tr class="odd gradeX">
										<?php
										 echo ("<td>$row[id]</td>");
										echo ("<td>$row[name]</td>");
										echo ("<td>$row[email]</td>");
										echo("<td>$row[verification_code]</td>");
										if ($row['status']=='1'){
										echo("<td>Enabled</td>");	
										} else if ($row['status']=='2'){
											echo("<td>Disabled</td>");	
										} else {
											echo("<td>Unverified</td>");	
										}
                                          										
										echo("<td>$row[created_at]</td>");
										echo("<td>$row[song_session]</td>");
										echo ("<td><a href=\"lock_user.php?id=$row[id]\">Lock</a></td>");
										echo ("<td><a href=\"resend_user.php?id=$row[id]\">Resend</a></td></tr>");
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
