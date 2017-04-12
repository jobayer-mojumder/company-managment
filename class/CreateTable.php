<?php require_once('DBConfig.php');
class CreateTable
{
    //Create Users Table
    function createUsers()
    {
        $dbObj = new DBConfig();

        try {
            $dbObj->returnConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE IF NOT EXISTS $dbObj->user_table (
                        user_id INT AUTO_INCREMENT PRIMARY KEY,
                        fullname VARCHAR(255),
						email VARCHAR(100) UNIQUE,
						contact VARCHAR(50),
						password varchar(100),
						designation VARCHAR(100),
                        user_type VARCHAR(100),
                        activate_status INT,
                        regtime TIMESTAMP
                        )";
            $dbObj->returnConnection()->exec($sql);
            print("Created  user_table Table.\n");
        } catch (Exception $e) {
            echo "<br>User_table". $e->getMessage();
        }
    }

    //Create Task Table
    function createTaskTable()
    {
        try {
            $dbObj = new DBConfig();

            $dbObj->returnConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $table_create = "CREATE TABLE IF NOT EXISTS $dbObj->task_table(
                task_id INT AUTO_INCREMENT PRIMARY KEY,
				task_headline VARCHAR(255),
				task_details VARCHAR(255),
                email VARCHAR(100),
                priority INT(20),
                progress INT(20),
                finish_status INT(10),
                task_assign_time TIMESTAMP,
				task_deadline_time DATE)";

                $dbObj->returnConnection()->exec($table_create);
                 echo "institute_info Table created successfully";
             }
             catch(PDOException $e)
             {
                 echo  "<br> Institute_info " . $e->getMessage();
             }
	}
	
	//Create Task Table
    function createHolidayTable()
    {
        try {
            $dbObj = new DBConfig();

            $dbObj->returnConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $table_create = "CREATE TABLE IF NOT EXISTS $dbObj->holiday_table(
                holidayId INT AUTO_INCREMENT,
				email varchar(100),
				days INT,
				reason VARCHAR(255),
				from_time varchar(100),
				leave_type varchar(100),
				status INT,
                insert_time TIMESTAMP,
				PRIMARY KEY(holidayId))";

                $dbObj->returnConnection()->exec($table_create);
                 echo "Holiday Table created successfully";
             }
             catch(PDOException $e)
             {
                 echo  "<br> Holiday " . $e->getMessage();
             }
	}


	}
?>