<?php
    $OrderID = $_POST['OrderID'];
    session_start();
    $UserID = $_SESSION['UserID'];


    require_once('../config.php');
    $sqlOrder = "SELECT * FROM Orders WHERE OrderID=$OrderID";
    $resultOrder = mysqli_query($conn, $sqlOrder);
    $rowOrder = mysqli_fetch_assoc($resultOrder);

    $sqlUser = "SELECT ac.profilePic, ac.phoneNo,ac.fullname, ac.email, ad.address1, ad.address2, ad.postcode, ad.state
                FROM accounts ac JOIN addresses ad ON (ac.UserID = ad.UserId) WHERE ac.UserID=$rowOrder[UserID]";

    $resultUser = mysqli_query($conn, $sqlUser);
    $rowUser = mysqli_fetch_assoc($resultUser);

    $sqlFile = "SELECT f.filename, f.filepath, f.totalPage FROM files f JOIN Orders o ON (f.OrderID=o.OrderID) WHERE o.OrderID=$OrderID";
    $resultFile = mysqli_query($conn, $sqlFile);
    $rowFile = mysqli_fetch_assoc($resultFile);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Order Details</title>
        <link rel="stylesheet" href="orderdetail.css" />
    </head>
    <body>
        <div class="contents">
            <div class="sidebar">
                <div class="sidebar-contents">
                    <img src="../images/printex_logo.png" />
                    <div class="userprofile">
                        <img src="../images/profile/Ellipse 1.png" />
                        <p>Fikri Akmal Aizuddin Bin Bahrim</p>
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
                            <li id="new-order-button" class="section new focus">
                                New Orders
                            </li>
                            <li id="all-order-button" class="section all">
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
                    <div class="main-section">
                        <div class="main-info">
                            <h2>The Order Details</h2>
                            <p style="margin-top: 9px; color: #808080">
                                The page enables PrinTEXer to update the
                                estimated delivery time and order status,
                                facilitating efficient order management and
                                effective customer communication
                            </p>
                        </div>
                        <div class="main-data">
                            <div class="column-data">
                                <div class="profile">
                                    <div class="profile-info">
                                        <img
                                            src="..<?= $rowUser['profilePic'] ?>"
                                            alt=""
                                            class="profile-image"
                                            srcset=""
                                        />
                                        <div class="profile-credentials">
                                            <h3><?= $rowUser['fullname'] ?></h3>
                                            <p>
                                            <?= $rowUser['email'] ?>,
                                            <?= $rowUser['phoneNo'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <button 
                                    onclick="window.location.href = 'http:/\/localhost/printex/order_pages/orderpage_all.php'"
                                    class="back">
                                        <div class="button-content">
                                            <img
                                                src="../images/white-arrow.png"
                                                alt=""
                                                srcset=""
                                            />
                                            Back To Order List
                                        </div>
                                    </button>
                                </div>
                                <div class="information-row">
                                    <div class="column">
                                        <table>
                                            <tr>
                                                <td>Location</td>
                                                <td>
                                                <?= "$rowUser[address1] $rowUser[address2] $rowUser[postcode] $rowUser[state]" ?>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Order ID</td>
                                                <td><?= $rowOrder['OrderID'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Delivery Date</td>
                                                <td><?= $rowOrder['deliveryDate'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Delivery Time</td>
                                                <td><?= $rowOrder['deliveryTime'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Delivery Type</td>
                                                <td><?php
                                                    if($rowOrder['typeOfDelivery'] == 'walkin')
                                                        echo 'Walk-In';
                                                    else
                                                        echo 'Delivery';
                                                ?></td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td>RM <?= number_format((float)$rowOrder['price'], 2, '.', ''); ?></td>
                                            </tr>
                                        </table>
                                        <div class="time-row" style="margin-top: 30px; margin-bottom: 10px">
                                            Estimated Delivery Time
                                            <form action="update_delivered.php" method="post" style="display: flex;">
                                            <input
                                                type="time"
                                                name="deliveredTime"
                                                class="estimated-time"
                                                value="<?php
                                                    if($rowOrder['deliveredTime'] != null)
                                                    {
                                                        echo $rowOrder['deliveredTime'];
                                                    }
                                                    else echo '';
                                                ?>"
                                                id="estimated-time"
                                            />
                                            <input type="hidden" name="OrderID" value="<?= $OrderID ?>">
                                          

                                            <input type="submit" value="Update" class="deliver-button">
                                            </form>
                                            
                                        </div>
                                        <textarea
                                            name=""
                                            id=""
                                            placeholder="Drop any message to your customer"
                                        ></textarea>
                                        <div class="row-button">
                                            <button class="cancel"
                                            
                                            onclick="window.location.href = 'http:/\/localhost/printex/order_pages/orderpage_all.php'">
                                                Cancel
                                            </button>
                                            <form action="update_completed.php" method="post">
                                                <input type="hidden" name="OrderID" value="<?=$OrderID ?>">
                                                <input type="submit" value="" style="display:none;" id="submitcompleted">
                                            </form>
                                            <button class="complete" onclick="document.getElementById('submitcompleted').click()">
                                                Complete
                                            </button>
                                        </div>
                                    </div>

                                    <div class="file-details">
                                        <div class="file-information">
                                            <div class="file-row">
                                                File name:
                                                <b> <?= $rowFile['filename'] ?></b>
                                            </div>
                                            
                                            <div class="file-row">
                                                Color:
                                                <b> <?php 
                                                    if($rowOrder['color'] == 'BW')
                                                        echo "Black & White";
                                                    else 
                                                        echo "Color";
                                                ?></b>
                                            </div>
                                            <div class="file-row">
                                                Printing side: 
                                                <b><?= $rowOrder['side'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Page per sheet: 
                                                <b> <?= $rowOrder['pagepersheet'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Printing layout: 
                                                <b> <?= $rowOrder['layout'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Paper size: <b> <?= $rowOrder['paperSize'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Copies: <b> <?= $rowOrder['copies'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Number of pages: <b> <?= $rowFile['totalPage'] ?></b>
                                            </div>
                                        </div>

                                        <div class="print-menu">
                                            <div class="menu-row">
                                                <img
                                                    src="../images/printer-logo.png"
                                                    alt=""
                                                    srcset=""
                                                />
                                                <h2>Auto-Print</h2>
                                            </div>
                                            <div class="button-column">
                                                <button>Print (B&W)</button>
                                                <button>Print (Color)</button>
                                                <button>Only Print</button>
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

        <script>
            var neworderbutton = document.getElementById("new-order-button");
            var allorderbutton = document.getElementById("all-order-button");

            neworderbutton.onclick = function () {
                neworderbutton.className = "section new focus";
                allorderbutton.className = "section all";
            };

            allorderbutton.onclick = function () {
                neworderbutton.className = "section new";
                allorderbutton.className = "section all focus";
            };
        </script>
    </body>
</html>
