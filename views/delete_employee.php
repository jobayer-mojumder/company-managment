<?php
    require_once('../class/InsertRecord.php');
     $insertObj = new InsertRecord();

 	 $id = $_POST["id"]; 
     $data = $insertObj->deleteEmployee($id);
    if($data==1)
        echo "1";
    else
        echo "0";
?>