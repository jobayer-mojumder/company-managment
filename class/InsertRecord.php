<?php
require_once('DBConfig.php');
    class InsertRecord{

        
        // recording user information
        public function setUserInfo($name,$email,$pass,$contact,$designation,$user_type,$activate_status)
        {
            $dbObject = new DBConfig();
            try {
                $stmt = $dbObject->returnConnection()->prepare("INSERT INTO $dbObject->user_table (
                fullname, email, contact, password, designation, user_type, activate_status)
                VALUES (:fullname, :email, :contact, :password, :designation, :user_type, :activate_status)");
                $stmt->bindParam(':fullname', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':contact', $contact);
                $stmt->bindParam(':password', $pass);
                $stmt->bindParam(':designation', $designation);
                $stmt->bindParam(':user_type', $user_type);
                $stmt->bindParam(':activate_status', $activate_status);
                $stmt->execute();
                return 1;
            } catch (Exception $e) {
                echo $e->getMessage();
                return 2;

            }
        }
		
		// Give task information
        public function giveTask($email,$deadline,$priority,$task_headline,$task_details)
        {
            $dbObject = new DBConfig();
			$finish_status=0;
			$progress=0;
            try {
                $stmt = $dbObject->returnConnection()->prepare("INSERT INTO $dbObject->task_table (
                task_headline, task_details, email, priority, progress, finish_status, task_deadline_time)
                VALUES (:task_headline, :task_details, :email, :priority, :progress, :finish_status, :task_deadline)");
                $stmt->bindParam(':task_headline', $task_headline);
				$stmt->bindParam(':task_details', $task_details);
				$stmt->bindParam(':email', $email);
                $stmt->bindParam(':priority', $priority);
                $stmt->bindParam(':progress', $progress);
                $stmt->bindParam(':finish_status',$finish_status );
                $stmt->bindParam(':task_deadline', $deadline);
                $stmt->execute();
                return 1;
            } catch (Exception $e) {
                echo $e->getMessage();
                return 2;

            }
        }
		
		
		//Holiday Request
        public function holidayRequest($email,$status,$days,$reason,$from_time,$leave)
        {
            $dbObject = new DBConfig();
			$finish_status=0;
			$progress=0;
            try {
                $stmt = $dbObject->returnConnection()->prepare("INSERT INTO $dbObject->holiday_table (
                email, days, reason, from_time, leave_type, status)
                VALUES (:email, :days, :reason, :from_time, :leave_type, :status)");
				$stmt->bindParam(':email', $email);
                $stmt->bindParam(':days', $days);
                $stmt->bindParam(':reason', $reason);
                $stmt->bindParam(':from_time',$from_time );
                $stmt->bindParam(':leave_type', $leave);
                $stmt->bindParam(':status', $status);
                $stmt->execute();
                return 1;
            } catch (Exception $e) {
                echo $e->getMessage();
                return 2;

            }
        }
		public function editProgress($id, $text)
        {
            $dbObject = new DBConfig();
            try {
                $stmt = $dbObject->returnConnection()->prepare("UPDATE $dbObject->task_table set progress = :text WHERE task_id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':text', $text);
                $stmt->execute();
                return 1;
            } catch (Exception $e) {
                echo $e->getMessage();
                return 2;
            }
        }

        public function taskComplete($id)
        {
            $dbObject = new DBConfig();
            try {
                $stmt = $dbObject->returnConnection()->prepare("UPDATE $dbObject->task_table set finish_status = 1 WHERE task_id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return 1;
            } catch (Exception $e) {
                echo $e->getMessage();
                return 2;
            }
        }
        public function editRequestValue($id, $text)
        {
            $dbObject = new DBConfig();
            try {
                $stmt = $dbObject->returnConnection()->prepare("UPDATE $dbObject->holiday_table set status = '$text' WHERE holidayId = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return 1;
            } catch (Exception $e) {
                echo $e->getMessage();
                return 2;
            }
        }

        public function deleteEmployee($id)
        {
            $dbObject = new DBConfig();
            try {
                $stmt = $dbObject->returnConnection()->prepare("DELETE FROm $dbObject->user_table WHERE user_id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return 1;
            } catch (Exception $e) {
                echo $e->getMessage();
                return 2;
            }
        }

    }
?>
