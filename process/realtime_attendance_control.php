<?php
require_once('../class/DBConfig.php');
require_once('../class/FetchValues.php');
$fetchObj=new FetchValues();
$dbObject = new DBConfig();

# this file make a connection between fingerprint device
# this file received sended data then filter, proceess,logical check
# after that finaly it send message and store data in server database
# ?fingerprint_id=1&time='12sunday'&check_type='I'


if (isset($_GET['fingerprint_id']) && isset($_GET['time']) && isset($_GET['check_type'])) {

    $check_in_sms=0;
    $check_out_sms=0;
    $check_in_error=0;
    $check_out_error=0;

    $mytable = $dbObject->student_attendance_table;    #HardCoded Student Database name

    /*$fingerprint_id = 1	;								#echo $fingerprint_id;
    $time = 	"Thuesday-22-Sep-2016 11:23:08";	    #echo $time;
    $check_type = 'I';									#echo $check_type;
    $temp = strtok($time, ' '); 						#echo$temp;
    */

    $fingerprint_id = $_GET['fingerprint_id'];
    $time = $_GET['time'];
    $check_type = $_GET['check_type'];
    $tempArr= explode(" ", $time);
    $temp=$tempArr[0];
    $attendingTime=$tempArr[1];//echo$attendingTime;

    //Get Student Info
    $statement=$fetchObj->singleStudentInfo($fingerprint_id);
    $result = $statement->fetchall();
    $resultCounter=$statement->rowCount();//echo$resultCounter;
    if($resultCounter<=0){
        exit;
    }
    foreach($result as $res){
        $std_id=$res['std_id'];
        $full_name=$res['full_name'];
        $local_guardian=$res['local_guardian'];
        $local_phone=$res['local_phone'];
        $student_status=$res['student_status'];
        $school_id=$res['school_id'];
    }

    //Check Student active or not
    if($student_status!=1){
        $check_in_sms=1;
        errCount($temp,$school_id,$check_in_sms,$check_out_sms,$check_in_error,$check_out_error);
        exit;
    }

    if ($check_type == 'I') {
        try {
            // Setting the query and running it...
            $isRepeat = "SELECT * FROM $mytable WHERE fingerprintId = '$fingerprint_id' AND type='$check_type' AND time ='$temp'";
            $result = $dbObject->returnConnection()->query($isRepeat);
            $result->execute();
            $row_count = $result->rowCount();
            if ($row_count > 0) {
                $check_in_error=1;
                echo 'Check in Exist';
            } else {
                echo 'Not Exist Insert and delete MS Access';
                $insert = "INSERT INTO $mytable (std_id,fingerprintId, type,school_id, time) VALUES ('$std_id','$fingerprint_id', '$check_type','$school_id', '$temp')";
                $dbObject->returnConnection()->exec($insert);
                $check_in_sms=1;
                smsSent($temp,$attendingTime,$full_name,$local_guardian,$local_phone, $check_type,$school_id);
            }
        } catch (Exception $e) {
            $check_in_error=1;
            echo $e->getMessage();
        }
    } else {
        $isValueIn = "SELECT * FROM $mytable WHERE fingerprintId = '$fingerprint_id' AND type='I' AND time LIKE '%$temp%'";
        $result = $dbObject->returnConnection()->query($isValueIn);
        $result->execute();
        $row_count = $result->rowCount();
        if ($row_count > 0) {
            $isRepeat = "SELECT * FROM $mytable WHERE fingerprintId = '$fingerprint_id' AND type='O' AND time LIKE '%$temp%'";
            $result = $dbObject->returnConnection()->query($isRepeat);
            $result->execute();
            $row_count = $result->rowCount();
            if ($row_count > 0) {
                $check_out_error=1;
                echo 'Check Out Exist\n';
            } else {
                echo 'Check Out Insert\n';
                $insert = "INSERT INTO $mytable (std_id,fingerprintId, type,school_id, time) VALUES ('$std_id','$fingerprint_id', '$check_type','$school_id', '$temp')";
                $dbObject->returnConnection()->exec($insert);
                $check_out_sms=1;
                smsSent($temp,$attendingTime,$full_name,$local_guardian,$local_phone, $check_type,$school_id);
            }
        } else {
            $check_out_error=1;
            #echo'He is not cheked in yet.';
            echo 'You must checked in before Checked Out';
        }

    }
    errCount($temp,$school_id,$check_in_sms,$check_out_sms,$check_in_error,$check_out_error);
}



function smsSent($date,$attendingTime,$full_name,$local_guardian,$local_phone, $check_type,$school_id)
{

    if(empty($local_guardian)){
        $local_guardian="Guardian";
    }
    //echo$attendingTime;
    //Sms sent code here
    echo$attendingTime."<br>".$full_name."<br>".$local_guardian."<br>".$local_phone."<br>".$check_type;
    if ($check_type == 'I') {
        echo"Dear " . $local_guardian . "<br>\nToday " . $date. "<br>\n" . $full_name . " came to the school<br>\n at " . $attendingTime;

    }

    else {
        echo"Dear " . $local_guardian . "<br>\nToday " . $date. "<br>\n" . $full_name . " just out from school<br>\n at " . $attendingTime;
    }


}

function  errCount($date,$school_id,$check_in_sms,$check_out_sms,$check_in_error,$check_out_error){
    $dbObject = new DBConfig();
    $school_id=$school_id;
    $last_update_time=$date;
    // Setting the query and running it...
    $isRepeat = "SELECT * FROM $dbObject->sms_status_table WHERE last_update_time='$date'";
    $result = $dbObject->returnConnection()->query($isRepeat);
    $result->execute();
    $row_count = $result->rowCount();
    if ($row_count > 0) {
        //Update
        $insert = "UPDATE $dbObject->sms_status_table SET
        check_in_sms=check_in_sms+'$check_in_sms',
        check_out_sms=check_out_sms+'$check_out_sms',
        check_in_error=check_in_error+'$check_in_error',
        check_out_error=check_out_error+'$check_out_error',
        school_id='$school_id',
        last_update_time='$last_update_time' WHERE last_update_time='$last_update_time'";
        $dbObject->returnConnection()->exec($insert);
        echo'Update';
    } else {
        echo 'Insert';
        $insert = "INSERT INTO $dbObject->sms_status_table (check_in_sms,check_out_sms, check_in_error,check_out_error, school_id,last_update_time)
             VALUES ('$check_in_sms','$check_out_sms', '$check_in_error','$check_out_error', '$school_id','$last_update_time')";
        $dbObject->returnConnection()->exec($insert);
    }
}











