<?php
	include"mysql_connect.php";
	$err=0;
	try{
		$sql="CREATE TABLE IF NOT EXISTS tasks(
			taskId INT(20) AUTO_INCREMENT,
			assign_to VARCHAR(255),
			taskname VARCHAR(255),
			description VARCHAR(255),
			assign_date DATE,
			deadline VARCHAR(255),
			priority varchar(100),
			assign_by varchar(100),
			progress INT,
			status VARCHAR(50),
			assign_time TIMESTAMP,
			PRIMARY KEY(taskId)
		)";
		$conn->exec($sql);
		//echo "Table  created successfully";
    }
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
    }

	
	if(isset($_POST['submit'])){
        $assign_to=$_POST['assignto'];//echo$assign_to;
        $task=$_POST['task'];//echo$task;
        $task_details=$_POST['task_details'];
        $deadline=$_POST['deadline'];//echo$deadline;
        $assign_date=date("Y-m-d");
        $assign_by=$_SESSION['email'];//echo$assign_by;
        $progress=0;

        try{
            $sql=$conn->prepare("INSERT INTO tasks(assign_to,taskname,description,assign_date,deadline,assign_by,progress)
                  VALUES('$assign_to','$task','$task_details','$assign_date','$deadline','$assign_by','0')");
            $sql->execute();
            $err=1;



        }catch(PDOException $e){
            $err=2;
            //echo"There was a problem.".$e->getMessage();

        }
    }
?>


<div class="container">
<br>
<form class="col-sm-8 center" action='' method="POST" style="width: 100%">
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
           		<select class="form-control" name="assignto">

					<?php
							include"mysql_connect.php";
							$stmt = $conn->prepare("SELECT * FROM users ORDER BY userid DESC");
							$stmt->execute();
							$result = $stmt->fetchall();
							foreach ($result as $row) {
								echo'<option>'.$row['fullname'].'</option>';
							}
					?>
					
				</select>
          </div>
        </div>
		<div class="control-group">
          <!-- E-mail -->
          <div class="controls">
            <input type="text" id="post" name="task" placeholder="Task Name" class="input-xlarge" required>
          </div>
        </div>
		<div class="control-group">
          <!-- E-mail -->
          <div class="controls">
            <textarea rows="4" cols="" placeholder="Task Details" name="task_details"></textarea>
          </div>
        </div>
		

		<div class="control-group">
          <!-- E-mail -->
          <div class="controls">
           <input  type="text" placeholder="Deadline "  id="example1" name="deadline">
          </div>
        </div>
		
		
        <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button type="submit"class="btn btn-success btn-large btn-block" name="submit">Save</button>
          </div>
        </div>
      </fieldset>
    </form>
</div>

<hr>
<div class="row">
    <div class="container center">
        <div class="col-sm-10 registration-form center">
            <h4>View Assign Details</h4><hr>
            <form method="post">
                <div class="pull-left">
                    <select class="form-control" name="assignto">

                        <?php
                        include"mysql_connect.php";
                        $stmt = $conn->prepare("SELECT * FROM users ORDER BY userid DESC");
                        $stmt->execute();
                        $result = $stmt->fetchall();
                        foreach ($result as $row) {
                            echo'<option>'.$row['fullname'].'</option>';
                        }
                        ?>

                    </select>
                </div>
                <div class="pull-right" style="width: 50%">
                    <button type="submit"class="btn btn-success btn-large btn-block" name="search">Search</button>
                </div>
            </form>
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
                if(isset($_POST['search'])){
                    $assign_to=$_POST['assignto'];//echo$assign_to;
                    $stmt = $conn->prepare("SELECT * FROM tasks WHERE assign_to='$assign_to' ");
                }else{
                    $stmt = $conn->prepare("SELECT * FROM tasks WHERE assign_date LIKE '$year%' ORDER BY taskId DESC");
                }

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
                    <td>  <a href="" type="button" class="btn btn-danger btn-sm">Delete</a></td>
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
