<?php

    require_once('../config.php');
    $OrderID = $_POST['OrderID'];

    if(isset($_POST['updateTime']))
    {
        $deliveredTime = $_POST['deliveredTime'];
        $sql = "UPDATE Orders SET deliveredTime='$deliveredTime', status='DELIVERING' WHERE OrderID=$OrderID";
        mysqli_query($conn, $sql);
    }
    else if (isset($_POST['cancelOrder']))
    {
        $sql = "UPDATE Orders SET status='CANCELLED' WHERE OrderID=$OrderID";
        mysqli_query($conn, $sql);
    }
    else if (isset($_POST['completeOrder']))
    {
        $sql = "UPDATE Orders SET status='COMPLETED' WHERE OrderID=$OrderID";
        mysqli_query($conn, $sql);
    }

    //redirects back to orderdetail.php
    echo "
        <form action='orderdetail.php' method='POST'>
            <input type='hidden' name='OrderID' value='$OrderID' />
            <input id='submit' type='submit' style='display: none;' />
            </form>
        <script>document.getElementById('submit').click()</script>
    "    
?>