<?php


    $file = $_FILES['selectedfile']['name'];

    echo $file . ' ';
    foreach( $_POST as $stuff ) {
        if( is_array( $stuff ) ) {
            foreach( $stuff as $thing ) {
                echo $thing . ' ';
            }
        } else {
            echo $stuff . ' ';
        }
    }
?>