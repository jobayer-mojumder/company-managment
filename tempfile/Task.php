<?php
session_start();
$name=$_SESSION['fname'];
if(!isset($_SESSION['email']) && $_SESSION['loggedin'] == false) {
    //header("location:index.php");
}

?>
<?php
include"mysql_connect.php";
$msg="";


?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>User Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sl-slide.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="css/custom.css">

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
                    <li><a href="user_panel.php">Home</a></li>

                    <li><a href="my_post.php">My Posts</a></li>
                    <li><a href="holiday.php">Holidays</a></li>
                    <li><a href="task.php">Task</a></li>
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


<section class="title center">
    <div class="container">
        <div class="row-fluid">
            <div class="span6">
                <h2><?php echo"Greetings ".$name;?></h2>
                <?php date_default_timezone_set("Asia/Kolkata");
                echo "Today " . date("d/m/Y");
                ?>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="container center">
        <div class="col-sm-10 registration-form center">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Task Name</th>
                    <th>Task Details</th>
                    <th>Assign Date</th>
                    <th>Deadline</th>
                    <th>Progress</th>
                    <th>Action</th>
                </thead>
                <tbody>

                <?php

                $year=date('Y');
                $fname= $_SESSION['fname'];echo$fname;
                    $stmt = $conn->prepare("SELECT * FROM tasks WHERE assign_to='$fname' ORDER BY taskId DESC");


                $stmt->execute();
                $result = $stmt->fetchall();
                $myCount=$stmt->rowCount();

                $sl=0;
                foreach ($result as $row) {
                    $sl++;

                    ?>
                    <tr>

                        <td><?php echo$sl;?></td>
                        <td><?php echo$row['assign_to'];?></td>
                        <td><?php echo$row['taskname'];?></td>
                        <td><?php echo$row['description'];?></td>
                        <td><?php echo$row['assign_date'];?></td>
                        <td><?php echo$row['deadline'];?></td>
                        <td><?php if($row['progress']==100) {
                                echo'<button href="" type="button" class="btn btn-primary btn-sm">Finished</button>';
                            }else {
                                echo$row['progress']."%";
                            }?></td>
                        <td>
                            <form class="" action='' method="POST">
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Save</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }

                ?>

                </tbody>

            </table>
            <?php
            if($myCount<1){
                echo'<div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Empty</strong>
  </div> ';
            }
            ?>
        </div>


    </div>
</div>



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
<script src="js/main.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
</body>
</html>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <form class="" action='' method="POST">
                    <input type="number" name="value" >
                    <button type="submit" class="btn btn-primary" data-dismiss="" name="save">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<?php
if(isset($_POST['save'])){
    $progress=$_POST['value'];echo$progress;
    try{
        $sql = "UPDATE tasks SET progress=$progress WHERE taskId=1";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        echo'Ok';
    }catch(PDOException $e){
        echo$e->getMessage();
    }
}
?>