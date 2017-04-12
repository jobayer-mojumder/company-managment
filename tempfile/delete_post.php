<?php
ob_start();
include('mysql_connect.php');
//echo $_GET['id'];
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="DELETE FROM post_list WHERE postId=$id";
    if(mysqli_query($conn,$sql))
    {
        echo "Item deleted";
        header('location:my_post.php');

    }
    else{
        echo "Item did not deleted".mysqli_error($conn);
        header('location:user_panel.php');
    }

}

?>