<?php
    include_once("class/FetchValues.php");
	$fetchObj = new FetchValues();
	$all_task = $fetchObj->getAlltask();
?>

<div class="span9">
    <div class="content">

        <div class="module">
            <div class="module-head">
                <h3>All Users </h3>
            </div>
            <div class="module-body table">
                <table cellpadding="0" cellspacing="0" border="0"
                       class="datatable-1 table table-bordered table-striped	display"
                       width="100%">
                    <thead>
                    <tr>
						<th>
                            SL.
                        </th>
                        <th>
                            Task Title
                        </th>
                        <th>
                            Task details
                        </th>
                        <th>
                            Assigned Person
                        </th>
                        <th>
                            Priority
                        </th>
                        <th>
                            Assign Date
                        </th>
						
                        <th>
                            Deadline
                        </th>
						<th>
                           Progress
                        </th>
						<th>
                            Finish
                        </th>
                    </tr>
                    </thead>
                    <tbody>
						
                    <?php 
					$i=0;
					foreach ($all_task as $user) {
						$i++;
					?>

                        <tr class="gradeA">
                            <td>
                                <?php echo $i; ?>
                            </td>
							
							<td>
                                <?php echo $user['task_headline']; ?>
                            </td>
                            <td>
                                <?php echo $user['task_details']; ?>
                            </td>
                            
                            <td class="center">
                                <?php echo $user['email']; ?>
                            </td>
                            
                            <td class="center">
                                <?php if ($user['priority']==1)
										echo '<button type="button" class="btn btn-danger btn-xs">High</button>';
									elseif ($user['priority']==2)
										echo '<button type="button" class="btn btn-info btn-xs">Med</button>';
									else
										echo '<button type="button" class="btn btn-primary btn-xs">Low</button>';
								?>
                            </td>                            
							<td class="center">
                                <?php echo $user['task_assign_time']; ?>
                            </td>
                            <td class="center">
                                <?php echo $user['task_deadline_time']; ?>
                            </td>
							<td class="center">
                                <?php echo $user['progress']."%"; ?>
                            </td>
							<td class="center">
                                <?php if ($user['finish_status']==0)
										echo '<button type="button" class="btn btn-danger btn-xs">No</button>';
								
									else
										echo '<button type="button" class="btn btn-primary btn-xs">Yes</button>';
								
								?>
                            </td>
                        </tr>

                    <?php } ?> </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/.content-->
</div>