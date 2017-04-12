<?php
	include"mysql_connect.php";
	$err=0;
	try{
		$sql="CREATE TABLE IF NOT EXISTS users(
			userid INT(20) AUTO_INCREMENT,
			fullname VARCHAR(255),
			email VARCHAR(100) UNIQUE,
			contact VARCHAR(50),
			password varchar(100),
			designation VARCHAR(100),
			status VARCHAR(50),
			date DATE,
			PRIMARY KEY(userid)
		)";
		$conn->exec($sql);
		//echo "Table  created successfully";
    }
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
    }
	
		
		if(isset($_POST['submit'])){
			$name=$_POST['fname'];
			$email=$_POST['email'];
			$pass=$_POST['pass']; //echo$pass;
			$contact=$_POST['contact'];//echo$postHeader;
			$designation=$_POST['designation'];//echo$website;
			
			try {
				$sql="INSERT INTO users(fullname,email,contact,password,designation)
				VALUES('$name','$email','$contact','$pass','$designation')";
				 $conn->exec($sql);
				 $err=1;
			}catch(PDOException $e){
				//echo $sql . "<br>" . $e->getMessage();
				$err=2;
			}

		}
?>
 	
	
	
	<section class="title center">
    <div class="container">
      <div class="row-fluid">
        <div class="span6">
          <h2><?php echo"Greetings Admin"?> Please Add Employee</h2>
		  <?php date_default_timezone_set("Asia/Kolkata");
			echo "Today " . date("d/m/Y");
			?>
        </div>
      </div>
    </div>
  </section>

  <section id="registration-page" class="container">
    <form class="center" action='' method="POST">
      <fieldset class="registration-form">
		<?php
			if($err==1){
				echo'<div class="alert alert-success fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Added Successfully!</strong>
				  </div>';
			}else if($err==2){
				echo'<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>There was a problem!</strong>
				  </div>';
			}
		?>
        <div class="control-group">
          <!-- E-mail -->
          <div class="controls">
            <input type="text" id="post" name="fname" placeholder="Full Name" class="input-xlarge" required>
          </div>
        </div>
		<div class="control-group">
          <!-- E-mail -->
          <div class="controls">
            <input type="email" id="post" name="email" placeholder="Email" class="input-xlarge" required>
          </div>
        </div>
		<div class="control-group">
          <!-- E-mail -->
          <div class="controls">
            <input type="password" id="post" name="pass" placeholder="Password" class="input-xlarge" required>
          </div>
        </div>
		<div class="control-group">
          <!-- E-mail -->
          <div class="controls">
            <input type="number" id="post" name="contact" placeholder="Contact Number" class="input-xlarge">
          </div>
        </div>
		
		
		
		
		<div class="control-group">
          <!-- E-mail -->
          <div class="controls">
				<select class="form-control" name="designation">
					<option value="Content Writer">Content Writer</option>
					<option value="Content Manager">Content Manager</option>
					<option value="Server Admin">Server Admin</option>
					<option value="Project Manager">Project Manager</option>
					<option value="Graphics Designer">Graphics Designer</option>
					<option value="Programmer">Programmer</option>
					<option value="Game Developer">Game Developer</option>
					<option value="Co Ordinator">Co Ordinator</option>
					<option value="Accountant">Accountant</option>
					<option value="Supply Chain">Supply Chain</option>
					<option value="Other">Other</option>
			
				</select>
          </div>
        </div>

        <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button type="submit"class="btn btn-success btn-large btn-block" name="submit">Add</button>
          </div>
        </div>
      </fieldset>
    </form>
  </section>
  
  