<?php
    $connection = mysqli_connect('localhost', 'Do','123456', 'instagram' );
    if(!$connection){
        echo 'Connect error '. mysqli_connect_error($connection);
    }
?>