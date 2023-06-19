<?php

    require_once('../config.php');
    session_start();
    $UserID = $_SESSION['UserID'];

    $OrderID = $_POST['OrderID'];

    $sqlOrder = "SELECT * FROM Orders WHERE OrderID=$OrderID";
    $resultOrder = mysqli_query($conn, $sqlOrder);
    $rowOrder = mysqli_fetch_assoc($resultOrder);

    $sqlUser  = "SELECT UserID, fullname, profilePic, email, phoneNo FROM accounts WHERE UserID=$rowOrder[UserID]";
    $resultUser = mysqli_query($conn, $sqlUser);
    $rowUser = mysqli_fetch_assoc($resultUser);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>New Order Details</title>
        <link rel="stylesheet" href="neworder.css" />
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
                    <h4>
                        In the order details section, you can review and manage
                        all the orders with their details. You can view and edit
                        many information such as IDs of all orders, customers
                        name, order date, price and order status. Access to this
                        area is limited. Only administrators and PrinTEXer can
                        reach. The changes you make will be approved after they
                        are checked.
                    <h4>
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
                            <h4>
                                The page enables PrinTEXer to update the
                                estimated delivery time and order status,
                                facilitating efficient order management and
                                effective customer communication
                            </h4>
                        </div>
                        <div class="main-data">
                            <div class="column">
                                <div class="profile">
                                    <div class="profile-info">
                                        <img
                                            src="../images/profile/13.png"
                                            alt=""
                                            class="profile-image"
                                            srcset=""
                                            style="width: 50px; height: 50px;"

                                        />
                                        <div class="profile-credentials">
                                            <h3><?= $rowUser['fullname'] ?></h3>
                                            
                                                <?=$rowUser['email'] ?>,
                                                <?= $rowUser['phoneNo'] ?>
                                            
                                        </div>
                                    </div>
                                    <button class="back">
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
                                                <td><?= $rowOrder['OrderID']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Delivery Date</b></td>
                                                <td><?= $rowOrder['deliveryDate']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Delivery Time</b></td>
                                                <td><?= $rowOrder['deliveryTime']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Delivery Type</b></td>
                                                <td><?php 
                                                    if($rowOrder['typeOfDelivery'] == 'walkin') echo 'Walk-in';
                                                    else echo 'Deliver';
                                                ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Price</b></td>
                                                <td>RM <?=
                                                    number_format((float)$rowOrder['price'], 2, '.', '');
                                                    
                                                
                                                ?></td>
                                            </tr>
                                        </table>
                                        
                            
                                        
                                    </div>

                                    <div class="column2">
                                        <div class="file-details">
                                            <div class="file-information">
                                                <div class="file-row">
                                                    Color:
                                                    <p><b><?php 
                                                        if($rowOrder['color'] == "BW") echo 'Black & White';
                                                        else echo 'Color'
                                                    ?></b></p>
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
                                                    <p><b>1</b></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row-button">

                                        <form action="update_order_status.php" method="post">
                                            <input type="hidden" name="OrderID" value="<?= $rowOrder['OrderID'] ?>">
                                            <input type="hidden" name="status" id="status" value="">
                                            <input type="submit" value="" style="display: none;" id="submit">
                                        </form>
                                            <button class="cancel"  id="cancel">
                                                Cancel
                                            </button>
                                            <button class="complete" id="complete">
                                                Accept
                                            </button>
                                        </div>
                                        <script>
                                            var acceptbutton = document.getElementById('complete');
                                            var cancelbutton = document.getElementById('cancel');
                                            var submitbutton = document.getElementById('submit');


                                            acceptbutton.onclick = function() {
                                                document.getElementById("status").value = "accepted";
                                                submitbutton.click();
                                            }
                                            cancelbutton.onclick = function() {
                                                document.getElementById("status").value = "rejected";
                                                submitbutton.click();
                                            }

                                            
                                        </script>
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
