<?php
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <style type="text/css">
        .star{
    color: red;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="css/tab_layout.css" rel="stylesheet">
    <link type="text/css" href="css/custom.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
          rel='stylesheet'>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php">Task Management</a>
            <div class="nav-collapse collapse navbar-inverse-collapse">


                <ul class="nav pull-right">
                    <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="images/user.png" class="nav-avatar" />
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Your Profile</a></li>
                            <li><a href="#">Edit Profile</a></li>
                            <li><a href="#">Account Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="?page=logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="span3">
                <div class="sidebar">

                    <?php
                    if($_SESSION['user_type']=='company_employee'){
                    ?>
                    <!--School Admin View-->
                    <ul class="widget widget-menu unstyled">
                        <li><a href="?page=employee_view_task"><i class="menu-icon icon-user"></i>View Task</a></li>
                        <li><a href="?page=request_holiday"><i class="menu-icon icon-user"></i>Leave Request</a></li>
                        <li><a href="?page=request_view"><i class="menu-icon icon-user-md"></i>View Request</a></li>
                    </ul>
                    <?php } ?>

                    <?php
                        if($_SESSION['user_type']=='super_admin'){
                    ?>
                    <!--/.Super Admin-nav-->
                    <ul class="widget widget-menu unstyled">
                        <li><a href="?page=add_employee"><i class="menu-icon icon-user"></i>Add Employee</a></li>
                        <li><a href="?page=view_employee"><i class="menu-icon icon-user"></i>View Employee</a></li>
                        <li><a href="?page=give_task"><i class="menu-icon icon-user"></i>Give Task</a></li>
                        <li><a href="?page=view_task"><i class="menu-icon icon-user"></i>View Task</a></li>
                    </ul>
					<ul class="widget widget-menu unstyled">
                        <li><a href="?page=holiday_request_view"><i class="menu-icon icon-user"></i>Holiday Request</a></li>
                    </ul>
                    <?php } ?>

                    <!--School Admin View-->
                    <?php
                    if($_SESSION['user_type']=='company_accountant'){
                        ?>
                    <ul class="widget widget-menu unstyled">
                        <li><a href="?page="><i class="menu-icon icon-bold"></i> Something Here</a></li>
                        <li><a href="?page="><i class="menu-icon icon-book"></i>Something Here </a></li>
                    </ul>
                    <?php } ?>
                </div>
                <!--/.sidebar-->
            </div>


