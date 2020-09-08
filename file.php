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

    $query = "SELECT * FROM users WHERE uname='$userprofile'";

    $data = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($data);


    if($_POST['send']){
        // $to = $_POST['to'];
        // $attach = $_FILES['attach'];
        // $text = $_POST['text'];
        $filename = $_FILES['attach']['name'];
        $tempname = $_FILES['attach']['tmp_name'];
        $folder = "attachment/".$filename;
        move_uploaded_file($tempname,$folder);
        // $converted = base64_encode($folder_new);

        $query_imsg = "INSERT INTO messages(from_u,to_grpname,msg,attachment) VALUES('".$result['uid']."','$selected_grp','$message','$folder')";
        $data_imsg = mysqli_query($conn,$query_imsg);

    //     $check_query = "SELECT * FROM users WHERE uname='$to'";
    //     $check_data = mysqli_query($conn,$check_query);
    //     $check_result = mysqli_fetch_assoc($check_data);
    //     if($check_result['uname']==$to){
    //         $insert_query = "INSERT INTO messages (from_u,to_r,msg,attachment,attach_name) VALUES ('$result[uid]','$check_result[uid]','$text','$folder_new','$filename_new')";
    //         $insert_data = mysqli_query($conn,$insert_query);
    //         if($insert_data){
    //             echo "<script>alert('Mail Sent')</script>";
    //         }

    //     }
    //     else{
    //        
    
    
    

?>