<?php

//connect to DB

    $conn = mysqli_connect("localhost", "root", "", "PrinTEX");

    if(mysqli_connect_errno())
    {
        echo " Failed to connect " . $conn -> connect_error;
    }
    

?>