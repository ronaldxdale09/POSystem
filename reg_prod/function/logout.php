<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirecting To Home Page
        unset($_SESSION['id']);

        header("Location: ../../index.php");
        $_SESSION['Logoutsuccessful']= "Logoutsuccessful";
    }
?>