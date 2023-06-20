<?php

    require_once('../config.php');

    $OrderID = $_POST['OrderID'];

    $sql = "UPDATE Orders SET status='CANCELLED' WHERE OrderID=$OrderID";
    mysqli_query($conn, $sql);

    header("LOCATION: http://localhost/printex/customer-tracking/customer-tracking.php");
?>