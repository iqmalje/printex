<?php
    $OrderID = $_POST['OrderID'];
    session_start();
    $UserID = $_SESSION['UserID'];


    require_once('../config.php');
    $sqlOrder = "SELECT * FROM Orders WHERE OrderID=$OrderID";
    $resultOrder = mysqli_query($conn, $sqlOrder);
    $rowOrder = mysqli_fetch_assoc($resultOrder);

    $sqlUser = "SELECT ac.UserID, ac.profilePic, ac.phoneNo,ac.fullname, ac.email, ad.address1, ad.address2, ad.postcode, ad.state
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
                    <div class="item orderlist" onclick="window.location.href='http:/\/localhost/printex/order_pages/orderpage.php'">
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
                        />
                        <p>History</p>
                    </div>
                    <div class="item settings" onclick="window.location.href='http:/\/localhost/printex/SP%20Settings/SP%20settings.php'">
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
                                        <table class="table-info">
                                            <tr>
                                                <td><b>Location</b></td>
                                                <td>
                                                    
                                                <?php
                                                    $sqladdress = "SELECT * FROM addresses WHERE UserID=$rowUser[UserID]";
                                                    $resultaddress = mysqli_query($conn, $sqladdress);

                                                    $rowaddress = mysqli_fetch_assoc($resultaddress);

                                                    echo "$rowaddress[address1] $rowaddress[address2] $rowaddress[postcode] $rowaddress[state] ";
                                                ?>
                                                   
                                                
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Order ID</b></td>
                                                <td>
                                                    <?= $rowOrder['OrderID']?> 
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Delivery Date</b></td>
                                                <td>
                                                    <?= $rowOrder['deliveryDate']?> 
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Delivery Time</b></td>
                                                <td>
                                                     <?= $rowOrder['deliveryTime']?> 
                                            
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Delivery Type</b></td>
                                                <td>
                                                    <?php 
                                                        if($rowOrder['typeOfDelivery'] == 'walkin') echo 'Walk-in';
                                                        else echo 'Deliver';
                                                        ?> 
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Price</b></td>
                                                <td>
                                                    RM 
                                                     <?=
                                                                                                number_format((float)$rowOrder['price'], 2, '.', '');
                                                                                                
                                                                                            
                                                                                            ?> 
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="update-order">
                                            <form action="update-order.php" method="POST">
                                                <input type="hidden" name="OrderID" value="<?= $OrderID ?>">
                                                <div class="hide-if-updated" style="display: <?= $rowOrder['deliveredTime'] == null ? 'block' : 'none' ?>;">
                                                    <br />
                                                    Estimated delivery time
                                                    <br />
                                                    <div class="update-time-row">
                                                        <input
                                                            type="time"
                                                            name="deliveredTime"
                                                            style="
                                                                width: 65%;
                                                                height: 2.5rem;
                                                                border-radius: 5px;
                                                                border: 1px solid
                                                                    black;
                                                                text-align: center;
                                                            "
                                                            value=""
                                                        />
                                                        <input
                                                            type="submit"
                                                            value="Update"
                                                            class="update-time"
                                                            name="updateTime"
                                                        />
                                                    </div>
                                                </div>
                                                <br />
                                                <input
                                                    type="text"
                                                    name=""
                                                    id=""
                                                    style="
                                                        width: 98%;
                                                        height: 3rem;
                                                    "
                                                    placeholder="Drop any message to your customer"
                                                />
                                                <br />
                                                <br />
                                                <div class="hide-if-completed-or-canceled" style="display:  <?= !($rowOrder['status'] == 'COMPLETED' || $rowOrder['status'] == 'CANCELLED') ? 'block' : 'none' ?>;">
                                                    <div class="update-button-row" >
                                                        <input
                                                            type="submit"
                                                            value="Cancel"
                                                            class="update-order-button cancel"
                                                            name="cancelOrder"
                                                        />
                                                        <input
                                                            type="submit"
                                                            class="update-order-button"
                                                            value="Complete"
                                                            name="completeOrder"
                                                        />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                            
                                    <div class="file-details">
                                        <div class="file-information">
                                            <div class="file-row">
                                                File name:
                                                <b><?= $rowFile['filename'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Color: <b><?= $rowOrder['color'] == 'BW' ? 'Black & White' : 'Color' ?></b>
                                            </div>
                                            <div class="file-row">
                                                Printing side: <b><?= $rowOrder['side'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Page per sheet:
                                                <b><?= $rowOrder['pagepersheet'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Printing layout:
                                                <b><?= $rowOrder['layout'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Paper size: <b><?= $rowOrder['paperSize'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Copies: <b><?= $rowOrder['copies'] ?></b>
                                            </div>
                                            <div class="file-row">
                                                Number of pages: <b><?= $rowFile['totalPage'] ?></b>
                                            </div>
                                        </div>
                                        <div class="print-menu">
                                            <div class="print-menu-row">
                                                <img
                                                    src="../images/printer-logo.png"
                                                    alt="printer-logo"
                                                    srcset=""
                                                />
                                                <h3>Auto-Print</h3>
                                            </div>
                                            <br />
                                            <button
                                                class="print-menu-button"
                                            >
                                                Print (B&amp;W)</button
                                            ><br />
                                            <button
                                                class="print-menu-button"
                                            >
                                                Print (Color)</button
                                            ><br />
                                            <button
                                                class="print-menu-button"
                                            >
                                                Only Print
                                            </button>
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
1