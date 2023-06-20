<?php


    /*
    name="selectedfile"
    name="color"
    name="side"
    name="pagepersheet"
    name="layout"
    name="copies"
    name="size"
    name="SPID"
    */

    require_once('../config.php');

    session_start();
    $UserID = $_SESSION['UserID'];
    $color = $_POST['color'];
    $side = $_POST['side'];
    $pagepersheet = $_POST['pagepersheet'];
    $layout = $_POST['layout'];
    $copies = $_POST['copies'];
    $paperSize = $_POST['size'];
    $SPID = $_POST['SPID'];
    $remark = $_POST['remark'];
    $price = $_POST['price'];
    $totalpage = $_POST['totalPage'];
    $deliveryDate = $_POST['deliveryDate'];
    $deliveryTime = $_POST['deliveryTime'];
    $typeOfDelivery = $_POST['typeOfDelivery'];

    
    $filename = $_FILES['selectedfile']['name'];
    $temp = $_FILES['selectedfile']['tmp_name'];
    $destination_path = dirname(dirname(__FILE__));
    $target_path = $destination_path . "/files/$filename";
    move_uploaded_file($temp, $target_path);


    //create order sql
    $sql = "INSERT INTO Orders(UserID, SPID, color, side, pagepersheet, layout, copies, paperSize, customerRemark, price, status, deliveryDate, deliveryTime, typeOfDelivery) 
            VALUES($UserID, $SPID, '$color', '$side', '$pagepersheet', '$layout', $copies, '$paperSize', '$remark', $price, 'PENDING', '$deliveryDate', '$deliveryTime', '$typeOfDelivery')";
    
    mysqli_query($conn, $sql);

    $OrderID = mysqli_insert_id($conn);

    $sql = "INSERT INTO files(OrderID, filename, filepath, totalPage) VALUES ($OrderID, '$filename', 'files/$filename', $totalpage)";
    
    mysqli_query($conn, $sql);

    $FileID = mysqli_insert_id($conn);

    $sql = "UPDATE Orders SET FileID=$FileID WHERE OrderID=$OrderID";

    mysqli_query($conn, $sql);


?>