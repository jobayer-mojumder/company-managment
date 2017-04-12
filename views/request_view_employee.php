<?php
	require_once('class/FetchValues.php');
	$fetchObj = new FetchValues();
    $email=$_SESSION['email']; //echo$email;
	$result= $fetchObj->requestView($email);
?>

<!--/.span3-->
<div class="span9">
    <div class="content">

        <div class="module">
            <div class="module-head">
                <h3>All Users </h3>
            </div>
            <div class="module-body table">
                <table cellpadding="0" cellspacing="0" border="0"
                       class="datatable-1 table table-bordered table-striped	 display"
                       width="100%">
                    <thead>
                    <tr>
                        <th>
                            SL
                        </th>
                        <th>
                            Days
                        </th>
                        <th>
                            Reason
                        </th>
                        <th>
                            From Date
                        </th>
                        <th>
                            Leave type
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php 
                    $i=0;
                    foreach ($result as $user) { ?>

                        <tr class="gradeA">
                            <td>
                                <?php echo ++$i; ?>
                            </td>
                            <td>
                                <?php echo $user['days']; ?>
                            </td>
                            <td>
                                <?php echo $user['reason']; ?>
                            </td>
                            
                            <td class="center">
                                <?php echo $user['from_time']; ?>
                            </td>
                            
                            <td class="center">
                                <?php echo $user['leave_type']; ?>
                            </td>                            
							<td class="center">
                                <?php if( $user['status']== '0')
                                        echo "<button type='button' class='btn btn-primary btn-xs'>Pending</button>";
                                    else if($user['status']== '1')
                                        echo "<button type='button' class='btn btn-success btn-xs'>Approved</button>";
                                    else
                                        echo "<button type='button' class='btn btn-danger btn-xs'>Declined</button>";
                                ?>
                            </td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/.content-->
</div>

<!--/.span9-->

