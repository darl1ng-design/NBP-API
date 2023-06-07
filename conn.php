<?php
    $password = '';
    $username = 'root';
    $db = 'kursy';
    $server = 'localhost';

    //creating connection to the localhost database
    $conn = new mysqli($server, $username, $password, $db);

    if($conn->connect_errno){
        echo("failed while trying to connect to db" . $conn->connect_error);
        exit();
    }

?>