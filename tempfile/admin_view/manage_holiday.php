<?php
 	 ob_start();

	
	include('mysql_connect.php');
	
	if(isset($_POST['accept'])){
		$value=$_POST['accept'];
		$sql = "UPDATE holiday SET status='1' WHERE holidayId=$value";

		$conn->exec($sql);
	}
	
	if(isset($_POST['decline'])){
		$value=$_POST['decline'];
		$sql = "UPDATE holiday SET status='2' WHERE holidayId=$value";

        $conn->exec($sql);
	}
?>

 <section class="title center">
    <div class="container">
      <div class="row-fluid">
        <div class="span6">
          <h2><?php echo"Greetings Admin"?></h2>
		  <?php date_default_timezone_set("Asia/Kolkata");
			echo "Today " . date("d/m/Y");
			?>
        </div>
      </div>
    </div>
  </section>



<div class="container">
    <br>
   <?php
		include('mysql_connect.php');
		date_default_timezone_set("Asia/Kolkata");
			//echo "The time is " . date("d/m/Y");
		$time=date("d.m.Y");
           if(isset($_POST['search'])){
               $fname=$_POST['assignto'];//echo$assign_to;
               $stmt = $conn->prepare("SELECT * FROM holiday WHERE fname='$fname' ");
               $stmt->execute();
               $result=$stmt->fetchAll();
           }else{
                   $stmt=$conn->prepare("SELECT * FROM holiday ORDER BY holidayId DESC LIMIT 10");
               $stmt->execute();
               $result=$stmt->fetchAll();
           }
		

?>

    <form method="post">
        <div class="pull-left">
            <select class="form-control" name="assignto">

                <?php
                include"mysql_connect.php";
                $sql = $conn->prepare("SELECT * FROM users ORDER BY userid DESC");
                $sql->execute();
                $res = $sql->fetchall();
                $myCounter=$stmt->rowCount();
                foreach ($res as $res) {
                    echo'<option>'.$res['fullname'].'</option>';
                }
                ?>

            </select>
        </div>
        <div class="pull-right" style="width: 50%">
            <button type="submit"class="btn btn-success btn-large btn-block" name="search">Search</button>
        </div>
    </form>

    <table class="table table-bordered" style="background:#fff;">
						<thead>
						  <tr>
							<th>SL</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Duration</th>
							<th>Reason</th>
							<th>Leave Type</th>
							<th>Status</th>
							<th>Accept</th>
							<th>Decline</th>
							
						  </tr>
						</thead>
						<?php
                            $i=0;
                            $sick_count=0;
                            $casual_count=0;
                            foreach($result as $row){
                                $i++;
							    echo' <tbody>
									  <tr>
										<td>';echo$i.'</td>
										<td>';echo$row['fname'].'</td>
										<td>';echo$row['email'].'</td>
										<td>';echo$row['days'].'</td>
										<td>';echo$row['reason'].'</td>
										<td>';echo$row['leave_type'].'</td>

										<td>'; 
											if($row['status']==1){
                                                if($row['leave_type']=="Sick"){
                                                    $sick_count=$sick_count+$row['days'];
                                                }else if($row['leave_type']=="Casual"){
                                                    $casual_count=$casual_count+$row['days'];
                                                }
                                                echo'  <button type="button" class="btn btn-success">Accepted</button>';
											}else if($row['status']==2){
                                                echo'  <button type="button" class="btn btn-danger">Declined</button>';
											}else{
                                                echo'  <button type="button" class="btn btn-warning">Pending</button>';
											}
										echo'</td>
										<form class="" action="" method="POST">
										<td><button value="'.$row['holidayId'].'" type="submit" class="btn btn-success btn-xs" name="accept">Accept</button></td>
										<td><button value="'.$row['holidayId'].'" type="submit" class="btn btn-danger btn-xs" name="decline">Decline</button></td>
										</form>
									  </tr>';


						}
?>
						</thead></table>
    <?php
    echo"Toatl Sick Leave".$sick_count."<br>Total Casual Leave: ".$casual_count;
    ?>
<?php
        if($myCounter<1){
            echo'<div class="alert alert-danger">
                          <strong><h5>Empty</h5></strong>
                        </div>';
        }
?>

						


</div>