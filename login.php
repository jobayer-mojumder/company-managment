<?php
if(isset($_SESSION['username'])){
    header("Location:index.php");
}
    include_once('class/CreateTable.php');
    include_once('class/FetchValues.php');
    include_once('class/Config.php');
    $createTableObj=new CreateTable();
    $createTableObj->createUsers();
	$createTableObj->createTaskTable();
	$createTableObj->createHolidayTable();

    $check_user=new FetchValues();
    $config=new Config();
    $status=0;
    if(isset($_POST['login'])){
		echo'Cliked';
        $email=$_POST['email'];//echo$username;
        $password=$_POST['password'];//echo$password;
        $status=$check_user->checkLogin($email,$password);
       if($status==1){
		   echo'okkkkkkkkkkkkkkkkkkkkkkkkkkkkkk';
          header("Location:index.php");
       }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i>
            </a>

            <a class="brand" href="index.php">
                Task Management
            </a>

        </div>
    </div><!-- /navbar-inner -->
</div><!-- /navbar -->



<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="module module-login span4 offset4">
                <form class="form-vertical" method="post" action="">
                    <div class="module-head">
                        <h3>Sign In</h3>
                    </div>

                    <div class="module-body">
                        <?php
                         if($status == 2) $config->getErrorMsg("Username or Password is Wrong");
                        ?>
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <input class="span12" type="email" id="email" name="email" placeholder="Username">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <input class="span12" type="password" name="password"id="inputPassword" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="module-foot">
                        <div class="control-group">
                            <div class="controls clearfix">
                                <button type="submit" class="btn btn-primary pull-right" name="login"">Login</button>
                                <label class="checkbox">
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--/.wrapper-->

<?php
    include_once('inc/footer.php');
?>