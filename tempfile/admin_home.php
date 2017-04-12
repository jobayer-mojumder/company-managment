<?php
 	 ob_start();

	session_start();
	//$name=$_SESSION['email'];
	if(!isset($_SESSION['email']) && $_SESSION['loggedin'] == false) {
	     header("location:index.php");
	}
	$website="";
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Admin Panel</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/sl-slide.css">
    <link rel="stylesheet" href="css/datepicker.css">

  <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

  <!-- Le fav and touch icons -->
  <link rel="shortcut icon" href="images/ico/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>

  <!--Header-->
  <header class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a id="logo" class="pull-left" href="index.php"></a>

        <div class="nav-collapse collapse pull-right">
          <ul class="nav">
            <li><a href="admin_home.php">Home</a></li>

            <li><a href="?page=employee_add">New Employee</a></li>
            <li><a href="?page=all_employee">All Employee</a></li>
			 <li><a href="?page=holiday_manage">Holiday Manage</a></li>
			 <li><a href="?page=attendance">Manage Attendance</a></li>
			 <li><a href="?page=task">Assign And View Task</a></li>
			 <li><a href="?page=sent_message">Sent Message</a></li>
			<li><a href="logout.php">Logout</a></li>
            <li class="login">
              <a data-toggle="modal" href="#loginForm"><i class="icon-lock"></i></a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </header>
  <!-- /header -->

<?php
	//include('admin_view/view_article.php');
	if (isset($_GET['page'])) {
		if ($_GET['page'] == 'employee_add') {
			include('admin_view/add_employee.php');
		}else if ($_GET['page'] == 'all_employee') {
			include('admin_view/view_emp.php');
		}else if ($_GET['page'] == 'holiday_manage') {
			include('admin_view/manage_holiday.php');
		}else if ($_GET['page'] == 'attendance') {
            include('admin_view/attendance.php');
		}else if($_GET['page']=='task'){
			include('admin_view/assign_and_view_task.php');
			
		}else if($_GET['page']=='sent_message'){
            include('admin_view/sent_mail.php');
		}
		
	}else{
		include('admin_view/view_article.php');
	}
?>
    


  


<!--Footer-->
<footer id="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="span5 cp">
                &copy; 2016 <a target="_blank" href="http://weopencom.co/" title="">Open Communication</a>. All Rights Reserved.
            </div>
            <!--/Copyright-->

    </div>
</footer>
<!--/Footer-->


<!--  /Login form -->
<script src="js/vendor/jquery-1.9.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/main.js"></script> <script src="js/bootstrap-datepicker.js"></script>

</body>
</html>
<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>