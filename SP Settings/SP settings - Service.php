<?php

    require_once("../config.php");
    //fetch user id
    session_start();
    $UserID = $_SESSION['UserID'];
    $sql = "SELECT a.profilePic, a.fullname from accounts a where a.UserID=$UserID";
    $sqlPRICE = "SELECT sp.BWprice, sp.colorPrice, sp.directDeliveryFee, sp.sizeAvailable FROM SPInfos sp WHERE sp.UserID=$UserID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);


    $BWPrice = 0.00;
    $colorPrice = 0.00;
    $sizeAvailable = '';
    $directDeliveryFee = 0.00;
    $resultPRICE = mysqli_query($conn, $sqlPRICE);
    if(mysqli_num_rows($resultPRICE) > 0)
    {
        $rowPRICE = mysqli_fetch_assoc($resultPRICE);
        $BWPrice = $rowPRICE['BWprice'];
        $colorPrice = $rowPRICE['colorPrice'];
        $sizeAvailable = $rowPRICE['sizeAvailable'];
        $directDeliveryFee = $rowPRICE['directDeliveryFee'];
        
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SP Setting</title>
        <link rel="stylesheet" href="Sp settings.css">
    </head>
    <body>
        <div class="contents">
            <div class="sidebar">
                <div class="sidebar-contents">
                    <img src="../images/printex_logo.png" alt="printex_logo">
                    <div class="userprofile">
                        <img src="..<?=$row['profilePic'] ?>" alt="Ellipse%201" style="clip-path: circle();" width="60" height="60">
                        <p><?= $row['fullname']?>
                        </p>
                    </div>
                    <hr style="margin-top: 33px; margin-bottom: 10px">
                    <div class="item orderlist" onclick="window.location.href='http:/\/localhost/printex/order_pages/orderpage.php'">
                        <img class="icon" src="../images/icon-box.png" style="width: 30px; height: 30px; margin: 0px; margin-right: 20px;" alt="icon-box">
                        <p>Order list</p>
                    </div>
                    
                    <div class="item history" onclick="window.location.href = 'http:/\/localhost/printex/SP_history/sphistory.php'">
                        <img class="icon" src="../images/icon-clock.png" style="width: 30px; height: 30px; margin: 0px; margin-right: 20px;" alt="icon-clock">
                        <p>History</p>
                    </div>
                    <div class="item settings" onclick="window.location.href='http:/\/localhost/printex/SP%20Settings/SP%20settings.php'">
                        <img class="icon" src="../images/icon-settings.png" style="width: 30px; height: 30px; margin: 0px; margin-right: 20px;" alt="icon-settings">
                        <p>Settings</p>
                    </div>
                    <p class="redirect-home" onclick="window.location.href = 'http:/\/localhost/printex/customer-order/customer-order.php'">Return to home</p>
                </div>
            </div>
            <div class="main">
                <div class="description" style="margin-top: 56px; margin-left: 69px; width: 80%">
                    <h1>PrinTEXer Setting</h1>
                    <p style="margin-top: 9px; color: #808080">In the PrinTEXer setting section, you can review and update the information that will be displayed to customers. Additionally, you can manage your service information in this section. If you wish to make any changes, remember to click the save button to ensure the changes are saved in the system.</p>
                </div>
                <div class="info-section">
                    <div class="upper-menu">
                        <ul>
                            <form action="SP settings.php" method="post">
                                <input type="submit" style="display: none;" id="clickprofile">
                            </form>
                            <li id="profile-button" onclick="document.getElementById('clickprofile').click()" class="section all">Profile</li>
                            <li id="service-button" class="section new focus">Service</li>
                        </ul>
                    </div>
                    <hr style="margin-top: 19px; margin-bottom: 33px; width: 90%;">
                    <div class="Customize-printing">
                        <p style="font-size: 20px;"><b>Customize Printing</b></p>
                    </div>
                    <div class="Customize-printing-desc">
                        Set you own printing price. The system will follow the price below if the customer selected you as the service provider.
                    </div>
                    <form action="create_sp.php" method="post">
                        <div class="print-categories">
                            <div class="printing-setting">
                                Black & White Pricing (per sheet)
                            </div>
                            <input type="number" value="<?= $BWPrice ?>" placeholder="0.00" class="input-number" min="0" id='BWPRICE' step="0.1" name="BWPrice" onchange="formatter('BWPRICE')" required>
                        </div>
                        <div class="print-categories">
                            <div class="printing-setting">
                                Color Pricing (per sheet)
                            </div>
                            <input type="number" value="<?= $colorPrice ?>" placeholder="0.00" class="input-number" step="0.10" min="0" id='COLORPRICE' name="ColorPrice" onchange="formatter('COLORPRICE')" required>
                        </div>
                        <div class="print-categories">
                            <div class="printing-setting">
                                Printout Paper Size Available
                            </div>
                            <input type="text" value="<?= $sizeAvailable ?>" placeholder="A4" class="input-number" min="0" name="PaperSize" required>
                        </div>
                        <div class="print-categories">
                            <div class="printing-setting">
                                Direct Delivery Fee
                            </div>
                            <input type="number" value="<?= $directDeliveryFee ?>" placeholder="0.00" class="input-number" step="0.10"min="0" id='DELIVERYFEE' name="DeliveryFee" onchange="formatter('DELIVERYFEE')" required>
                        </div>
                        <div class="save-service">
                            <div class="print-categories">
                                <div class="printing-setting"></div>
                            </div>
                            <input type="submit" value="Save" class="save-button">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="SPSettings.js"></script>
    </body>
</html>