<?php


    require_once('../config.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT UserID from accounts WHERE email='$email' AND password = '$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) < 1)
    {
        echo "<script>alert('No account found with credentials provided');</script>";
        header("LOCATION: http://localhost/printex/login_pages/login.php");
    }
    else
    {
        //POST to customer-order.php with id
        $UserID = mysqli_fetch_assoc($result)['UserID'];

        
        // this will set the cookie expiration in 7 days

        setcookie("UserID", $UserID, strtotime("+7 days"), '/');
        
        session_start();


        $_SESSION['UserID'] = $UserID;
        

        
        
        header("LOCATION: http://localhost/printex/customer-order/customer-order.php");
    }
?>

