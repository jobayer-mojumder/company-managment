<?php
	require_once('class/FetchValues.php');
	$fetchObj = new FetchValues();

	$result= $fetchObj->getAllemployee();
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
                            Full Name
                        </th>
                        <th>
                            Designation
                        </th>
                        <th>
                            contact
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Password
                        </th>
                        <th>
                            Active
                        </th>
                        <th>
                            Del
                        </th>
                        <th>
                            Edit
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($result as $user) { ?>
                        <?php if ($user['user_type']=='super_admin')
                                    continue;
                            else { ?>
                        
                        <tr class="gradeA">
                            <td>
                                <?php echo $user['fullname']; ?>
                            </td>
                            <td>
                                <?php echo $user['designation']; ?>
                            </td>
                            
                            <td class="center">
                                <?php echo $user['contact']; ?>
                            </td>
                            
                            <td class="center">
                                <?php echo $user['email']; ?>
                            </td>                            
							<td class="center">
                                <?php echo $user['password']; ?>
                            </td>
                            <td class="center">
                                <?php if($user['activate_status']==1){
									echo' <button type="button" class="btn btn-primary btn-xs">Active</button>';
								}else{
									 echo'<button type="button" class="btn btn-warning btn-xs">Inactive</button>';
								} ?>
                            </td>
                            <td class="center" id = "<?php echo $user['user_id']; ?>">
                              <button type="button" class="btn btn-danger btn-xs">Delete</button>
								
                            </td>
                            <td class="center">
                               <button type="button" class="btn btn-primary btn-xs">Edit</button>
								
                            </td>
                        </tr>

                    <?php } }?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/.content-->
</div>

<!--/.span9-->

<script>  
     $(function(){
        $( ".btn-danger" ).click(function() {
            var id =  $(this).parent().attr('id');
            //alert( id );
            delete_data(id);
        });      
    });

    function delete_data(id, text)  
      {  
           //alert(id + "\n" + text + "\n" + preValue);
           $.ajax({  
                url:"views/delete_employee.php",  
                method:"POST",  
                data:{id:id},  
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