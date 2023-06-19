<?php
    require_once("../config.php");
    session_start();
    $UserID = $_SESSION['UserID'];
    $sql = "SELECT SPID FROM SPInfos WHERE UserID=$UserID";

    $BWPrice = $_POST['BWPrice'];
    $colorPrice = $_POST['ColorPrice'];
    $directDeliveryPrice = $_POST['DeliveryFee'];
    $sizeAvailable = $_POST['PaperSize'];
    

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        //SP already existed, thus we only need to update
        $sql = "UPDATE SPInfos SET BWPrice=$BWPrice, colorPrice=$colorPrice, directDeliveryFee=$directDeliveryPrice, sizeAvailable='$sizeAvailable' WHERE UserID=$UserID";
        mysqli_query($conn, $sql);

        echo "UPDATED";
    }
    else {
        //SP did not existed yet, thus we need to insert
        $sql = "INSERT INTO SPInfos(UserID, BWPrice, colorPrice, directDeliveryFee, sizeAvailable) VALUES($UserID, $BWPrice, $colorPrice, $directDeliveryPrice, '$sizeAvailable')";
        echo "INSERTED";
        mysqli_query($conn, $sql);
    }

    //redirect to previous page
    echo "
        <form action='SP settings - Service.php' method='post'>
            <input type='hidden' value='$UserID' name='UserID' />
            <input id='submit' type='submit' style='display: none;' />
        </form>
        <script>document.getElementById('submit').click()</script>
    ";
?>