<?php
	$email=$_SESSION['email']; //echo$email;
    include_once("class/FetchValues.php");
	$fetchObj = new FetchValues();
	$all_task = $fetchObj->getSingleTask($email);
	//print_r($all_task);
?>

<div class="span9">
    <div class="content">

        <div class="module">
            <div class="module-head">
                <h3>All Task </h3>
            </div>
            <div class="module-body table">
                <table cellpadding="0" cellspacing="0" border="0"
                       class="datatable-1 table table-bordered table-striped	 display"
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
                           Progress%
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

                        <tr class="gradeA" id = "<?php echo $user['task_id']; ?>">
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
										echo '<button type="button" class="btn btn-warning btn-xs">Medium</button>';
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
							<td class="progress">
                                <?php echo $user['progress']; ?>
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
</div>

<script>  
    var flag = 0;
     $(function(){      
                
          $(document).on('dblclick', '.progress', function(e){        
              flag++;  

              if (flag == 1)
              {
                e.stopPropagation();
                var currentEle = $(this);
                var id =  $(this).parent().attr('id');

                var value = $(this).text().trim(); 
                $(currentEle).html('<input class="thVal"  onfocus = "test(this)"  style="border:1px solid #ff0000; width:50px;" type="text" value = "' + value + '" />');

                $(".thVal").dblclick(function (e) {
                    e.stopPropagation();
                });         
                    
                $(".thVal").focus();
                
                $(".thVal").keyup(function (event) {
                    if (event.keyCode == 13) { 
                      var preValue = value;
                      value = $(".thVal").val().trim();
                      if (value>100){
                        alert("Insert progress value between 1-100");
                      }
                      else{
                        edit_data(id, value, preValue, currentEle);
                      }
                                   
                    }
                });
              }        
          });
    });

     function test(obj){
        obj.value = obj.value;
     } 

       function edit_data(id, text, preValue, currentEle)  
      {  
           //alert(id + "\n" + text + "\n" + preValue);
           $.ajax({  
                url:"views/edit.php",  
                method:"POST",  
                data:{id:id, text:text},  
                dataType:"text",  
                success:function(data){                  
                if (data == "1")
                  {
                    $(currentEle).html(text);
                  } 
                  else 
                  {
                    alert(data);
                    $(currentEle).html(preValue);
                  } 
                   flag = 0;   
                }  
           });  
      } 
     
 </script>