<?php
    require_once('../config.php');

    session_start();
    $UserID = $_SESSION['UserID'];

    $sql = "SELECT profilePic from accounts where UserID=$UserID";
    $result = mysqli_query($conn, $sql);
    $profilepic = mysqli_fetch_assoc($result)['profilePic'];

    //get all orders

    $sql = "SELECT * FROM Orders WHERE UserID=$UserID AND (status='COMPLETED' OR status='CANCELLED')";
    $resultOrder = mysqli_query($conn, $sql);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer History Order</title>
    <link rel="stylesheet" href="chistory.css" />
</head>
<body>
    <div class="navitem">
        <a href="index.html"><img src="../images/logo.png" alt="PrinTEX_logo" class="logo"></a>
        <nav>
            <ul>
                <?php

                    $sql = "SELECT * FROM SPInfos WHERE UserID=$UserID";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0) 
                        echo "<button type='becomePrinTEXer' onclick='window.location.href = \"http://localhost/printex/order_pages/orderpage.php\"' class='becomePrinTEXer'>Go to dashboard</button>";
                    else 
                        echo "<button type='becomePrinTEXer' onclick='window.location.href = \"http://localhost/printex/SP Settings/SP settings - Service.php\"' class='becomePrinTEXer'>Become PrinTEXer</button>";

                ?>
                <li><img src="..<?= $profilepic ?>" alt="Profile_icon" class="profile" style="clip-path: circle()"></li>
            </ul>
        </nav>
    </div>

    <hr>

    <div class="grid-container" >
        <div class="grid-item a1" onclick="window.location.href='http:/\/localhost/printex/customer-order/customer-order.php'">
            <div class="content">
                <img src="../images/grid-order.png" alt="Icon_order" class="grid-icon">
                <p class="grid-text">Order</p>
            </div>
        </div>
        <div class="grid-item a2" onclick="window.location.href='http:/\/localhost/printex/customer-tracking/customer-tracking.php'">
            <div class="content">
                <img src="../images/grid-tracking.png" alt="Icon_tracking" class="grid-icon">
                <p class="grid-text">Tracking</p>
            </div>
        </div>
        <div class="grid-item a3 selected" onclick="window.location.href='http:/\/localhost/printex/customer-history/chistory.php'">
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
            <p class="section-text">You can easily review your previous orders and examine 
                the specific details of each transaction you have made.</p>
        </div>
    </div><br>
    <input
        class="search-bar"
        type="text"
        
        placeholder="Search for order ID, customer, order status or something..."
    />
    <div class="column-tracking">
        <table class="table-section">
            <tr style="height: 60px;">
                <td style="width: 10%;"><b>Order ID</b></td>
                <td ><b>Accepted by</b></td>
                <td><b>Delivery</b></td>
                <td><b>Location</b></td>
                <td><b>Total price</b></td>
                <td><b>Order date</td></b>
                <td style="width: 10%;"><b>Status</b></td>
            </tr>


            <?php
                while($rowOrder = mysqli_fetch_assoc($resultOrder))
                {
                    $sql = "SELECT * FROM SPInfos sp JOIN accounts ac ON (sp.UserID=ac.UserID) JOIN addresses ad ON (ad.UserID=sp.UserID) WHERE SPID=$rowOrder[SPID]";
                    $SPresult = mysqli_query($conn, $sql);
                    $rowSP = mysqli_fetch_assoc($SPresult);
                    $shorten = explode(' ', $rowSP['fullname'])[0] . ' ' . explode(' ', $rowSP['fullname'])[1];

                    $price = number_format((float)$rowOrder['price'], 2, '.', '');
                    $typeofdelivery = '';
                                if($rowOrder['typeOfDelivery'] == 'walkin') $typeofdelivery = 'Walk-in';
                    echo "
                        <tr class='table-row'>
                        <td>$rowOrder[OrderID]</td>
                        <td>$shorten</td>
                        <td>$typeofdelivery</td>
                        <td>$rowSP[address1] $rowSP[address2] $rowSP[postcode] $rowSP[state]</td>
                        <td>RM$price</td>
                        <td>$rowOrder[created_at]</td>
                        <form action='chistorydetails.php' method='POST'>
                            <input type='hidden' name='OrderID' value='$rowOrder[OrderID]' />
                            <input type='submit' id='submit' style='display: none;' />
                        </form>
                        ";

                        if($rowOrder['status'] == 'COMPLETED')
                            echo "

                            <td>
                                <div class='status completed'>
                                    Successful        
                                </div>
                            </td>
                            <td style='width: 7%;'><img src='../images/Near me.png' alt='View details' class='viewdetails' onclick='document.getElementById(\"submit\").click()'></td>
                        </tr>
                        ";
                        else
                        echo "

                            <td>
                                <div class='status canceled'>
                                    Cancelled      
                                </div>
                            </td>
                            <td style='width: 7%;'><img src='../images/Near me.png' alt='View details' class='viewdetails' onclick='document.getElementById(\"submit\").click()'></td>
                        </tr>
                        ";

                }
                
            ?>
            

            

        </table>
    </div>
    
</body>
</html>