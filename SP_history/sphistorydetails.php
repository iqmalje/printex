<?php

    require_once('../config.php');

    session_start();

    $UserID = $_SESSION['UserID'];

    //get user info
    $sql = "SELECT fullname, profilePic FROM accounts WHERE UserID=$UserID";
    $resultProfile = mysqli_query($conn, $sql);
    $rowProfile = mysqli_fetch_assoc($resultProfile);

    //get order details
    $OrderID = $_POST['OrderID'];
    $sql = "SELECT * FROM Orders WHERE OrderID = $OrderID";
    $resultOrder = mysqli_query($conn, $sql);
    $rowOrder = mysqli_fetch_assoc($resultOrder);

    //get customer info
    $sql = "SELECT * FROM accounts ac JOIN addresses ad ON (ac.UserID=ad.UserID) WHERE ac.UserID=$rowOrder[UserID]";
    $resultCustomer = mysqli_query($conn, $sql);
    $rowCustomer = mysqli_fetch_assoc($resultCustomer);

    //get file info
    $sql = "SELECT * FROM Files WHERE FileID = $rowOrder[FileID]";
    $resultFile = mysqli_query($conn, $sql);
    $rowFile = mysqli_fetch_assoc($resultFile);

    //get order created
    $orderCreatedDate = explode(' ', $rowOrder['created_at'])[0];
    $orderCreatedTime = explode(' ', $rowOrder['created_at'])[1];
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>History Order Details</title>
        <link rel="stylesheet" href="sphistorydetails.css" />
    </head>
    <body>
        <div class="contents">
            <div class="sidebar">
                <div class="sidebar-contents">
                    <img src="../images/printex_logo.png" alt="printex_logo" />
                    <div class="userprofile">
                        <img
                            src="..<?= $rowProfile['profilePic'] ?>"
                            style="clip-path: circle();"
                            alt="Ellipse%201"
                        />
                        <p><?= $rowProfile['fullname'] ?></p>
                    </div>
                    <hr style="margin-top: 33px; margin-bottom: 10px" />
                    <div
                        class="item orderlist"
                        onclick="window.location.href='http:/\/localhost/printex/order_pages/orderpage.php'"
                    >
                        <img
                            class="icon"
                            src="../images/icon-box.png"
                            style="
                                width: 30px;
                                height: 30px;
                                margin: 0px;
                                margin-right: 20px;
                            "
                            alt="icon-box"
                        />
                        <p>Order list</p>
                    </div>
                    <div class="item history" onclick="window.location.href = 'http:/\/localhost/printex/SP_history/sphistory.php'">
                        <img
                            class="icon"
                            src="../images/icon-clock.png"
                            style="
                                width: 30px;
                                height: 30px;
                                margin: 0px;
                                margin-right: 20px;
                            "
                            alt="icon-clock"
                        />
                        <p>History</p>
                    </div>
                    <div
                        class="item settings"
                        onclick="window.location.href='http:/\/localhost/printex/SP%20Settings/SP%20settings.php'"
                    >
                        <img
                            class="icon"
                            src="../images/icon-settings.png"
                            style="
                                width: 30px;
                                height: 30px;
                                margin: 0px;
                                margin-right: 20px;
                            "
                            alt="icon-settings"
                        />
                        <p>Settings</p>
                    </div>
                    <a href="http://localhost/printex/customer-order/customer-order.php">
                        <p class="redirect-home">Return to home</p>
                    </a>
                </div>
            </div>
            <div class="main">
                <div
                    class="description"
                    style="margin-top: 56px; margin-left: 69px; width: 80%"
                >
                    <h1>Order History</h1>
                    <h4>
                        In the order history section, you can search and review
                        all the orders details you have received from customer
                        in the past. You can view and find many information such
                        as IDs of all orders, customers name, price and order
                        date. Access to this area is limited. Only
                        administrators and PrinTEXer can reach.
                    </h4>
                </div>
                <div class="info-section">
                    <div class="upper-menu">
                        <ul>
                            <li class="section new focus">
                                All History Orders
                            </li>
                        </ul>
                    </div>
                    <hr
                        style="
                            margin-top: 20px;
                            margin-bottom: 20px;
                            width: 90%;
                        "
                    />
                    <div class="main-section">
                        <div class="main-info">
                            <h2>The History Order Details</h2>
                            <h6 class="text">
                                The page enables PrinTEXer to review the status
                                of customer orders. It was includes the customer
                                and order information as record for the
                                PrinTEXer.
                            </h6>
                        </div>
                        <div class="main-data">
                            <div class="column">
                                <div class="profile">
                                    <div class="profile-info">
                                        <img
                                            src="..<?= $rowCustomer['profilePic'] ?>"
                                            alt="default"
                                            class="profile-image"
                                            srcset=""
                                            style="width: 50px; height: 50px; clip-path: circle();"
                                        />
                                        <div class="profile-credentials">
                                            <h3><?= $rowCustomer['fullname'] ?></h3>
                                            <h5><?= $rowCustomer['phoneNo'] ?></h5>
                                        </div>
                                        <?php
                                            if($rowOrder['status'] == 'COMPLETED')
                                            {
                                                echo "<div class='status completed'>
                                                Successful
                                            </div>";
                                            }
                                            else
                                            {
                                                echo "<div class='status canceled'>
                                                Cancelled
                                            </div>";
                                            }
                                        ?>
                                        
                                    </div>
                                    <button class="button-back">
                                        <div class="button-content" onclick="window.location.href = 'http:/\/localhost/printex/SP_history/sphistory.php'">
                                            <img
                                                src="../images/white-arrow.png"
                                                alt="white-arrow"
                                                srcset=""
                                            />
                                            Back To Order List
                                        </div>
                                    </button>
                                </div>
                                <div class="information-row">
                                    <div class="column">
                                        <table>
                                            <tr style="height: 30px">
                                                <td style="width: 120px">
                                                    <b>Location</b>
                                                </td>
                                                <td>
                                                <?= "$rowCustomer[address1] $rowCustomer[address2] $rowCustomer[postcode] $rowCustomer[state]" ?>
                                                    
                                                </td>
                                            </tr>
                                            <tr style="height: 30px">
                                                <td><b>Order Date</b></td>
                                                <td><?= $orderCreatedDate ?></td>
                                            </tr>
                                            <tr style="height: 30px">
                                                <td><b>Order Time</b></td>
                                                <td><?= $orderCreatedTime ?>.</td>
                                            </tr>
                                            <tr style="height: 30px">
                                                <td><b>Delivery Date</b></td>
                                                <td><?= $rowOrder['deliveryDate'] ?></td>
                                            </tr>
                                            <tr style="height: 30px">
                                                <td><b>Delivery Time</b></td>
                                                <td><?= $rowOrder['deliveryDate'] ?></td>
                                            </tr>
                                            <tr style="height: 30px">
                                                <td><b>Delivery Type</b></td>
                                                <td><?= $rowOrder['typeOfDelivery'] == 'walkin' ? 'Walk-in' : 'Delivery' ?></td>
                                            </tr>
                                            <tr style="height: 30px">
                                                <td><b>Price</b></td>
                                                <td>RM <?= number_format((float)$rowOrder['price'], 2, '.', ''); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="file-details">
                                        <div class="file-information">
                                            <div class="file-row">
                                                Color:
                                                <p><b><?= $rowOrder['color'] ?></b></p>
                                            </div>
                                            <div class="file-row">
                                                Printing side:
                                                <p><b><?= $rowOrder['side'] ?></b></p>
                                            </div>
                                            <div class="file-row">
                                                Page per sheet:
                                                <p><b><?= $rowOrder['pagepersheet'] ?></b></p>
                                            </div>
                                            <div class="file-row">
                                                Printing layout:
                                                <p><b><?= $rowOrder['layout'] ?></b></p>
                                            </div>
                                        </div>
                                        <div class="file-information">
                                            <div class="file-row">
                                                Paper size:
                                                <p><b><?= $rowOrder['paperSize'] ?></b></p>
                                            </div>
                                            <div class="file-row">
                                                Copies:
                                                <p><b><?= $rowOrder['copies'] ?></b></p>
                                            </div>
                                            <div class="file-row">
                                                Number of pages:
                                                <p><b><?= $rowFile['totalPage'] ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
