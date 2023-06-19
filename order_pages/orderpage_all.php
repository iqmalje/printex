<?php
    require_once('../config.php');

    //fetch user profile

    session_start();

    $UserID = $_SESSION['UserID'];

    $sqlProfile = "SELECT profilePic, fullname FROM accounts WHERE UserID=$UserID";

    $resultProfile = mysqli_query($conn, $sqlProfile);
    $rowProfile = mysqli_fetch_assoc($resultProfile);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Order Details</title>
        <link rel="stylesheet" href="orderpage.css" />
    </head>
    <body>
        <script src="orderdetail.js"></script>
        <div class="contents">
            <div class="sidebar">
                <div class="sidebar-contents">
                    <img src="../images/printex_logo.png" />
                    <div class="userprofile">
                        <img src="..<?= $rowProfile['profilePic'] ?>" style="
                                width: 60px;
                                height: 60px;
                                clip-path: circle();
                            "  />
                        <p><?= $rowProfile['fullname'] ?></p>
                    </div>
                    <hr style="margin-top: 33px; margin-bottom: 10px" />
                    <div class="item orderlist">
                        <img
                            class="icon"
                            src="../images/icon-box.png"
                            style="
                                width: 30px;
                                height: 30px;
                                margin: 0px;
                                margin-right: 20px;
                                clip-path: circle();
                            "
                        />
                        <p>Order list</p>
                    </div>

                    <div class="item tracking">
                        <img
                            class="icon"
                            src="../images/icon-pin.png"
                            style="
                                width: 30px;
                                height: 30px;
                                margin: 0px;
                                margin-right: 20px;
                            "
                        />
                        <p>Tracking</p>
                    </div>
                    <div class="item history">
                        <img
                            class="icon"
                            src="../images/icon-clock.png"
                            style="
                                width: 30px;
                                height: 30px;
                                margin: 0px;
                                margin-right: 20px;
                            "
                        />
                        <p>History</p>
                    </div>
                    <div class="item settings">
                        <img
                            class="icon"
                            src="../images/icon-settings.png"
                            style="
                                width: 30px;
                                height: 30px;
                                margin: 0px;
                                margin-right: 20px;
                            "
                        />
                        <p>Settings</p>
                    </div>
                    <p class="redirect-home">Return to home</p>
                </div>
            </div>
            <div class="main">
                <div
                    class="description"
                    style="margin-top: 56px; margin-left: 69px; width: 80%"
                >
                    <h1>Order Details</h1>
                    <p style="margin-top: 9px; color: #808080">
                        In the order details section, you can review and manage
                        all the orders with their details. You can view and edit
                        many information such as IDs of all orders, customers
                        name, order date, price and order status. Access to this
                        area is limited. Only administrators and PrinTEXer can
                        reach. The changes you make will be approved after they
                        are checked.
                    </p>
                </div>
                <div class="info-section">
                    <div class="upper-menu">
                        <ul>
                            <li id="new-order-button" class="section new">
                                New Orders
                            </li>
                            <li id="all-order-button" class="section all focus">
                                All Orders
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
                                <th>Pricing</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Order Status</th>
                            </tr>

                            <?php
                                //FETCH SPID
                                $sql = "SELECT SPID FROM SPInfos WHERE UserID=$UserID";
                                $resultSPID = mysqli_query($conn, $sql);
                                $SPID = mysqli_fetch_assoc($resultSPID)['SPID'];

                                //FETCH ORDERS (PENDING ONLY)
                                $sqlOrders = "SELECT o.OrderID, o.status, ac.fullname, o.price FROM Orders o JOIN accounts ac ON (ac.UserID=o.UserID) WHERE SPID=$SPID";
                                $resultOrders = mysqli_query($conn, $sqlOrders);
                                while($rowOrders = mysqli_fetch_assoc($resultOrders))
                                {

                                    $price = number_format((float)$rowOrders['price'], 2, '.', '');

                                    if($rowOrders['status'] == "PREPARING")
                                    {
                                        echo "
                                        
                                        <tr>
                                            <td>$rowOrders[OrderID]</td>
                                            <td>$rowOrders[fullname]</td>
                                            <td>Walk-in</td>
                                            <td>RM$price</td>
                                            <td>12.04.2023</td>
                                            <td>12.04.2023</td>
                                            <td>
                                                <div class='row'>
                                                    <div class='status preparing'>
                                                        Preparing
                                                    </div>
                                                    <img
                                                        src='../images/arrow.png'
                                                        alt=''
                                                        srcset=''
                                                        width='18'
                                                        class='arrow'
                                                        height='18'
                                                        onclick='openOrderDetail($rowOrders[OrderID])'
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        ";
                                    }
                                    else if ($rowOrders['status']=='DELIVERING')
                                    {
                                        echo "
                                        
                                        <tr>
                                            <td>$rowOrders[OrderID]</td>
                                            <td>$rowOrders[fullname]</td>
                                            <td>Walk-in</td>
                                            <td>RM$price</td>
                                            <td>12.04.2023</td>
                                            <td>12.04.2023</td>
                                            <td>
                                                <div class='row'>
                                                    <div class='status completed'>
                                                        Delivering
                                                    </div>
                                                    <img
                                                        src='../images/arrow.png'
                                                        alt=''
                                                        srcset=''
                                                        width='18'
                                                        class='arrow'
                                                        height='18'
                                                        onclick='openOrderDetail($rowOrders[OrderID])'
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        ";
                                    }
                                }
                            ?>  
                            
                            <!--THIS SECTION WILL BE HIDDEN UNTIL USER ONCE TO SEE IT-->
                            <tr class="more-info"></tr>
                            <form action="orderdetail.php" method="post">
                                <input type="hidden"  id="OrderID" name="OrderID" value="">
                                <input type="submit" id="submit" value="" style="display: none;">
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var neworderbutton = document.getElementById("new-order-button");
            var allorderbutton = document.getElementById("all-order-button");

            neworderbutton.onclick = function () {
                window.location.href = "http://localhost/printex/order_pages/orderpage.php"
            };

            
        </script>
    </body>
</html>
