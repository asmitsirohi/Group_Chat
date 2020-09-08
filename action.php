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

    if(isset($_POST['data'])){
        $data = $_POST['data'];

        $query = "SELECT fname FROM users WHERE fname LIKE '%$data%'";
        $data = mysqli_query($conn,$query);
        $total = mysqli_num_rows($data);

        if($total>0){
            while($result = mysqli_fetch_assoc($data)){
                echo "<a href='#' class='list-group-item list-group-item-action'>".$result['fname']."</a>";
            }
        }
        else{
            echo "<p class='list-group-item'>No Records</p>";
        }
    }

    if(isset($_POST['vm'])){
        $participant = $_POST['vm'];
        $grpname = $_POST['vg'];
        
        $query_participant = "SELECT * FROM users WHERE fname='$participant' OR lname='$participant'";
        $data_participant = mysqli_query($conn,$query_participant);
        $result_participant = mysqli_fetch_assoc($data_participant);

        $query_check = "SELECT * FROM groups WHERE grpname='$grpname'";
        $data_check = mysqli_query($conn,$query_check);
        $result_check = mysqli_fetch_assoc($data_check);

        if($result_participant['uid']==$result_check['userid']){
            echo -1;
        }else{
            $query_grp_insert = "INSERT INTO groups(grpname,userid) VALUES('$grpname','$result_participant[uid]')";
            
            $data_grp_insert = mysqli_query($conn,$query_grp_insert);
            
            $total_participant = mysqli_num_rows($data_participant);

            echo 1;
        }    
    }

    if(isset($_POST['new_name'])){
        $new_name = $_POST['new_name'];
        
        $query_ugrp = "SELECT * FROM groups WHERE grpname = '$selected_grp'";
        $data_ugrp = mysqli_query($conn,$query_ugrp);

        while($result_ugrp = mysqli_fetch_assoc($data_ugrp)){
            $query_update = "UPDATE groups SET grpname='$new_name' WHERE id='$result_ugrp[id]'";
            $data_update = mysqli_query($conn,$query_update);
        }
        if($data_update){
            echo 1;
        }

         
    }
    if(isset($_POST['del_member'])){
        $del_member = $_POST['del_member'];

        $query_dgrp = "SELECT * FROM users WHERE fname = '$del_member'";
        $data_dgrp = mysqli_query($conn,$query_dgrp);
        $result_dgrp = mysqli_fetch_assoc($data_dgrp);

        $query_delete = "DELETE FROM groups WHERE userid='$result_dgrp[uid]' AND grpname='$selected_grp'";
        $data_delete = mysqli_query($conn,$query_delete);

        if($data_delete){
            echo 1;            
        }
    }
    // This is for Create Group Button
    if(isset($_POST['cvm'])){
        $participant = $_POST['cvm'];
        $grpname = $_POST['cvg'];
        
        $query_participant = "SELECT * FROM users WHERE fname='$participant' OR lname='$participant'";
        $data_participant = mysqli_query($conn,$query_participant);
        $result_participant = mysqli_fetch_assoc($data_participant);

        $query_check = "SELECT * FROM groups WHERE grpname='$grpname'";
        $data_check = mysqli_query($conn,$query_check);
        $result_check = mysqli_fetch_assoc($data_check);

        if($result_participant['uid']==$result_check['userid']){
            echo -1;
        }else{
            $query_grp_insert = "INSERT INTO groups(grpname,userid) VALUES('$grpname','$result_participant[uid]')";
            
            $data_grp_insert = mysqli_query($conn,$query_grp_insert);
            
            $total_participant = mysqli_num_rows($data_participant);

            $query_grp_insert_self = "INSERT INTO groups(grpname,userid) VALUES('$grpname','$result[uid]')";
            
            $data_grp_insert_self = mysqli_query($conn,$query_grp_insert_self);
            
            $total_participant_self = mysqli_num_rows($data_participant_self);

            echo 1;
        }    
    }

    
    if(isset($_POST['msg'])) {
        $message = $_POST['msg'];

        $query_imsg = "INSERT INTO messages(from_u,to_grpname,msg) VALUES('".$result['uid']."','$selected_grp','$message')";
        $data_imsg = mysqli_query($conn,$query_imsg);
    }


    
        
?>