
<section id="" class="container">

 <div class="row-fluid">
	<form class="" action='' method="POST">
		<div class="span6">
          <!-- E-mail -->
			<?php
				include('website_list.php');
			?>
        </div>
		<div class="span6" style="float:right">
			<select class="form-control" name="date">
				<?php date_default_timezone_set("Asia/Kolkata");
					$datec=date("d");
					$range=$datec-7;
					for($i=$datec;$i>=$range;$i--){
						if($i<=0){
							break;
						}
						if($i==$datec){
							echo '<option value="'.$i.'.'.date("m.Y").'">Today</option>';
						}if($i<9 && $i!=$datec){
							$i='0'.$i;
							echo '<option value="'.$i.'.'.date("m.Y").'">'.$i.'/'.date("m/Y").'</option>';
						}if($i<31 && $i!=$datec){
							
							echo '<option value="'.$i.'.'.date("m.Y").'">'.$i.'/'.date("m/Y").'</option>';
						}
						
				
					}
				?>
				
				</select>
        </div>
		 <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button type="submit"class="btn btn-success btn-large btn-block" name="submit">Submit</button>
          </div>
        </div>
		</form>
	</div>
</section>


<div class="container">
   <?php
		include('mysql_connect.php');
		date_default_timezone_set("Asia/Kolkata");
			//echo "The time is " . date("d/m/Y");
		$time=date("d.m.Y");
		
		if(isset($_POST['submit'])){
			$website=$_POST['website'];
			$time=$_POST['date'];echo$time;
			//if($website=="All"){
            $stmt = $conn->prepare("SELECT * FROM post_list WHERE website='$website' AND time='$time' ORDER BY website");
				//echo'Hi';
			/*}else{
				$query="SELECT * FROM post_list WHERE website='$website' AND time='$time' ORDER BY postId DESC";
			}*/
		}else{
            $stmt = $conn->prepare("SELECT * FROM post_list ORDER BY website");
		}
					$res=$stmt->fetchAll();
   $myCount=$stmt->rowCount();
					$i=1;
					echo'<h4>Result shows for: '.$website.' Date: '.$time.'</h4>';
					if($myCount> 0){
						echo'<table class="table table-bordered" style="background:#fff;">
						<thead>
						  <tr>
							<th>SL</th>
							<th>Full Name</th>
							<th>Time</th>
							<th>Post</th>
							<th>Website</th>
							
						  </tr>
						</thead>';
						foreach($res as $result){
							echo' <tbody>
									  <tr>
										<td>';echo$i.'</td>
										<td>';echo$row['fullname'].'</td>
										<td>';echo$row['time'].'</td>
										<td><a href="';echo$row['postLink'].'" target="_BLANK">';echo$row['postHeader'].'</a></td>
										<td>';echo$row['website'].'</td>
										
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