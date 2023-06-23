<?php

    require_once('../config.php');
    session_start();
    //get spid
    $UserID = $_SESSION['UserID'];

    $sql = "SELECT s.SPID, ac.profilePic, ac.fullname FROM SPInfos s JOIN accounts ac ON (ac.UserID=s.UserID) WHERE s.UserID=$UserID";
    $resultSPID = mysqli_query($conn, $sql);
    $rowSPID = mysqli_fetch_assoc($resultSPID);
    $sql = "SELECT * FROM Orders WHERE SPID=$rowSPID[SPID] AND (status='COMPLETED' OR status='CANCELLED')";
    $resultOrders = mysqli_query($conn, $sql);
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Order History</title>
        <link rel="stylesheet" href="sphistory.css" />
    </head>
    <body>
        <div class="contents">
            <div class="sidebar">
                <div class="sidebar-contents">
                    <img src="../images/printex_logo.png" alt="printex_logo" />
                    <div class="userprofile">
                        <img
                            src="..<?= $rowSPID['profilePic'] ?>"
                            style="clip-path: circle();"
                            alt="Ellipse%201"
                        />
                        <p><?= $rowSPID['fullname'] ?></p>
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
                    <p style="margin-top: 9px; color: #808080">
                        In the order history section, you can search and review
                        all the orders details you have received from customer
                        in the past. You can view and find many information such
                        as IDs of all orders, customers name, price and order
                        date. Access to this area is limited. Only
                        administrators and PrinTEXer can reach.
                    </p>
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
                            margin-top: 19px;
                            margin-bottom: 33px;
                            width: 90%;
                        "
                    />
                    <input
                        class="search-bar"
                        type="text"
                        placeholder="Search for order ID, customer, order status or something..."
                    />
                    <div class="table-section">
                        <table style="width: 90%">
                        <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Delivery</th>
                                <th>Total price</th>
                                <th>Date</th>
                                <th>Order Status</th>
                            </tr>
                            <form action="sphistorydetails.php" method="post">
                                <input type="hidden" id="OrderID" name="OrderID" value="">
                                <input type="submit" id="submit" style="display: none;">
                            </form>
                        <?php
                            while($rowOrders = mysqli_fetch_assoc($resultOrders))
                            {
                                $typeofdelivery = '';
                                if($rowOrders['typeOfDelivery'] == 'walkin') $typeofdelivery = 'Walk-in';
                                else $typeofdelivery = 'Delivery';
                                $price = number_format((float)$rowOrders['price'], 2, '.', '');

                                //get customer name
                                $sql = "SELECT ac.fullname FROM accounts ac WHERE ac.UserID=$rowOrders[UserID]";

                                $resultCustomer = mysqli_query($conn, $sql);
                                $fullname = mysqli_fetch_assoc($resultCustomer)['fullname'];
                                $shorten = explode(' ', $fullname)[0] . ' ' . explode(' ', $fullname)[1];
                                echo "
                                <tr onclick='openDetails($rowOrders[OrderID])'>
                                <td>$rowOrders[OrderID]</td>
                                <td>$shorten</td>
                                <td>$typeofdelivery</td>
                                <td>RM$price</td>
                                <td>$rowOrders[deliveryDate]</td>";
                                if($rowOrders['status'] == 'COMPLETED')
                                echo "
                                    <td>
                                        <div class='status completed'>
                                            Completed
                                        </div>
                                    </td>
                                </tr>
                                
                                ";
                                else
                                echo "
                                    <td>
                                        <div class='status canceled'>
                                            Canceled
                                        </div>
                                    </td>
                                </tr>
                                
                                ";
                            }
                        ?>
                            
                            
                            
                            <!--THIS SECTION WILL BE HIDDEN UNTIL USER ONCE TO SEE IT-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function openDetails(orderid)
            {
                document.getElementById('OrderID').value = orderid;
                document.getElementById('submit').click();
            }
        </script>
    </body>
</html>
