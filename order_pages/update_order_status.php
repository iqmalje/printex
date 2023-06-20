<?php

    require_once("../config.php");  
    $status = $_POST['status'];
    $OrderID = $_POST['OrderID'];
    if($status=='accepted')
    {
        $sql = "UPDATE Orders SET status='PREPARING' WHERE OrderID=$OrderID";
    }
    else{
        $sql = "UPDATE Orders SET status='REJECTED' WHERE OrderID=$OrderID";
    }

    mysqli_query($conn, $sql);


    header("LOCATION: http://localhost/printex/order_pages/orderpage.php");
    
?>