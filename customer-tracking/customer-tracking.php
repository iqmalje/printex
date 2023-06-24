<?php
    require_once('../config.php');

    session_start();

    $UserID = $_SESSION['UserID'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrinTEX | Tracking </title>
    <link rel="stylesheet" href="customer-tracking.css" />
</head>
<body>
    <div class="navitem">
        <a href="index.html"><img src="../images/logo.png" alt="PrinTEX_logo" class="logo"></a>
        <nav>
            <ul>
                <li><button type="becomePrinTEXer" class="becomePrinTEXer">Become PrinTEXer</button></li>
                <li><img src="../images/profile.png" alt="Profile_icon" class="profile"></li>
            </ul>
        </nav>
    </div>

    <hr>

    <div class="grid-container">
        <div class="grid-item a1"  onclick="window.location.href='http:/\/localhost/printex/customer-order/customer-order.php'">
            <div class="content">
                <img src="../images/grid-order.png" alt="Icon_order" class="grid-icon">
                <p class="grid-text">Order</p>
            </div>
        </div>
        <div class="grid-item a2 selected">
            <div class="content">
                <img src="../images/grid-tracking.png" alt="Icon_tracking" class="grid-icon">
                <p class="grid-text">Tracking</p>
            </div>
        </div>
        <div class="grid-item a3" onclick="window.location.href='http:/\/localhost/printex/customer-history/aa.php'">
            <div class="content">
                <img src="../images/grid-history.png" alt="Icon_history" class="grid-icon">
                <p class="grid-text">History</p>
            </div>
        </div>
    </div>
    <div>
        <hr>
    </div>

    <div class="column-sectioninfo">
        <div class="row-sectioninfo">
            <img src="../images/section-icon.png" alt="Section_icon" class="info-icon">
            <p class="section-text">You have the convenience to effortlessly track the status of your order bookings and receive timely updates on their progress. Additionally, you have the option to update the order status, whether it has been completed or canceled by the PrinTEXer.</p>
        </div>
    </div>

    <div class="searchbar">

    </div>
    <form action="orderdetail-tracking.php" method="post">
        <input type="hidden" name="OrderID" id="OrderID">
        <input type="submit" style="display: none;" value="" id="submit">
    </form>
    <div class="column-tracking">
        <table class="table-trackingorder">
            <tr style="height: 60px;">
                <td style="width: 10%;"><b>Order ID</b></td>
                <td style="width: 32%;"><b>Accepted by</b></td>
                <td><b>Order date</b></td>
                <td><b>Delivery date</b></td>
                <td><b>Total price</b></td>
                <td style="width: 10%;"><b>Status</b></td>
            </tr>

            <?php
                $sql = "SELECT o.OrderID, ac.fullname, o.deliveryDate, o.price, o.status FROM Orders o JOIN accounts ac ON (o.UserID=ac.UserID) WHERE o.UserID=$UserID";

                $resultOrders = mysqli_query($conn, $sql);

                while($rowOrder = mysqli_fetch_assoc($resultOrders))
                {  
                    $price = number_format((float)$rowOrder['price'], 2, '.', '');
                    switch ($rowOrder['status']){
                        case 'PREPARING':
                            echo "
                                <tr class='table-row'>
                                    <td>$rowOrder[OrderID]</td>
                                    <td>$rowOrder[fullname]</td>
                                    <td>12.04.2023</td>
                                    <td>$rowOrder[deliveryDate]</td>
                                    <td>RM$price</td>
                                    <td>
                                        <div class='orderstatus preparing'>
                                            Preparing      
                                        </div>
                                    </td>
                                    <td style='width: 7%;'>
                                    <img src='../images/Near me.png' onclick='openDetailPage($rowOrder[OrderID])' alt='View details' class='viewdetails'>
                                    </td>
                                </tr>
                                ";
                        break;
                        case 'DELIVERING':
                            echo "
                                <tr class='table-row'>
                                    <td>$rowOrder[OrderID]</td>
                                    <td>$rowOrder[fullname]</td>
                                    <td>12.04.2023</td>
                                    <td>$rowOrder[deliveryDate]</td>
                                    <td>RM$price</td>
                                    <td>
                                        <div class='orderstatus delivering'>
                                            Delivering      
                                        </div>
                                    </td>
                                    <td style='width: 7%;'>
                                    <img src='../images/Near me.png' onclick='openDetailPage($rowOrder[OrderID])' alt='View details' class='viewdetails'>
                                    </td>
                                </tr>
                                ";
                        break;
                        case 'COMPLETED':
                            echo "
                                <tr class='table-row'>
                                    <td>$rowOrder[OrderID]</td>
                                    <td>$rowOrder[fullname]</td>
                                    <td>12.04.2023</td>
                                    <td>$rowOrder[deliveryDate]</td>
                                    <td>RM$price</td>
                                    <td>
                                        <div class='orderstatus completed'>
                                            COMPLETED      
                                        </div>
                                    </td>
                                    <td style='width: 7%;'><img onclick='openDetailPage($rowOrder[OrderID])' src='../images/Near me.png' alt='View details' class='viewdetails'></td>
                                </tr>
                                ";
                        break;
                        case 'PENDING':
                            echo "
                                <tr class='table-row'>
                                    <td>$rowOrder[OrderID]</td>
                                    <td>$rowOrder[fullname]</td>
                                    <td>12.04.2023</td>
                                    <td>$rowOrder[deliveryDate]</td>
                                    <td>RM$price</td>
                                    <td>
                                        <div class='orderstatus preparing'>
                                            Pending      
                                        </div>
                                    </td>
                                    <td style='width: 7%;'>
                                    <img onclick='openDetailPage($rowOrder[OrderID])' src='../images/Near me.png' alt='View details' class='viewdetails'>
                                    </td>
                                </tr>
                                ";
                        break;
                        case "CANCELLED":
                            echo "
                                <tr class='table-row'>
                                    <td>$rowOrder[OrderID]</td>
                                    <td>$rowOrder[fullname]</td>
                                    <td>12.04.2023</td>
                                    <td>$rowOrder[deliveryDate]</td>
                                    <td>RM$price</td>
                                    <td>
                                        <div class='orderstatus canceled'>
                                            Cancelled
                                        </div>
                                    </td>
                                    <td style='width: 7%;'>
                                    <img onclick='openDetailPage($rowOrder[OrderID])' src='../images/Near me.png' alt='View details' class='viewdetails'>
                                    </td>
                                </tr>
                                ";
                        break;

                        
                    }
                    
                    
                }
            ?>

            


        </table>
        <script src="customer-tracking.js">

          
        </script>
    
</body>
</html>