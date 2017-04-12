<?php
    require_once('../class/InsertRecord.php');
     $insertObj = new InsertRecord();

 	 $id = $_POST["id"];  
	 $text = $_POST["text"];  
     if ($text == '100'){
         $value = $insertObj->taskComplete($id);
     }
     $data = $insertObj->editProgress($id, $text);
    if($data==1)
        echo "1";
    else
        echo "0";
?>
