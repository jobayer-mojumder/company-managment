<?PHP
    ob_start();
    session_unset();

// destroy the session
    session_destroy();
    header('Location: login.php');

?>