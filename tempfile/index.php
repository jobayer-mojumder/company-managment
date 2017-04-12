<?php
  ob_start();

?> 
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Open Communication</title>
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
        <a id="logo" class="pull-left" href="index.html"></a>
        <div class="nav-collapse collapse pull-right">
          <ul class="nav">
            <li><a href="index.php">Home</a></li>

            <li><a href="index.php">Login</a></li>
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
          <h1>Login</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- / .title -->       


  <section id="registration-page" class="container">
    <form class="center" method="POST">
      <fieldset class="registration-form">
        <div class="control-group">
          <!-- E-mail -->
          <div class="controls">
            <input type="email" id="email" name="email" placeholder="E-mail" class="input-xlarge" required>
          </div>
        </div>

        <div class="control-group">
          <!-- Password-->
          <div class="controls">
            <input type="password" id="password" name="password" placeholder="Password" class="input-xlarge" required>
          </div>
        </div>


        <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button type="submit" name="submit"class="btn btn-success btn-large btn-block">LOGIN</button>
          </div>
        </div>
      </fieldset>
    </form>
  </section>
  <!-- /#registration-page -->


<!--Footer-->
<footer id="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="span5 cp">
                &copy; 2013 <a target="_blank" href="http://weopencom.co/" title="">Open Communication</a>. All Rights Reserved.
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
	session_start();
	include"mysql_connect.php";
	$email="";
	$pass="";
	if(isset($_POST['submit'])){
		$email=$_POST['email'];
		$pass=$_POST['password'];
			
			/*$email = stripslashes($email);
			$pass = stripslashes($pass);
			$email = mysql_real_escape_string($email);
			$pass = mysql_real_escape_string($pass);*/
            $stmt = $conn->prepare("SELECT * FROM users WHERE email='$email' AND password='$pass' LIMIT 1");
            $stmt->execute();
            $counter=$stmt->rowCount();
			if($counter > 0){
                $result=$stmt->fetchAll();
                foreach($result as $res){
                    $_SESSION['fname']=$name=$res['fullname'];
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['fullname'] = $res['fullname'];
                }

				header("location:user_panel.php");
				//echo'Matched';
			}
			if($email=="memotiur@gmail.com" && $pass=="123"){
				echo'Matched';
				
				header("location:admin_home.php");
				$_SESSION['loggedin'] = true;
				$_SESSION['email'] = $email;
			}
			else
				echo'<div class="alert alert-warning">
  <strong>Email Address Or Password is wrong!</strong>
</div>';
}
	
?>