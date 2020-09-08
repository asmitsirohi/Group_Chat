<?php
    session_start();
    include("connection.php");
    error_reporting(0);
    $grpname = $_SESSION['grpname'];
    $selected_grp = $_SESSION['$selected_grp'];
    $userprofile = $_SESSION['username'];
    if($userprofile == false){
        header("location:index.php");
    }

    $query = "DELETE FROM messages WHERE to_grpname = '$selected_grp'";
    $data = mysqli_query($conn,$query);

    if($data){
        echo 1;
    }else{
        echo -1;
    }
?>