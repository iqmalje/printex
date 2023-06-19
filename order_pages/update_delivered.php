<?php

    require_once('../config.php');

    $OrderID = $_POST['OrderID'];
    $deliveredTime = $_POST['deliveredTime'];

    $sql = "UPDATE Orders SET deliveredTime='$deliveredTime', status='DELIVERING' WHERE OrderID=$OrderID";

    mysqli_query($conn, $sql);

    echo "
        <form action='orderdetail.php' method='post'>
            <input type='hidden' name='OrderID' value = '$OrderID'>
            <input type='submit' id='submit' value='' style='display:none;'>
        </form>
        <script>document.getElementById('submit').click()</script>
        ";
?>
