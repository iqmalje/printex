<?php


    require_once('../config.php');

    $OrderID = $_POST['OrderID'];
    
    $sql = "UPDATE Orders SET status='COMPLETED' WHERE OrderID=$OrderID";

    mysqli_query($conn, $sql);

    header("LOCATION: http://localhost/printex/order_pages/orderpage_all.php");
?>