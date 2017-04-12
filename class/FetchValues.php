<?php 
require_once('DBConfig.php');

class FetchValues{


    public function checkLogin($email,$password){
        $dbObj = new DBConfig();
        try
        {
            $stmt = $dbObj->returnConnection()->prepare("SELECT * FROM user_table WHERE email='$email' AND password='$password' LIMIT 1");
            $stmt->execute(array(':email'=>$email, ':password'=>$password));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0)
            {
                session_start();
                $_SESSION['full_name'] = $userRow['full_name'];
                $_SESSION['email'] = $userRow['email'];
                $_SESSION['designation'] = $userRow['designation'];
                $_SESSION['user_type'] = $userRow['user_type'];
                $_SESSION['user_id'] = $userRow['user_id'];
				echo'Ok';
                return 1;

            }else {
				echo'Problem';
                return 2;
            }
            $conn=null;
        } catch (Exception $e) {
            return 3;
            //return "<br>Error: ". $e->getMessage();
        }
    }

   



    public function getAllemployee(){
        $dbObj = new DBConfig();
        try
        {
            $statement = $dbObj->returnConnection()->prepare("SELECT * FROM ".$dbObj->user_table."
            ");
            $statement->execute();
            #$rowNo=$stmt->rowCount();
            $result = $statement->fetchall();
            return $result;
        } catch (Exception $e) {
            return 0;
            //return "<br>Error: ". $e->getMessage();
        }
    }
	
	public function getAlltask(){
        $dbObj = new DBConfig();
        try
        {
            $statement = $dbObj->returnConnection()->prepare("SELECT * FROM ".$dbObj->task_table."
            ORDER BY task_id DESC");
            $statement->execute();
            #$rowNo=$stmt->rowCount();
            $result = $statement->fetchall();
            return $result;
        } catch (Exception $e) {
            return 0;
            //return "<br>Error: ". $e->getMessage();
        }
    }
	public function getSingleTask($email){
        $dbObj = new DBConfig();
        try
        {
            $statement = $dbObj->returnConnection()->prepare("SELECT * FROM ".$dbObj->task_table." WHERE email='$email'  ORDER BY task_id DESC");
            $statement->execute();
            $result = $statement->fetchall();
            return $result;
        } catch (Exception $e) {
            return 0;
            //return "<br>Error: ". $e->getMessage();
        }
    }

    public function requestView($email){
        $dbObj = new DBConfig();
        try
        {
            $statement = $dbObj->returnConnection()->prepare("SELECT * FROM ".$dbObj->holiday_table." WHERE email='$email'  ORDER BY holidayId DESC");
            $statement->execute();
            $result = $statement->fetchall();
            return $result;
        } catch (Exception $e) {
            return 0;
            //return "<br>Error: ". $e->getMessage();
        }
    }

    public function allRequestView(){
        $dbObj = new DBConfig();
        try
        {
            $statement = $dbObj->returnConnection()->prepare("SELECT * FROM ".$dbObj->holiday_table."  ORDER BY holidayId DESC");
            $statement->execute();
            $result = $statement->fetchall();
            return $result;
        } catch (Exception $e) {
            return 0;
            //return "<br>Error: ". $e->getMessage();
        }
    }

    public function singleUser($email){
        $dbObj = new DBConfig();
        try
        {
            $statement = $dbObj->returnConnection()->prepare("SELECT fullname FROM ".$dbObj->user_table." WHERE email='$email' limit 1");
            $statement->execute();
            $result = $statement->fetchall();
            return $result;
        } catch (Exception $e) {
            return 0;
            //return "<br>Error: ". $e->getMessage();
        }
    }

    public function sickLeave($email){
        $dbObj = new DBConfig();
        $year=date("Y");
        try
        {
            $statement = $dbObj->returnConnection()->prepare("SELECT days FROM ".$dbObj->holiday_table." WHERE email='$email' AND leave_type= 'Sick' AND status = 1 AND insert_time LIKE '$year%'");
            $statement->execute();
            $result = $statement->fetchall();
            return $result;
        } catch (Exception $e) {
            return 0;
            //return "<br>Error: ". $e->getMessage();
        }
    }

    public function casualLeave($email){
        $dbObj = new DBConfig();
        $year=date("Y");
        try
        {
            $statement = $dbObj->returnConnection()->prepare("SELECT days FROM ".$dbObj->holiday_table." WHERE email='$email' AND leave_type= 'Casual' AND status = 1 AND insert_time LIKE '$year%'");
            $statement->execute();
            $result = $statement->fetchall();
            return $result;
        } catch (Exception $e) {
            return 0;
            //return "<br>Error: ". $e->getMessage();
        }
    }


}