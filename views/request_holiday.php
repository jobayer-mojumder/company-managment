<?php
    include_once("class/InsertRecord.php");
    include_once("class/Config.php");
	$insertObj = new InsertRecord();
	$config = new Config();
	//print_r($all_employee);
	$status=0;
	if(isset($_POST['request_holiday'])){
			$email=$_SESSION['email'];
			$status=0;
			$days=$_POST['days'];//echo$days;
			$reason=$_POST['reason'];//echo$reason;
			$from_time=$_POST['pickDate'];//echo$from_time;
			$leave=$_POST['leave'];//echo$leave;
			
			$status=$insertObj->holidayRequest($email,$status,$days,$reason,$from_time,$leave);

		}
?>

<div class="span9">
    <div class="content">

        <div class="module">
            <div class="module-head">
                <h3>Leave Request!</h3>
            </div>
            <div class="module-body">

                <?php
                    if($status==1)
                        $config->getSuccessMsg("Requested");
						else if($status == 2) $config->getErrorMsg("Institute not Added!");
						else if($status == 3) $config->getSuccessMsg("Institute User Created!");
                ?>

                <br />


                <form class="form-horizontal row-fluid" action="" method="post">
                    
					
                    <div class="control-group">
                        <label class="control-label" for="days">How many days</label>
                        <div class="controls">
                           <input type="number" id="days" name="days" placeholder="How many Days" class="span8" required>

                        </div>
                    </div>
					
					<div class="control-group">
                        <label class="control-label" for="From">From </label>
                        <div class="controls">
							<input  type="date" placeholder="From "  id="From" name="pickDate" class="span8" >
                        </div>
                    </div>
					
					
					<div class="control-group">
							<label class="control-label">Leave Type</label>
								<div class="controls">
									<label class="radio">
										<input type="radio" name="leave" id="optionsRadios1" value="Sick" checked="">
										Sick Leave
									</label> 
									<label class="radio">
										<input type="radio" name="leave" id="optionsRadios2" value="Casual">
										Casual Leave
							</label> 
												
						</div>
					</div>
					
                    <div class="control-group">
                        <label class="control-label" for="From">Reason </label>
                        <div class="controls">
							 <textarea  rows="5" id="comment" name="reason" class="span8"></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" name="request_holiday" class="btn">Submit Form</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    </div><!--/.content-->
</div><!--/.span9-->
