<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "group_chat";
    $charset = "utf8mb4";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    
    if(!$conn){
        die("Connection failed because of ".mysqli_connect_error());
    }

?>