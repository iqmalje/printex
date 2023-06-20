<?php

    $OrderID = $_POST['OrderID'];
    require_once('../config.php');
    session_start();
    $UserID = $_SESSION['UserID'];
    //get profilepic
    $sql = "SELECT profilePic FROM accounts WHERE UserID=$UserID";
    $resultProfilePic = mysqli_query($conn, $sql);
    $profilePic = mysqli_fetch_assoc($resultProfilePic)['profilePic'];

    $sql = "SELECT * FROM Orders WHERE OrderID=$OrderID";

    $resultOrder = mysqli_query($conn, $sql);
    $rowOrder = mysqli_fetch_assoc($resultOrder);

    $sql = "SELECT ac.profilePic, ac.phoneNo, ac.fullname, ad.address1, ad.address2, ad.state, ad.postcode FROM accounts ac JOIN SPInfos sp ON (ac.UserID=sp.UserID) JOIN Addresses ad ON (ac.UserID=ad.UserID) WHERE sp.SPID=$rowOrder[SPID]";
    $resultSP = mysqli_query($conn, $sql);
    $rowSP = mysqli_fetch_assoc($resultSP);

    
    $sql = "SELECT * FROM Files WHERE FileID=$rowOrder[FileID]";
    $resultFile = mysqli_query($conn, $sql);
    $rowFile = mysqli_fetch_assoc($resultFile);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrinTEX | Order </title>
    <link rel="stylesheet" href="orderdetail-tracking.css" />
</head>
<body>
    <div class="navitem">
        <a href="index.html"><img src="../images/logo.png" alt="PrinTEX_logo" class="logo"></a>
        <nav>
            <ul>
                <li><button type="becomePrinTEXer" class="becomePrinTEXer">Become PrinTEXer</button></li>
                <li><img src="..<?= $profilePic ?>" alt="Profile_icon" style="clip-path: circle();"class="profile"></li>
            </ul>
        </nav>
    </div>

    <hr>

    <div class="row-backbtn">
        <button onclick="window.location.href = 'http:/\/localhost/printex/customer-tracking/customer-tracking.php'" type="button" class="backbtn">Back To Order</button>
    </div>

    <h1>Order Progress Bar</h1>

    <div class="progressbar">

        <?php
            $statusOrder = $rowOrder['status'];

            switch($statusOrder)
            {
                case 'PENDING':
                    echo
                    '
                    <div class="submitted done">
                        <img src="../images/file_green.png" alt="file icon" class="submittedicon">Submitted
                    </div>
            
                    <img src="../images/progressbar-gray.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
            
                    <div class="preparing">
                        <img src="../images/prepare_gray.png" alt="prepare icon" class="preparingicon">Preparing
                    </div>
            
                    <img src="../images/progressbar-gray.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
            
                    <div class="deliver">
                        <img src="../images/delivery_gray.png" alt="deliver icon" class="delivericon">Deliver
                    </div>
                    <img src="../images/progressbar-gray.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
                    <div class="completed">
                        <img src="../images/complete_gray.png" alt="Completed icon" class="completedicon">Completed
                    </div>
                    ';
                    break;
                case 'PREPARING':
                    echo
                    '
                    <div class="submitted done">
                        <img src="../images/file_green.png" alt="file icon" class="submittedicon">Submitted
                    </div>
            
                    <img src="../images/progressbar-green.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
            
                    <div class="preparing done">
                        <img src="../images/prepare_green.png" alt="prepare icon" class="preparingicon">Preparing
                    </div>
            
                    <img src="../images/progressbar-gray.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
            
                    <div class="deliver">
                        <img src="../images/delivery_gray.png" alt="deliver icon" class="delivericon">Deliver
                    </div>
                    <img src="../images/progressbar-gray.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
                    <div class="completed">
                        <img src="../images/complete_gray.png" alt="Completed icon" class="completedicon">Completed
                    </div>
                    ';
                    break;
                case 'DELIVERING':
                    echo
                    '
                    <div class="submitted done">
                        <img src="../images/file_green.png" alt="file icon" class="submittedicon">Submitted
                    </div>
            
                    <img src="../images/progressbar-green.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
            
                    <div class="preparing done">
                        <img src="../images/prepare_green.png" alt="prepare icon" class="preparingicon">Preparing
                    </div>
            
                    <img src="../images/progressbar-green.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
            
                    <div class="deliver done">
                        <img src="../images/delivery_green.png" alt="deliver icon" class="delivericon">Deliver
                    </div>
                    <img src="../images/progressbar-gray.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
                    <div class="completed">
                        <img src="../images/complete_gray.png" alt="Completed icon" class="completedicon">Completed
                    </div>
                    ';
                    break;
                case 'COMPLETED':
                    echo
                    '
                    <div class="submitted done">
                        <img src="../images/file_green.png" alt="file icon" class="submittedicon">Submitted
                    </div>
            
                    <img src="../images/progressbar-green.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
            
                    <div class="preparing done">
                        <img src="../images/prepare_green.png" alt="prepare icon" class="preparingicon">Preparing
                    </div>
            
                    <img src="../images/progressbar-green.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
            
                    <div class="deliver done">
                        <img src="../images/delivery_green.png" alt="deliver icon" class="delivericon">Deliver
                    </div>
                    <img src="../images/progressbar-green.png" alt="progress bar" style="max-width: 100%; max-height: 15px;">
                    <div class="completed done">
                        <img src="../images/complete_green.png" alt="Completed icon" class="completedicon">Completed
                    </div>
                    ';
                    break;
            }
        ?>
        

        
    </div>

    <h1>Order Details</h1>

    <div class="customerorder">
        <div class="column1">
            <div class="SPinfo">
                <img src="..<?= $rowSP['profilePic'] ?>" alt="SP profile" style="width: 50px;clip-path: circle();"> 

                <div class="row-SPinfo">
                    <?= $rowSP['fullname'] ?>
                    <p class="nophone"><?= $rowSP['phoneNo'] ?></p>
                </div>
            </div>
            <table class="table_SP">
                <tr style="height: 30px;">
                    <td style="width: 25%">Location</td>
                    <td style="width: 100%"><?= "$rowSP[address1] $rowSP[address2] $rowSP[postcode] $rowSP[state]" ?></td>
                </tr>

                <tr style="height: 30px;">
                    <td>Order ID</td>
                    <td><?= $rowOrder['OrderID'] ?></td>
                </tr>

                <tr style="height: 30px;">
                    <td>Delivery Date</td>
                    <td><?= $rowOrder['deliveryDate'] ?></td>
                </tr>

                <tr style="height: 30px;">
                    <td>Delivery Type</td>
                    <td>
                    <?php
                        if($rowOrder['typeOfDelivery'] == 'walkin') echo 'Walk-in';
                        else echo 'Delivery';
                    ?>
                   </td>
                </tr>

                <tr style="height: 30px;">
                    <td>Price</td>
                    <td>RM<?= number_format((float)$rowOrder['price'], 2, '.', ''); ?></td>
                </tr>
            </table>
        </div>

        <div class="column2">
            <div class="column2_row1">
                <div class="row">
                    File name:
                    <p><?= $rowFile['filename'] ?></p>
                </div>
                <div class="row">
                    Printing color:
                    <p><?php
                        if($rowOrder['color'] == "BW") echo 'Black & White';
                        else echo 'Color';
                    ?></p>
                </div>
                <div class="row">
                    Printing side:
                    <p><?= $rowOrder['side'] ?></p>
                </div>
                <div class="row">
                    Page per sheet:
                    <p><?= $rowOrder['pagepersheet'] ?></p>
                </div>
                <div class="row">
                    Printing layout:
                    <p><?= $rowOrder['layout'] ?></p>
                </div>
                <div class="row">
                    Paper size:
                    <p><?= $rowOrder['paperSize'] ?></p>
                </div>
                <div class="row">
                    Copies:
                    <p><?= $rowOrder['copies'] ?></p>
                </div>
                <div class="row">
                    Number of pages:
                    <p><?= $rowFile['totalPage'] ?></p>
                </div>
            </div>
            
            <div class="cancel-section">

                <?php
                    //if order is already completed, customer cannot cancel
                    if(!($rowOrder['status'] == 'COMPLETED' || $rowOrder['status'] == 'CANCELLED'))
                    {
                        //form for cancelling order
                        echo "
                        <form action='cancel_order.php' method='post'>
                            <input type='hidden' name='OrderID' value='$rowOrder[OrderID]' />
                            <input type='submit' value='Cancel Order' class='cancelbtn'/>
                        </form>
                        ";

                        
                    }
                ?>
            </div>
            
            
        </div>
    </div>
</body>