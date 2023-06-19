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
                            <tr>
                                <td>AK0011</td>
                                <td>Olivera Nules</td>
                                <td>Walk-in</td>
                                <td>RM2.00</td>
                                <td>12.04.2023</td>
                                <td>12.04.2023</td>
                                <td>
                                    <div class="row">
                                        <div class="status preparing">
                                            Preparing
                                        </div>
                                        <img
                                            src="../images/arrow.png"
                                            alt=""
                                            srcset=""
                                            width="18"
                                            class="arrow"
                                            height="18"
                                        />
                                    </div>
                                </td>
                            </tr>
                            <!--THIS SECTION WILL BE HIDDEN UNTIL USER ONCE TO SEE IT-->
                            <tr class="more-info"></tr>
                        </table>
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