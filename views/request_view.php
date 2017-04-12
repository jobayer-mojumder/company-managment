<?php
	require_once('class/FetchValues.php');
	$fetchObj = new FetchValues();
	$result= $fetchObj->allRequestView();
    $initialSickLeave = 14;
    $initialCasualLeave = 15;
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
                       class="datatable-1 table table-bordered table-striped display"
                       width="100%">
                    <thead>
                    <tr id=>
                        <th>
                            SL
                        </th>
                        <th>
                            Person
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
                            Leave remain(Sick)
                        </th>
                        <th>
                            Leave remain(Casual)
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php 
                    $i=0;
                    foreach ($result as $user) { ?>

                        <tr class="gradeA" >
                            <td>
                                <?php echo ++$i; ?>
                            </td>
                            <td>
                                <?php $value = $fetchObj->singleUser($user['email']);
                                    foreach ($value as $view) {
                                        echo $view['fullname'];
                                    }?>
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

                            <td>
                                <?php $value = $fetchObj->sickLeave($user['email']);
                                    $day=0;
                                    foreach ($value as $view) {
                                        $day=$day+$view['days'];
                                    }
                                    echo $initialSickLeave-$day;
                                    ?>
                            </td>
                            <td>
                                <?php $val = $fetchObj->casualLeave($user['email']);
                                    $day=0;
                                    foreach($val as $view){
                                        $day=$day+$view['days'];
                                    }
                                    echo $initialCasualLeave-$day;
                                    ?>
                            </td>

                            <td class="center">
                                <?php if( $user['status']== '0')
                                        echo "Pending";
                                    else if($user['status']== '1')
                                        echo "Approved";
                                    else
                                        echo "Declined";
                                ?>
                            </td>                          
							<td class="center" id = "<?php echo $user['holidayId']; ?>">
                                <?php if( $user['status']== '0'){
                                        echo "<button type='button' class='btn btn-success btn-xs'>Approved</button>  ";
                                        echo "<button type='button' class='btn btn-danger btn-xs'>Declined</button>";
                                    }
                                    else if($user['status']== '1'){
                                        echo "<button type='button' class='btn btn-danger btn-xs'>Declined</button>  ";
                                    }
                                    else
                                        echo "<button id='success' type='button' class='btn btn-success btn-xs'>Approved</button>";
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

<script>  
     $(function(){
        $( ".btn-success" ).click(function() {
            var text='1';
            var id =  $(this).parent().attr('id');
            //alert( id );
            edit_data(id, text);
        });
        $( ".btn-danger" ).click(function() {
            var text='2';
            var id =  $(this).parent().attr('id');
            //alert( id );
            edit_data(id, text);
        });      
    });

    function edit_data(id, text)  
      {  
           //alert(id + "\n" + text + "\n" + preValue);
           $.ajax({  
                url:"views/edit_request.php",  
                method:"POST",  
                data:{id:id, text:text},  
                dataType:"text",  
                success:function(data){                  
                if (data == "1")
                  {
                    location.reload();
                  }
                else{
                    alert("An error Occoured");
                    }
                }  
           });  
      }
</script>