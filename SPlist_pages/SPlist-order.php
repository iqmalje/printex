<?php
    require_once('../config.php');

    session_start();
    $UserID = $_SESSION['UserID'];
    $sql = "SELECT ac.profilePic, ad.address1, ad.address2, ad.state, ad.postcode FROM accounts ac JOIN addresses ad ON (ac.UserID=ad.UserID) WHERE ac.UserID=$UserID";

    $resultProfile = mysqli_query($conn, $sql);
    $rowProfile = mysqli_fetch_assoc($resultProfile);
    
    $sql = "SELECT sp.SPID, ac.profilePic, ac.fullname, sp.BWprice, sp.colorPrice FROM accounts ac JOIN SPInfos sp ON (ac.UserID=sp.UserID)";
    $resultSPs = mysqli_query($conn, $sql);
    $selectedSPID = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrinTEX | Order </title>
    <link rel="stylesheet" href="SPlist-order.css" />

</head>
<body>

    <form action="../customer-order/customer-order.php" method="post">
        <input type="hidden" id="selectedSP" name="SPID" value="">
        <input type="hidden" id="typeOfDelivery" name="typeOfDelivery" />
        <input type="submit" style="display:none;" id="submit" value="<?= $selectedSPID ?>">
        
    
    <div class="navitem">
        <a href="index.html"><img src="../images/logo.png" alt="PrinTEX_logo" class="logo"></a>
        <nav>
            <ul>
                <li><button type="becomePrinTEXer" class="becomePrinTEXer">Become PrinTEXer</button></li>
                <li><img src="../images/profile.png" alt="Profile_icon" class="profile"></li>
            </ul>
        </nav>
    </div>

    <hr>

    <div class="row-backbtn">
        <button type="button" class="backbtn">Back To Order</button>
    </div>

    <h1>Please Complete Delivery Info</h1>
    <script src="SPlist.js"></script>
    <div class="column-deliveryinfo">
        <div class="box-deliveryinfo">
            <p class="deliverytypetext">Type of Delivery</p>
            <div class="deliverytypebtn">
                <button type="button" id="walkin"  onclick="selectTypeOfDelivery('walkin')"class="walkinbtn">Walk-in</button>
                <button type="button" id="deliver" onclick="selectTypeOfDelivery('deliver')" class="deliverbtn">Deliver</button>
            </div>
        </div>

        <div class="box-deliverydate">
            <p class="deliverytypetext">Date of Delivery</p>
            <input type="date" class="dateselect" name="deliveryDate">
        </div>

        <div class="box-deliverytime">
            <p class="deliverytypetext">Time of Delivery</p>
            <input type="time" class="timeselect" name="deliveryTime">
        </div>
        </form>
        <div class="box-deliverylocation">
            <p class="deliverytypetext">Location</p>
            <textarea readonly class="locationtext" placeholder="Address"><?= $rowProfile['address1'] . ' ' . $rowProfile['address2'] . ' ' . $rowProfile['postcode'] . ' ' . $rowProfile['state'] ?></textarea>
        </div>

    </div>

    <h1>List of Available PrinTEXers  </h1>

    <div class="column-availableSP">
        <table class="table-availableSP">



           
            <tr style="height: 80px;">
                <td colspan="2" style="width: 33%;"><b>Name</b></td>
                <td><b>Rating</b></td>
                <td><b>Distance</b></td>
                <td><b>Type of <br>Delivery</b></td>
                <td><b>Pricing</b></td>
                <td style="width: 10%;"><b>Status</b></td>
            </tr>

            <?php
                while($rowSPs = mysqli_fetch_assoc($resultSPs))
                {
                    $bwprice = number_format((float)$rowSPs['BWprice'], 2, '.', '');
                    $colorprice = number_format((float)$rowSPs['colorPrice'], 2, '.', '');
                    echo "<tr style='height: 80px;'>
                    <td><img src='..$rowSPs[profilePic]' alt='SP profile' style='width: 50px;clip-path: circle()'></td>
                    <td class='tablename'>$rowSPs[fullname]</td>
                    <td>3 star</td>
                    <td>200m</td>
                    <td>Deliver & <br> Walk-in</td>
                    <td>B&W = $bwprice/page <br> Color = $colorprice/page</td>
                    <td>Online</td>
                    <td class='selectbtnarea'><button onclick='selectSP($rowSPs[SPID])' type='button' class='selectbtn' >Select</button></td>
                </tr>";
                }
            ?>

            
        </table>


    </div>

    
    
</body>
</html>