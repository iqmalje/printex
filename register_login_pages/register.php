<?php

    require_once('../config.php');

    
    $fullname = $_POST['fullname'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    
    //register into accounts
    $sql = "INSERT INTO accounts(email, fullname, phoneNo, password) VALUES ('$email', '$fullname', '$phonenumber', '$password')";

    if(!(array_key_exists('profilepic', $_FILES)))
    {  
        echo 'no file';
    }
    else
    {
        if(mysqli_query($conn, $sql))
        {
            $last_id = mysqli_insert_id($conn);
    
    
            //set up profilepic
            $array = explode('.', $_FILES['profilepic']['name']);
            $extension = end($array);
            $filename = $_FILES['profilepic']['name'];
            $temp = $_FILES['profilepic']['tmp_name'];
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . "images/$last_id" . $extension;
            move_uploaded_file($temp, $target_path);
        
            $sql = "UPDATE accounts SET profilepic=$target_path WHERE UserID=$last_id";
            mysqli_query($conn, $sql);
    
            //set up address
            $sql = "INSERT INTO addresses(UserID, address1, address2, state, postcode) VALUES($last_id, '$address1', '$address2', '$state', '$postcode')";
            mysqli_query($conn, $sql);
    
            echo "Succesfully registered!";
        }
    }

    
?>