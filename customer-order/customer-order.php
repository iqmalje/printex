<?php

    session_start();

    $UserID = $_SESSION['UserID'];
    //FETCH ASSOCIATE ACCOUNT

    require_once("../config.php");
    $sql = "SELECT * FROM accounts where UserID=$UserID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['SPID'])){
        echo 'ADA';
    }



  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PrinTEX | Order</title>
        <link rel="stylesheet" href="customer-order.css" />
        <script src="customer-order.js"></script>
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
                            onclick="showDropdown()"
                        />
                        <div class="dropdownmenu" id="dropdownmenu">
                            <a onclick="openSettingsPage()">Settings</a>
                            <a onclick="window.location.href='http:/\/localhost/printex/session_destroy.php'"href="#">Log out</a>
                        </div>
                        <form action="../SP Settings/SP settings.php" method="POST"> <!-- SEND TO SETTINGS PAGE -->
                            <input type="submit" id="settingsubmit" style="display: none;"/>
                        </form>
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
                    <button type="button" class="uploadfile" id='uploadfile' onclick="selectFile()">
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
                            onkeyup="setCopies(this)"
                        />
                    </div>

                    <div class="order-papersize">
                        <h2>Paper size *</h2>
                        <input
                            type="text"
                            placeholder="A4"
                            id="text-papersize"
                            class="order-papersize-input"
                            onkeyup="setPaperSize(this)"
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

                
            </div>

            <div class="column-order2">
                <div class="column-order2-suborder1">
                    <div class="headerdelivery">
                        <h1>Delivery info</h1>
                        <p class="editSP">Edit</p>
                    </div>

                    <?php
                        if(isset($_POST['SPID']))
                        {
                            $SPID = $_POST['SPID'];
                            $sqlSPID = "SELECT ac.profilePic, ac.phoneNo, ac.fullname FROM accounts ac JOIN SPInfos sp ON (ac.UserID=sp.UserID) WHERE sp.SPID=$SPID";
                            $resultSPID = mysqli_query($conn, $sqlSPID);
                            $rowSPID = mysqli_fetch_assoc($resultSPID);
                            echo "<div class='SPInfo' style='display: flex; flex-direction: column; justify-content: center;'>
                            <div class='row-SPinfo'>
                                <img
                                    src='..$rowSPID[profilePic]'
                                    width='50'
                                    style='clip-path:circle()'
                                    alt='SP profile'
                                />
                                <div class='column-SPinfo'>
                                    <p class='SPname'>
                                        $rowSPID[fullname]
                                    </p>
                                    <p class='SPphone'>$rowSPID[phoneNo]</p>
                                </div>
                            </div>
                            <table class='table-deliveryinfo'>
                                <tr>
                                    <td class='type-deliveryinfo'>Type</td>
                                    <td class='content-deliveryinfo'>Walk-in</td>
                                </tr>
                                <tr>
                                    <td class='type-deliveryinfo'>Date</td>
                                    <td class='content-deliveryinfo'>13/6/2023</td>
                                </tr>
                                <tr>
                                    <td class='type-deliveryinfo'>Time</td>
                                    <td class='content-deliveryinfo'>9.00 pm</td>
                                </tr>
                                <tr>
                                    <td class='type-deliveryinfo'>Location</td>
                                    <td class='content-deliveryinfo'>
                                        MA1, KTDI, UTM, 813100 Skudai, Johor
                                    </td>
                                </tr>
                            </table>
                        </div>";
                        }
                        else {
                            echo "
                            <div class='chooseSP'>
                        <form action='../SPlist_pages/SPlist-order.php' method='post'>
                            <input type='hidden' name='UserID' value='<?= $UserID ?>'>
                            <input type='submit' value='' id='chooseSP'>
                        </form>
                        <button type='button' class='deliveryinfobtn' onclick='redirectToSPLIST()'>
                            Click here to choose a PrinTEXer to perform your order
                        </button>
                    </div>
                            ";
                        }
                    ?>

                    

                    
                </div>

                <div class="column-order2-suborder2">
                    <h1>Order details</h1>
                    <div class="container-orderdetails">
                        <table class="table-orderdetails">
                            <tr>
                                <td class="title-order">File name:</td>
                                <td class="details-order" id="filename">
                                </td>
                            </tr>
                            <tr>
                                <td class="title-order">Printing color:</td>
                                <td class="details-order" id="filecolor"></td>
                            </tr>
                            <tr>
                                <td class="title-order">Printing side:</td>
                                <td class="details-order" id="fileside"></td>
                            </tr>
                            <tr>
                                <td class="title-order">Pages per sheet:</td>
                                <td class="details-order" id="filepagepersheet"></td>
                            </tr>
                            <tr>
                                <td class="title-order">Printing layout:</td>
                                <td class="details-order" id="filelayout"></td>
                            </tr>
                            <tr>
                                <td class="title-order">Copies:</td>
                                <td class="details-order" id="filecopies"></td>
                            </tr>
                            <tr>
                                <td class="title-order">Paper size</td>
                                <td class="details-order" id="filesize"></td>
                            </tr>
                        </table>
                    </div>

                    <table class="table-calculateorder">
                        <tr style="height: 50px">
                            <td class="tagorder">Total pages</td>
                            <td class="box-totalpages" id="totalpages">0</td>
                            <td class="timessign">X</td>
                            <td class="tagorder">Price per page</td>
                            <td class="box-pricepersheet">0.10</td>
                            <td class="equalsign">=</td>
                            <td class="totalprice" id="totalprice">0.00</td>
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
                        <h1 id="totalpricefee">RM0.20</h1>
                    </div>
                </div>

                <div class="checkoutsection">
                    <button type="button" class="checkout-order" onclick="submit()">
                        Checkout
                    </button>
                </div>
            </div>
        </div>

        <!--
            THIS SECTION IS USED FOR SENDING TO CREATE_ORDER.php

        -->

        <form action="create_order.php" method="post" enctype="multipart/form-data">
            <input type="file" style="display: none;" id="selectedfile" name="selectedfile" accept="application/pdf" onchange="setFileDetails(this)" />
            <input type="hidden" id="selectcolor" name="color" />
            <input type="hidden" id="selectside" name="side" />
            <input type="hidden" id="selectpagepersheet" name="pagepersheet" />
            <input type="hidden" id="selectlayout" name="layout" />
            <input type="hidden" id="selectcopies" name="copies" />
            <input type="hidden" id="selectsize" name="size" />
            <input type="submit" style="display:none;" id="submit">
            

            
        </form>
        
    </body>
</html>
