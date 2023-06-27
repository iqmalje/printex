<?php
    require_once('../config.php');

    session_start();
    $UserID = $_SESSION['UserID'];

    $sql = "SELECT a.email, a.fullname, a.phoneNo, a.profilePic, ad.address1, ad.address2, ad.state, ad.state, ad.postcode FROM accounts a JOIN addresses ad ON (a.UserID=ad.UserID) WHERE a.UserID=$UserID";
    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>SP Setting</title>
        <link rel="stylesheet" href="Sp settings.css" />
    </head>
    <body>
        <div class="contents">
            <div class="sidebar">
                <div class="sidebar-contents">
                    <img src="../images/printex_logo.png" alt="printex_logo" />
                    <div class="userprofile">
                        <img
                            src="..<?= $row['profilePic']?>"
                            alt="Ellipse%201"
                            style="clip-path: circle();"
                            width="60"
                            height="60"
                        />
                        <p id="fullname"><?= $row['fullname']?></p>
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
                            alt="icon-box"
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
                            alt="icon-clock"
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
                            alt="icon-settings"
                        />
                        <p>Settings</p>
                    </div>
                    <p class="redirect-home" onclick="window.location.href = 'http:/\/localhost/printex/customer-order/customer-order.php'">Return to home</p>
                </div>
            </div>
            <div class="main">
                <div
                    class="description"
                    style="margin-top: 56px; margin-left: 69px; width: 80%"
                >
                    <h1>PrinTEXer Setting</h1>
                    <p style="margin-top: 9px; color: #808080">
                        In the PrinTEXer setting section, you can review and
                        update the information that will be displayed to
                        customers. Additionally, you can manage your service
                        information in this section. If you wish to make any
                        changes, remember to click the save button to ensure the
                        changes are saved in the system.
                    </p>
                </div>
                <div class="info-section">
                    <div class="upper-menu">
                        <ul>
                            <li id="profile-button" class="section new focus">
                                Profile
                            </li>
                            <form action="SP settings - Service.php" method="post">
                                <input type="submit" style="display: none;" id="servicepagesubmit">
                            </form>
                            <li id="service-button" class="section all" onclick="document.getElementById('servicepagesubmit').click()">
                                Service
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
                    <div class="content-section">
                        <div class="userprofile-content">
                            <img
                                src="..<?= $row['profilePic'] ?>"
                                alt="Ellipse%201"
                                width="125"
                                height="125"
                                style="clip-path: circle()"
                            />
                        </div>
                        <div class="table-section">
                            <div class="profileDetail-info">
                                <!-- email -->
                                <div class="detailTitle">
                                    <p>Email</p>
                                </div>
                                <form action="update_info.php" method="POST">
                                    

                                    <input
                                        type="email"
                                        placeholder="Email"
                                        name="email"
                                        class="email"
                                        value="<?= $row['email'] ?>"
                                        required=""
                                    />
                                    <!-- name -->
                                    <div class="profileDetail-title2">
                                        <div class="detailTitle">
                                            <p>Name</p>
                                        </div>
                                        <div class="edit">
                                            <p>Edit</p>
                                        </div>
                                    </div>
                                    <input
                                        type="text"
                                        placeholder="Name"
                                        class="name"
                                        name="fullname"
                                        value="<?= $row['fullname'] ?>"
                                        pattern="[A-Za-z\s]+"
                                        required=""
                                    />
                                    <!-- phone no -->
                                    <div class="profileDetail-title2">
                                        <div class="detailTitle">
                                            <p>Phone Number</p>
                                        </div>
                                        <div class="edit">
                                            <p>Edit</p>
                                        </div>
                                    </div>
                                    <input
                                        type="text"
                                        placeholder="Phone Number"
                                        class="phoneNo"
                                        name="phoneNo"
                                        value="<?= $row['phoneNo'] ?>"
                                        required=""
                                    />
                                    <!-- address -->
                                    <div class="profileDetail-title2">
                                        <div class="detailTitle">
                                            <p>Address</p>
                                        </div>
                                        <div class="edit">
                                            <p>Edit</p>
                                        </div>
                                    </div>
                                    <input
                                        type="text"
                                        placeholder="Address Line 1"
                                        value="<?= $row['address1'] ?>"
                                        name="address1"
                                        class="addressLine1"
                                    />
                                    <input
                                        type="text"
                                        placeholder="Address Line 2 (optional)"
                                        value="<?= $row['address2'] ?>"
                                        name="address2"
                                        class="addressLine2"
                                    />
                                    <div class="addressLine3">
                                        <input
                                            type="text"
                                            placeholder="State"
                                            value="<?= $row['state'] ?>"
                                            name="state"
                                            class="state-input"
                                        />
                                        <input
                                            type="number"
                                            placeholder="Postcode"
                                            value="<?= $row['postcode'] ?>"
                                            name="postcode"
                                            class="postcode-input"
                                        />
                                    </div>
                                    <div class="save">
                                        <input type="submit" class="save-button" value="Save" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
