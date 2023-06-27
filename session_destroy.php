<?php
    session_start();
    session_destroy();



    setcookie("UserID", "", 1, '/');
    unset($_COOKIE['UserID']);
    echo "DAH UNSET";
    header("LOCATION: http://localhost/printex/login_pages/login.php");
?>