<?php
ob_start();
include('mysql_connect.php');
//echo $_GET['id'];
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="DELETE FROM users WHERE userid=$id";
    if(mysqli_query($conn,$sql))
    {
        echo "Item deleted";
        header('location:all_employee.php');

    }
    else{
        echo "Item did not deleted".mysqli_error($conn);
        header('location:admin_home.php');
    }

}

?>