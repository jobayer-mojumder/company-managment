<?php
	session_start();
	$name=$_SESSION['fname'];
	
	if(!isset($_SESSION['email']) && $_SESSION['loggedin'] == false) {
	     header("location:index.php");
	}

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
          <h2>Your Posts</h2>
		  <?php date_default_timezone_set("Asia/Kolkata");
			echo "Today " . date("d/m/Y");
			?>
        </div>
      </div>
    </div>
  </section>
  <!-- / .title -->      

 


  <section id="" class="container">
   <?php
				include('mysql_connect.php');
					$email=$_SESSION['email'];
					$query=$conn->prepare("SELECT * FROM post_list WHERE email='$email' ORDER BY postId DESC LIMIT 20");
					$query->execute();
                    $contM=$query->rowCount();
                    $result=$query->fetchAll();
					$i=1;
					if($contM> 0){
						echo'<table class="table table-bordered">
						<thead>
						  <tr>
							<th>SL</th>
							<th>Full Name</th>
							<th>Time</th>
							<th>Post</th>
							<th>Website</th>
							<th>Delete</th>
							
						  </tr>
						</thead>';
						foreach($result as $row){
							echo' <tbody>
									  <tr>
										<td>';echo$i.'</td>
										<td>';echo$row['fullname'].'</td>
										<td>';echo$row['time'].'</td>
										<td><a href="';echo$row['postLink'].'" target="_BLANK">';echo$row['postHeader'].'</a></td>
										<td>';echo$row['website'].'</td>
										<td><a href="delete_post.php?id=' . $row['postId'] . '">Delete</a></td>
									  </tr>';
						$i++;
						}
						echo'</thead></table>';
					}else
						echo'<div class="alert alert-danger">
  <strong>Empty</strong> 
</div>';
						
						?>
  </section>
  <!-- /#registration-page -->

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

</body>
</html>
<?php
	include"mysql_connect.php";
	$sql="CREATE TABLE IF NOT EXISTS post_list (
			postId INT(20) AUTO_INCREMENT,
			fullname VARCHAR(75),
			email VARCHAR(100),
			time varchar(20),
			postHeader VARCHAR(255),
			postLink VARCHAR(255),
			website VARCHAR(50),
			PRIMARY KEY(postId)
		)";
		$conn->exec($sql);
		
		if(isset($_POST['submit'])){
			$name=$_SESSION['fname'];
			$email=$_SESSION['email'];
			date_default_timezone_set("Asia/Kolkata");
			echo "The time is " . date("d/m/Y");
			$time=date("d.m.Y");
			$postHeader=$_POST['post_name'];//echo$postHeader;
			$post=$_POST['post_name'];//echo$postHeader;
			$website=$_POST['website'];echo$website;
			$sql="INSERT INTO post_list(fullname,email,time,postHeader,postLink,website)
			VALUES('$name','$email','$time','$postHeader','$post','$website')";
			if(mysqli_query($conn,$sql)){
				echo'Inserted';
			}else{
				echo'Not Inserted'.mysqli_error($conn);
			}
		}
?>
