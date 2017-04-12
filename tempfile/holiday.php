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
	$sql="CREATE TABLE IF NOT EXISTS holiday (
			holidayId INT AUTO_INCREMENT,
			fname varchar(100),
			email varchar(100),
			days INT,
			reason VARCHAR(255),
			from_time varchar(100),
			leave_type varchar(100),
			status INT,
			PRIMARY KEY(holidayId)
		)";
		
		$conn->exec($sql);
		
		if(isset($_POST['submit'])){
			$name=$_SESSION['fname'];
			$email=$_SESSION['email'];
			$status=0;
			
			$days=$_POST['days'];echo$days;
			$reason=$_POST['reason'];echo$reason;
			$from_time=$_POST['pickDate'];echo$from_time;
			$leave=$_POST['leave'];echo$leave;
			//$post = stripslashes($post);
			//$post = mysql_real_escape_string($post);
			
			try{
                $sql=$conn->prepare("INSERT INTO holiday(fname,email,days,reason,from_time,leave_type,status)
			    VALUES('$name','$email','$days','$reason','$from_time','$leave','$status')");
                $sql->execute();
                $msg='<div class="alert alert-success">
				<h6>Request Has Been Recieved</h6></div>';
            }catch(PDOException $e){
                $msg='<div class="alert alert-danger">
				<h6>There was a problem try again</h6></div>';
            }
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
  <!-- / .title -->       
		

  <section id="registration-page" class="container">
		
    <div class="row-fluid">

        <div class="col-sm-6 col-sm-offset-3" style="">
			<form class="" action='' method="POST">
			  <fieldset class="registration-form">
				<div class="control-group">
				  <!-- E-mail -->
				  <?php
				echo$msg;
			?>
				  <div class="controls">
				  
					<input type="number" id="post" name="days" placeholder="How many Days" class="input-xlarge" required>
				  </div>
				</div>
				<div class="control-group">
				  
					<input  type="text" placeholder="From "  id="example1" name="pickDate">
           
				</div>
                  <div class="control-group">
                      <h4>Leave Type</h4>
                      <label class="radio-inline">
                          <input type="radio" value="Sick" name="leave">Sick Leave
                      </label>
                      <label class="radio-inline">
                          <input type="radio" value="Casual" name="leave">Casual Leave
                      </label>

				</div>
				
				<div class="control-group">
				  <!-- E-mail -->
				  <div class="controls">
					 <textarea class="form-control" rows="5" id="comment" name="reason"></textarea>
				  </div>
				</div>
				

				<div class="control-group">
				  <!-- Button -->
				  <div class="controls">
					<button type="submit"class="btn btn-success btn-large btn-block" name="submit">Request Holiday</button>
				  </div>
				</div>
			  </fieldset>
			</form>
		</div>
		
		<div class="">
		<?php
            $year=date("Y");//echo$year;
		    $email=$_SESSION['email'];
			$query=$conn->prepare("SELECT * FROM holiday WHERE email='$email' AND from_time LIKE '%$year'  ORDER BY holidayId DESC");
            $query->execute();
			$result=$query->fetchAll();
            $resCount=$query->rowCount();
			$i=1;
            $casual_counter=0;
            $sick_counter=0;

					if($resCount > 0){
						echo'<table class="table table-bordered" style="background:#fff;">
						<thead>
						  <tr>
							<th>SL</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Reason</th>
							<th>From Date</th>
							<th>Duration</th>
							<th>Leave Type</th>
							<th>Status</th>
							
						  </tr>
						</thead>';
						foreach($result as $row){
							echo' <tbody>
									  <tr>
										<td>';echo$i.'</td>
										<td>';echo$row['fname'].'</td>
										<td>';echo$row['email'].'</td>
										<td>';echo$row['reason'].'</td>
										<td>';echo$row['from_time'].'</td>
										<td>';echo$row['days'].'</td>
										<td>';echo$row['leave_type'].'</td>
										<td>';
											if($row['status']==1){
                                                echo'  <button type="button" class="btn btn-success">Accepted</button>';
											}else if($row['status']==2){
                                                echo'  <button type="button" class="btn btn-danger">Declined</button>';
											}else{
                                                echo'  <button type="button" class="btn btn-warning">Pending</button>';
											}

                                            if($row['leave_type']=='Casual' && $row['status']==1){
                                                $casual_counter=$casual_counter+$row['days'];
                                            }else if($row['leave_type']=='Sick' && $row['status']==1){
                                                $sick_counter=+$sick_counter+$row['days'];
                                            }
										echo'</td>
										
									  </tr>';
						$i++;
						}
						echo'</thead></table>';
					}else
						echo'<div class="alert alert-danger">
  <strong><h5>No post here</h5></strong> 
</div>';
						
						?>
		
		
		</div>

        <div class="row">
            <div class="container text-center">
                <h5>You will get Yearly Sick Leave: 15 days and Casual Leave: 14 days</h5>
                <hr>
                <h5>Total Sick Leave: <?php echo $sick_counter;?>, Remaining : <?php
                    if(15-$sick_counter<0){
                        echo"You already exceeded your sick leave quota. Now your salary will be deducted: Extra Sick leave".($sick_counter-15);
                    }else{
                        echo(15-$sick_counter)."Days";
                    }

                    ?></h5>
                <h5>Total Casual Leave: <?php echo $casual_counter;?>, Remaining : <?php
                    if(15-$casual_counter<0){
                        echo"You already exceeded your Casual leave quota. Now your salary will be deducted: Extra Casual leave".($casual_counter-15);
                    }else{
                        echo(15-$casual_counter)."Days";
                    }

                    ?></h5>
            </div>
        </div>
			
	</div>
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
 <script src="js/bootstrap-datepicker.js"></script>
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


