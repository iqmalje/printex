<?php
    session_start();
    session_destroy();

    header("LOCATION: http://localhost/printex/login_pages/login.php");
?>