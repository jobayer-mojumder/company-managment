<?php
include('inc/header.php');
   if(empty($_SESSION['email'])){
       header("Location:login.php");
   }

    if(isset($_GET['page'])){
        switch($_GET["page"]){
            case "add_employee":
                include 'views/add_employee.php';
                break;
            case "view_employee":
                include 'views/view_employee.php';
                break;            
				
			case "give_task":
                include 'views/give_task.php';
                break;
            
			case "view_task":
                include 'views/view_task.php';
                break;
			case "employee_view_task":
                include 'views/employee_view_task.php';
                break;
			case "request_holiday":
                include 'views/request_holiday.php';
                break;
            case "request_view":
                include 'views/request_view_employee.php';
                break;
            case "holiday_request_view":
                include 'views/request_view.php';
                break;
            case "logout":
                include 'views/logout.php';
                break;
            default:
                include 'views/home_content.php';
                break;
        }
    }else
        include 'views/home_content.php';


	include('inc/footer.php');
?>
