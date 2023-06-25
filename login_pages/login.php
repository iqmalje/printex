<?php
    
    
    
    
    session_start();
   
    if(isset($_SESSION['UserID']))
    {
        header("LOCATION: http://localhost/printex/customer-order/customer-order.php");
    }

    
    
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PrinTEX | Log In</title>
        <link rel="stylesheet" href="login.css" />
    </head>
    <body>
        <div class="floating-container">
            <div class="sidebar">
                <img src="../images/sidebar_image.png" alt="sidebar image" />
            </div>

            <div class="signin-section">
                <h1>Welcome to PrinTEX</h1>
                <form action="set_login.php" method="POST">
                    <p>Email</p>
                    <input
                        type="text"
                        placeholder="Email"
                        class="email"
                        name="email"
                        required
                    />
                    <p>Password</p>
                    <input
                        type="password"
                        placeholder="Password"
                        name="password"
                        class="password"
                        required
                    />
                    <p class="forgotpassword">forgot password?</p>
                    <input type="submit" value="Log in" class="login" />
                    <p class="signup" onclick="window.location.href='http:/\/localhost/printex/register_login_pages/register.html'">Don't have an account? <b>SIGN UP</b></p>
                </form>
            </div>
        </div>
    </body>
</html>
