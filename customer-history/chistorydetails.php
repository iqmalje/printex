<?php  

    session_start();
    require_once('../config.php');
    $UserID = $_SESSION['UserID'];
    $sql = "SELECT ac.profilePic, sp.SPID FROM accounts ac JOIN SPInfos SP ON (ac.UserID=sp.UserID) WHERE ac.UserID=$UserID";
    $userResult = mysqli_query($conn, $sql);
    $rowUser = mysqli_fetch_assoc($userResult);



    //nanti tukar post
    $OrderID = $_POST['OrderID'];
    


    //get order details
    $sql = "SELECT * FROM Orders o JOIN accounts ac ON (o.UserID=ac.UserID) JOIN Files f ON (f.FileID=o.FileID) JOIN addresses a ON (a.UserID=o.UserID) WHERE o.UserID=$UserID";
    $resultOrder = mysqli_query($conn, $sql);
    $rowOrder = mysqli_fetch_assoc($resultOrder);


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PrinTEX | Order</title>
        <link rel="stylesheet" href="chistorydetails.css" />
    </head>
    <body>
        <div class="navitem">
            <a href="index.html"
                ><img src="../images/logo.png" alt="PrinTEX_logo" class="logo"
            /></a>
            <nav>
                <ul>
                    <li>
                    <?php

                        
                        if($rowUser['SPID'] != null) 
                            echo "<button type='becomePrinTEXer' onclick='window.location.href = \"http://localhost/printex/order_pages/orderpage.php\"' class='becomePrinTEXer'>Go to dashboard</button>";
                        else 
                            echo "<button type='becomePrinTEXer' onclick='window.location.href = \"http://localhost/printex/SP Settings/SP settings - Service.php\"' class='becomePrinTEXer'>Become PrinTEXer</button>";

                        ?>
                    </li>
                    <li>
                        <img
                            src="..<?= $rowUser['profilePic'] ?>"
                            alt="Profile_icon"
                            style="clip-path: circle();"
                            class="profile"
                        />
                    </li>
                </ul>
            </nav>
        </div>

        <hr />

        <div class="row-backbtn">
            <button type="button" onclick="window.location.href='http:/\/localhost/printex/customer-history/chistory.php'" class="backbtn">Back To Order</button>
        </div>

        <h1>Order Details</h1>

        <div class="customerorder">
            <div class="column1">
                <div class="SPinfo">
                    <img
                        src="..<?= $rowOrder['profilePic'] ?>"
                        alt="SP profile"
                        style="clip-path: circle(); width: 50px"
                    />

                    <div class="row-SPinfo">
                        <?= $rowOrder['fullname'] ?>
                        <p class="nophone"><?= $rowOrder['phoneNo'] ?></p>
                    </div>
                </div>
                <table class="table_SP">
                    <tr style="height: 30px">
                        <td style="width: 25%">Location</td>
                        <td style="width: 100%">
                        <?= "$rowOrder[address1] $rowOrder[address2] $rowOrder[postcode] $rowOrder[state]" ?>
                            
                        </td>
                    </tr>

                    <tr style="height: 30px">
                        <td>Order ID</td>
                        <td><?= $rowOrder['OrderID'] ?></td>
                    </tr>

                    <tr style="height: 30px">
                        <td>Delivery Date</td>
                        <td><?= $rowOrder['deliveryDate'] ?></td>
                    </tr>

                    <tr style="height: 30px">
                        <td>Delivery Type</td>
                        <td><?= $rowOrder['typeOfDelivery'] == 'walkin' ? 'Walk-In' : 'Delivery' ?></td>
                    </tr>

                    <tr style="height: 30px">
                        <td>Price</td>
                        <td>RM<?= number_format((float)$rowOrder['price'], 2, '.', ''); ?></td>
                    </tr>

                    <tr style="height: 30px">
                        <td>Order Status</td>
                        <td class="orderstatus <?= $rowOrder['status'] == 'CANCELLED' ? 'cancelled' : '' ?>"><b><?= $rowOrder['status'] == 'COMPLETED' ? 'Successful' : 'Cancelled' ?></b></td>
                    </tr>

                    <tr style="height: 30px">
                        <td>Rating</td>
                        <td>5 stars</td>
                    </tr>

                    <tr style="height: 70px">
                        <td class="comment">Comment</td>
                        <td class="commentbox">
                            Service provider punctual with time stated
                        </td>
                    </tr>
                </table>
            </div>

            <div class="column2">
                <div class="column2_row1">
                    <div class="row">
                        File name:
                        <p><?= $rowOrder['filename'] ?></p>
                    </div>
                    <div class="row">
                        Printing color:
                        <p><?= $rowOrder['color'] == 'BW' ? 'Black & White' : 'Color' ?></p>
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
                        <p>1</p>
                    </div>
                    <div class="row">
                        Number of pages:
                        <p><?= $rowOrder['copies'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
