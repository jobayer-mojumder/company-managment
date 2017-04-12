<?php
    include_once("class/InsertRecord.php");
    include_once("class/FetchValues.php");
	  $insertObj = new InsertRecord();
	  $fetchObj = new FetchValues();
	$all_employee = $fetchObj->getAllemployee();
	//print_r($all_employee);
	$status=0;
	if(isset($_POST['save_task'])){
			$email=$_POST['employee_name'];
			$task_details=$_POST['task_details'];
			$task_headline=$_POST['task_headline'];
			$deadline=$_POST['date'];
			$priority=$_POST['optionsRadios'];
			$finish_status=0;
			$progress=0;
			//echo"email".$email.$date.$priority;
			//$activate_status=1;
			$insertObj->giveTask($email,$deadline,$priority,$task_headline,$task_details);

		}
?>

<div class="span9">
    <div class="content">

        <div class="module">
            <div class="module-head">
                <h3>Add Employee!</h3>
            </div>
            <div class="module-body">

                <?php
                    if($status==1)
                        $config->getSuccessMsg("Employee Added! Successfully");
						else if($status == 2) $config->getErrorMsg("Institute not Added!");
						else if($status == 3) $config->getSuccessMsg("Institute User Created!");
                ?>

                <br />


                <form class="form-horizontal row-fluid" action="" method="post">
                    
					
                    <div class="control-group">
                        <label class="control-label" for="employee_name">Select Employee</label>
                        <div class="controls">
                            <select id="employee_name" name="employee_name" tabindex="1" data-placeholder="Select here.." class="span8">
                                 <?php foreach ($all_employee as $user) {?>
								 <option value="<?php echo $user['email']; ?>"><?php echo $user['fullname']; ?></option>
								 <?php }?>
                            </select>

                        </div>
                    </div>
					
					<div class="control-group">
                        <label class="control-label" for="task_headline">Task Headline</label>
                        <div class="controls">
							<input type="text" id="task_headline" name="task_headline" placeholder="Task Headline" class="span8" class="span8"required>
                        </div>
                    </div>
					
					<div class="control-group">
                        <label class="control-label" for="task_headline">Task Details</label>
                        <div class="controls">
							<textarea id="task_details" rows="4" cols="50" name="task_details" class="span8" class="span8"required placeholder="Task Details" ></textarea>
						</div>
                    </div>
					
					<div class="control-group">
                        <label class="control-label" for="date">Deadline</label>
                        <div class="controls">
                            <input type="date" id="date" name="date" placeholder="Dead Line" class="span8" class="span8"required>
                        </div>
                    </div>
					
					<div class="control-group">
											<label class="control-label">Radiobuttons</label>
											<div class="controls">
												<label class="radio">
													<input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked="">
													High Priority
												</label> 
												<label class="radio">
													<input type="radio" name="optionsRadios" id="optionsRadios2" value="2">
													Medium Priority
												</label> 
												<label class="radio">
													<input type="radio" name="optionsRadios" id="optionsRadios3" value="3">
													Low Priority
												</label>
											</div>
					</div>
                    

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" name="save_task" class="btn">Submit Form</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    </div><!--/.content-->
</div><!--/.span9-->
