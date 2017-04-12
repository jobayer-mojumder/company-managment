<?php
    require_once('../class/InsertRecord.php');
     $insertObj = new InsertRecord();

 	 $id = $_POST["id"];  
	 $text = $_POST["text"];  
     $data = $insertObj->editRequestValue($id, $text);
    if($data==1)
        echo "1";
    else
        echo "0";
?>