<?php
    include_once("class/InsertRecord.php");
     include_once("class/Config.php");
	  $insertObj = new InsertRecord();
      $config = new Config();

	$status=0;
	if(isset($_POST['user_add'])){
			$name=$_POST['fname'];
			$email=$_POST['email'];
			$pass=$_POST['pass']; echo$pass;
			$contact=$_POST['contact'];echo$contact;
			$designation=$_POST['designation'];//echo$website;
			$user_type="company_employee";
			$activate_status=1;
			$status=$insertObj->setUserInfo($name,$email,$pass,$contact,$designation,$user_type,$activate_status);

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
                    else if($status == 2) $config->getErrorMsg("Employee not Added!");
                    
                ?>

                <br />


                <form class="form-horizontal row-fluid" action="" method="post">
                    <div class="control-group">
                        <label class="control-label" for="fname">Employee Name</label>
                        <div class="controls">
                            <input type="text" id="fname" name="fname" placeholder="Full Name" class="span8" class="span8"required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                             <input type="email" id="email" name="email" placeholder="Email" class="span8" class="span8"required>
                        </div>
                    </div>
					<div class="control-group">
                        <label class="control-label" for="phone">Phone</label>
                        <div class="controls">
                            <input type="number" id="phone" name="contact" placeholder="Contact Number" class="span8">
          
                        </div>
                    </div>
					
					<div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                              <input type="password" id="post" name="pass" placeholder="Password" class="span8" class="span8"required>
                        </div>
                    </div>

                   

                    <div class="control-group">
                        <label class="control-label" for="Designation">Designation</label>
                        <div class="controls">
                            <select id="Designation" name="designation" tabindex="1" data-placeholder="Select here.." class="span8">
                                <option value="Content Writer">Content Writer</option>
								<option value="Content Manager">Content Manager</option>
								<option value="Server Admin">Server Admin</option>
								<option value="Project Manager">Project Manager</option>
								<option value="Graphics Designer">Graphics Designer</option>
								<option value="Programmer">Programmer</option>
								<option value="Game Developer">Game Developer</option>
								<option value="Co Ordinator">Co Ordinator</option>
								<option value="Accountant">Accountant</option>
								<option value="Supply Chain">Supply Chain</option>
								<option value="Other">Other</option>
                            </select>

                        </div>
                    </div>
                    

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" name="user_add" class="btn">Submit Form</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    </div><!--/.content-->
</div><!--/.span9-->
