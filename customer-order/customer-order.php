<?php
    $UserID = $_POST['UserID'];
    //FETCH ASSOCIATE ACCOUNT

    require_once("../config.php");
    $sql = "SELECT * FROM accounts where UserID=$UserID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PrinTEX | Order</title>
        <link rel="stylesheet" href="customer-order.css" />
    </head>
    <body>
        <div class="navitem">
            <a href="index.html"
                ><img src="../images/logo.png" alt="PrinTEX_logo" class="logo"
            /></a>
            <nav>
                <ul>
                    <li>
                        <button type="becomePrinTEXer" class="becomePrinTEXer">
                            Become PrinTEXer
                        </button>
                    </li>
                    <li>
                        <img
                            src="..<?= $row['profilePic'] ?>"
                            alt="Profile_icon"
                            class="profilepic"
                            style="width: 50px; cursor: pointer; clip-path: circle(); height: 100%;"
                        />
                    </li>
                </ul>
            </nav>
        </div>

        <hr />

        <div class="grid-container">
            <div class="grid-item a1 selected">
                <div class="content">
                    <img
                        src="../images/grid-order.png"
                        alt="Icon_order"
                        class="grid-icon"
                    />
                    <p class="grid-text">Order</p>
                </div>
            </div>
            <div class="grid-item a2">
                <div class="content">
                    <img
                        src="../images/grid-tracking.png"
                        alt="Icon_tracking"
                        class="grid-icon"
                    />
                    <p class="grid-text">Tracking</p>
                </div>
            </div>
            <div class="grid-item a3">
                <div class="content">
                    <img
                        src="../images/grid-history.png"
                        alt="Icon_history"
                        class="grid-icon"
                    />
                    <p class="grid-text">History</p>
                </div>
            </div>
        </div>

        <div>
            <hr />
        </div>

        <div class="column-sectioninfo">
            <div class="row-sectioninfo">
                <img
                    src="../images/section-icon.png"
                    alt="Section_icon"
                    class="info-icon"
                />
                <p class="section-text">
                    You can choose from the available printing options below,
                    which include selecting the printing color, side, pages per
                    sheet, layout, copies, and paper size. Once you have made
                    your selections, you can click on the delivery information
                    to choose a PrinTEXer to handle your order. After that, you
                    can proceed to checkout and finalize your order.
                </p>
            </div>
        </div>

        <div class="row-order">
            <div class="column-order1">
                <div class="inner-column-order1">
                    <button type="button" class="uploadfile">
                        Click here to upload PDF file
                    </button>

                    <h1>Select the printing options</h1>

                    <h2>Printing color *</h2>
                    <div class="grid-container-order">
                        <div
                            class="grid-order a1"
                            id="BW"
                            onclick="setPrintingColor('BW')"
                        >
                            Black & <br />White
                        </div>
                        <div
                            class="grid-order a2"
                            id="color"
                            onclick="setPrintingColor('color')"
                        >
                            Color
                        </div>
                    </div>

                    <h2>Printing side *</h2>
                    <div class="grid-container-order">
                        <div
                            class="grid-order b1"
                            id="single"
                            onclick="setPrintingSide('single')"
                        >
                            Single
                        </div>
                        <div
                            class="grid-order b2"
                            id="duplex"
                            onclick="setPrintingSide('duplex')"
                        >
                            Duplex
                        </div>
                    </div>

                    <h2>Pages per sheet *</h2>
                    <div class="grid-container-order">
                        <div
                            class="grid-order c1"
                            id="1in1"
                            onclick="setPagePerSheet('1 in 1')"
                        >
                            1 in 1
                        </div>
                        <div
                            class="grid-order c2"
                            id="2in1"
                            onclick="setPagePerSheet('2 in 1')"
                        >
                            2 in 1
                        </div>
                        <div
                            class="grid-order c3"
                            id="4in1"
                            onclick="setPagePerSheet('4 in 1')"
                        >
                            4 in 1
                        </div>
                        <div
                            class="grid-order c4"
                            id="6in1"
                            onclick="setPagePerSheet('6 in 1')"
                        >
                            6 in 1
                        </div>
                    </div>

                    <h2>Printing layout *</h2>
                    <div class="grid-container-order">
                        <div
                            class="grid-order d1"
                            id="portrait"
                            onclick="setPrintingLayout('portrait')"
                        >
                            Portrait
                        </div>
                        <div
                            class="grid-order d2"
                            id="landscape"
                            onclick="setPrintingLayout('landscape')"
                        >
                            Landscape
                        </div>
                    </div>

                    <div class="order-copies">
                        <h2>Copies *</h2>
                        <input
                            type="text"
                            id="text-copies"
                            placeholder="1"
                            class="order-copies-input"
                        />
                    </div>

                    <div class="order-papersize">
                        <h2>Paper size *</h2>
                        <input
                            type="text"
                            placeholder="A4"
                            id="text-papersize"
                            class="order-papersize-input"
                        />
                    </div>

                    <h2>Remarks (optional)</h2>
                    <div class="remark">
                        <textarea
                            onkeyup="setRemarks(this)"
                            name=""
                            class="remark-textarea"
                            placeholder="Left some reminder to your PrinTEXer about your order"
                        ></textarea>
                    </div>
                </div>

                <button type="button" onclick="submit()" class="done-order">
                    Done
                </button>
            </div>

            <div class="column-order2">
                <div class="column-order2-suborder1">
                    <div class="headerdelivery">
                        <h1>Delivery info</h1>
                        <p class="editSP">Edit</p>
                    </div>

                    <div class="row-SPinfo">
                        <img
                            src="../images/profile/Ellipse 1.png"
                            alt="SP profile"
                        />
                        <div class="column-SPinfo">
                            <p class="SPname">
                                Fikri Akmal Aizuddin Bin Bahrim
                            </p>
                            <p class="SPphone">013 752 6538</p>
                        </div>
                    </div>

                    <table class="table-deliveryinfo">
                        <tr>
                            <td class="type-deliveryinfo">Type</td>
                            <td class="content-deliveryinfo">Walk-in</td>
                        </tr>
                        <tr>
                            <td class="type-deliveryinfo">Date</td>
                            <td class="content-deliveryinfo">13/6/2023</td>
                        </tr>
                        <tr>
                            <td class="type-deliveryinfo">Time</td>
                            <td class="content-deliveryinfo">9.00 pm</td>
                        </tr>
                        <tr>
                            <td class="type-deliveryinfo">Location</td>
                            <td class="content-deliveryinfo">
                                MA1, KTDI, UTM, 813100 Skudai, Johor
                            </td>
                        </tr>
                    </table>

                    <button type="button" class="deliveryinfobtn">
                        Click here to choose a PrinTEXer to perform your order
                    </button>
                </div>

                <div class="column-order2-suborder2">
                    <h1>Order details</h1>
                    <div class="container-orderdetails">
                        <table class="table-orderdetails">
                            <tr>
                                <td class="title-order">File name:</td>
                                <td class="details-order">
                                    Team 3 - P2 Requirements Model Template.pdf
                                </td>
                            </tr>
                            <tr>
                                <td class="title-order">Printing color:</td>
                                <td class="details-order">Black & White</td>
                            </tr>
                            <tr>
                                <td class="title-order">Printing side:</td>
                                <td class="details-order">Single</td>
                            </tr>
                            <tr>
                                <td class="title-order">Pages per sheet:</td>
                                <td class="details-order">1 in 1</td>
                            </tr>
                            <tr>
                                <td class="title-order">Printing layout:</td>
                                <td class="details-order">Portrait</td>
                            </tr>
                            <tr>
                                <td class="title-order">Copies:</td>
                                <td class="details-order">x 1</td>
                            </tr>
                            <tr>
                                <td class="title-order">Paper size</td>
                                <td class="details-order">A4</td>
                            </tr>
                        </table>
                    </div>

                    <table class="table-calculateorder">
                        <tr style="height: 50px">
                            <td class="tagorder">Total pages</td>
                            <td class="box-totalpages">21</td>
                            <td class="timessign">X</td>
                            <td class="tagorder">Price per page</td>
                            <td class="box-pricepersheet">0.10</td>
                            <td class="equalsign">=</td>
                            <td class="totalprice">2.10</td>
                        </tr>
                        <tr style="height: 10px"></tr>
                        <tr style="height: 50px">
                            <td
                                colspan="6"
                                style="text-align: right; padding-right: 3%"
                            >
                                <p class="tagorder">Service Fee (RM)</p>
                            </td>
                            <td class="box-pricepersheet">0.20</td>
                        </tr>
                    </table>
                    <hr />
                    <div class="row-totalprice">
                        <h1>Total Price</h1>
                        <h1>RM2.30</h1>
                    </div>
                </div>

                <div class="checkoutsection">
                    <button type="button" class="checkout-order">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
        <script src="customer-order.js"></script>
    </body>
</html>
