
  <section class="title center">
    <div class="container">
      <div class="row-fluid">
        <div class="span6">
          <h1>All Employee</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- / .title -->  
<section class="container">  
<?php
	include"mysql_connect.php";
			$stmt = $conn->prepare("SELECT * FROM users ORDER BY userid DESC");
			$stmt->execute();
			$result = $stmt->fetchall();
					$i=1;
					$count=$stmt->rowCount();
					if($count > 0){
						echo'<table class="table table-bordered">
						<thead>
						  <tr>
							<th>SL</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Contact</th>
							<th>Password</th>
							<th>Designation</th>
							<th>Action</th>
							
						  </tr>
						</thead>';
						foreach ($result as $row) {
							echo' <tbody>
									  <tr>
										<td>';echo$i.'</td>
										<td>';echo$row['fullname'].'</td>
										<td>';echo$row['email'].'</td>
										<td>';echo$row['contact'].'</td>
										<td>';echo$row['password'].'</td>
										
										<td>';echo$row['designation'].'</td>';
                                        echo '<td><a href="delete_employee.php?id=' . $row['userid'] . '">Delete</a></td>';
										
									  echo'</tr>';
						$i++;
						}
						echo'</thead></table>';
					}else
						echo'<div class="alert alert-danger">
  <strong>Empty</strong> 
</div>';
						
						?>
  </section>