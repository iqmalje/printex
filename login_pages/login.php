<?php


    require_once('../config.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT UserID from accounts WHERE email='$email' AND password = '$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) < 1)
    {
        echo "<script>alert('No account found with credentials provided');</script>";
        header("LOCATION: http://localhost/printex/login_pages/login.html");
    }
    else
    {
        //POST to customer-order.php with id
        $UserID = mysqli_fetch_assoc($result)['UserID'];
        echo "
            <form action='../customer-order/customer-order.php' method='POST'>
                <input type='hidden' value='$UserID' name='UserID'/>
                <input type='submit' id='submit'/>
            </form>
            <script>document.getElementById('submit').click()</script>
        ";
    }
?>

