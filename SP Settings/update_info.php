<?php
    require_once("../config.php");

    session_start();
    $UserID = $_SESSION['UserID'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $phoneNo = $_POST['phoneNo'];
    
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    
    
    $sql = "UPDATE accounts SET email='$email', fullname='$fullname', phoneNo='$phoneNo' WHERE UserID=$UserID";
    mysqli_query($conn, $sql);

    $sql = "UPDATE addresses SET address1='$address1', address2='$address2', state='$state', postcode='$postcode' WHERE UserID=$UserID";
    mysqli_query($conn, $sql);


    //redirect to SP settings page with POST data
    echo "
        <form action='SP settings.php' method='post'>
            <input type='hidden' value='$UserID' name='UserID' />
            <input id='submit' type='submit' style='display: none;' />
        </form>
        <script>document.getElementById('submit').click()</script>
    ";
    
?>