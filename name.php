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
    $bulk = array();
    $query = "SELECT * FROM users";

    $data = mysqli_query($conn,$query);
    // $result = mysqli_fetch_assoc($data);

    while($result = mysqli_fetch_assoc($data)){
        $name = array(
           "nme"=>$result['fname']
        );
        array_push($bulk,$name);
    }
    
    // var_dump(json_encode($bulk));
    echo json_encode($bulk);
                
?>