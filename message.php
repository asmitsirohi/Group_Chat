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
    $query = "SELECT * FROM users WHERE uname='$userprofile'";

    $data = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($data);


        $query_msg = "SELECT * FROM messages WHERE to_grpname = '$selected_grp'";
            $data_msg = mysqli_query($conn,$query_msg);
            $total_msg = mysqli_num_rows($data_msg);
        
            
            if($total_msg>0){
                while($result_msg = mysqli_fetch_assoc($data_msg)){
                    if($result['uid']==$result_msg['from_u']){
                        $msg1 = array(
                             "You"=>$result_msg['msg']
                        );
                        array_push($bulk,$msg1);
                    }else{
                            $query_user1 = "SELECT *FROM users WHERE uid='$result_msg[from_u]'";
                            $data_user1 = mysqli_query($conn,$query_user1);
                            $result_user1 = mysqli_fetch_assoc($data_user1);
                            $msg2 = array(
                                $result_user1['fname']=>$result_msg['msg']
                            );
                            array_push($bulk,$msg2);
                           
                    }
                }
                // var_dump(json_encode($bulk));
                echo json_encode($bulk);
            }
                
?>