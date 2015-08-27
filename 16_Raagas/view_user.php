<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
$id = $_GET["id"];
?>
<?php if (login_check($mysqli) == true) : ?>
<?php
error_reporting(E_ERROR);
include_once 'admin_include/db_connect.php';
include_once 'admin_include/functions.php';
 
sec_session_start();
?>
<?php if (login_check($mysqli) == true) : ?>
<!DOCTYPE html>
 <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>Dashboard </title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
	<link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
	<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css" />
	<link rel="stylesheet" href="assets/plugins/timepicker/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="assets/plugins/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" />
      <style>
        .panel-body a img {
            margin-bottom:5px !important;

        }
          .panel-body a{
              color:transparent!important;
          }
    </style>
    
	
    <link href="assets/css/layout2.css" rel="stylesheet" />
       <link href="assets/plugins/flot/examples/examples.css" rel="stylesheet" />
       <link rel="stylesheet" href="assets/plugins/timeline/timeline.css" />
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
    <div id="wrap" >
        

        <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="index.html" class="navbar-brand">
                    <img src="assets/img/logo.png" alt="" />
                        
                        </a>
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
                            <li><a href="login.php"><i class="icon-signout"></i> Logout </a>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
       <div id="left" >

            <ul id="menu" class="collapse">

                
                <li class="panel active">
                    <a href="index.php" >
                        <i class="icon-table"></i> Dashboard
	   
                       
                    </a>                   
                </li>


                <li class="panel ">
                    <a href="user_search.php" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                       <i class="icon-search"> </i>Search User Details     
	   
                   
                    </a>
                
                </li>
       <li class="panel ">
           <a href="insert_user.php" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
              <i class="icon-user"> </i> </i> Register User Details    

           </a>

       </li>
       <CR>
            </ul>

        </div>

        <!--END MENU SECTION -->



        <!--PAGE CONTENT -->
	        <!--PAGE CONTENT -->
	         <div id="content">
           
	                 <div class="inner">
	                     <div class="row">
	                 <div class="col-lg-12">
	                     <h1 class="page-header">Advance Form Elements</h1>
	                 </div>
	             </div>
                     
                    
                    
                                

	 <div class="row">
	 <div class="col-lg-12">
	     <div class="box dark">
	         <header>
	             <div class="icons"><i class="icon-edit"></i></div>
	             <h5>Input Text Fields</h5>
	             <div class="toolbar">
	                 <ul class="nav">
	                     <li>
	                         <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
	                             <i class="icon-chevron-up"></i>
	                         </a>
	                     </li>
	                 </ul>
	             </div>
	         </header>
			 <?
			 	include 'includes/psl-config.php';
				$Connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
			 	$query = "SELECT * FROM user_datails where user_id='$id'";
				$result = mysqli_query($Connect, $query);
					$row = mysqli_fetch_assoc($result);
			 ?>
	         <div id="div-1" class="accordion-body collapse in body">
	             <form class="form-horizontal" action="process_form.php" method="post" novalidate="">

	                 <div class="form-group">
	                     <label for="text1" class="control-label col-lg-4">Given Name</label>

	                     <div class="col-lg-8">
	                         <input type="text" disabled="disabled" name="giname" id="text1" value="<?php echo "$row[name]";?>" class="form-control" ></input>
	                     </div>
	                 </div>
	                 <div class="form-group">
	                     <label for="text1" class="control-label col-lg-4">Father's Name</label>

	                     <div class="col-lg-8">
	                         <input type="text" disabled="disabled" id="text1" name="father" value="<?php echo "$row[father_name]";?>" class="form-control" />
	                     </div>
	                 </div>
	                 <div class="form-group">
	                     <label for="text1" class="control-label col-lg-4">Place of Birth</label>

	                     <div class="col-lg-8">
	                         <input type="text" id="text1" disabled="disabled" name="place" value="<?php echo "$row[place]";?>" class="form-control" />
	                     </div>
	                 </div>
	                 <div class="form-group">
	                     <label class="control-label col-lg-4">Gender</label>

	                     <div class="col-lg-8">
	                         <div class="checkbox">
	                            <!-- <label> -->
	                                 <input type="radio" name="gender" value="male1" disabled="disabled" checked="checked">Male1
	                           <!--  </label> -->
	                         </div>
	                         <div class="checkbox">
	                             <!--<label> -->
	                                 <input type="radio" name="gender" disabled="disabled" value="female"> Female
									 <!--</label>-->
	                         </div>
						 </div>
	                <!--<div id="datePickerBlock" class="body collapse in"> -->
						<CR>
							<CR>
								<BR>
							<div class="form-group">
	                         <label class="control-label col-lg-4" for="dp2">Date Of Birth</label>

	                         <div class="col-lg-3">
	                             <input type="text" disabled="disabled" class="form-control" value="<?php echo "$row[dob]";?>" data-date-format="mm/dd/yy"
	                                    id="dp2" name="dob"/>
	                         </div>
	                     </div>
					<!-- </div>-->
						 <!--Image Upload Starts here-->
						 <div class="col-lg-12">
						<a id="example5" href="uploads/<?php echo "$row[image]";?>" title="<?php echo "$row[name]";?>"><img src="uploads/<?php echo "$row[image]";?>" alt="" height="300" width="450"/></a>
					</div>
						 <!--Image Upload Ends-->
						 
	                     <div class="form-group">
	                         <label class="control-label col-lg-4">Comments</label>
							 <div class="col-lg-4">
	                         <textarea class="form-control" rows="3" name="comment"><?php  "$row[comment]";?></textarea>
							 </div>
	                     </div>
						 <div class="col-lg-4">
						 <input type="submit" value="Submit">
					 </div>
					 
						 
	 					
	             </form>
	         </div>
	     </div>
	 </div>
   
	     </div>


                










                    
	                     </div>
                    
                    
	                   </div>
                 
                

                

                
    </div>

     <?php else : ?>
	         <p>
	             <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
	         </p>
	     <?php endif; ?>
     <!--END MAIN WRAPPER -->

	 <?php else : ?>
	         <p>
	             <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
	         </p>
	     <?php endif; ?>
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
	<script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>v
	<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="assets/plugins/daterangepicker/moment.min.js"></script>
	<script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/plugins/timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="assets/plugins/flot/jquery.flot.time.js"></script>
     <script  src="assets/plugins/flot/jquery.flot.stack.js"></script>
    <script src="assets/js/for_index.js"></script>
    <script src="assets/plugins/jquery.fancybox-1.3.4/jquery-1.4.3.min.js"></script> <!--important for gallery-->
     <script src="assets/plugins/jquery.fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js"></script> 
    <script src="assets/plugins/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.js"></script>
     <script src="assets/js/image_gallery.js"></script>
	
	
   
    <!-- END PAGE LEVEL SCRIPTS -->


</body>

    <!-- END BODY -->
</html>
