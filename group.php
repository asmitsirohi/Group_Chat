<?php
    session_start();
    include("connection.php");
    error_reporting(0);
    $userprofile = $_SESSION['username'];
    if($userprofile == false){
        header("location:index.php");
    }
    
    $selected_grp = $_GET['gn']; 
    
    $query = "SELECT * FROM users WHERE uname='$userprofile'";

    $data = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($data);
    $logo = "assests/"."logo.png";

    $query_grp = "SELECT *FROM groups WHERE userid='$result[uid]'";
    $data_grp = mysqli_query($conn,$query_grp);
    $data_grp1 = mysqli_query($conn,$query_grp);
    $total_grp = mysqli_num_rows($data_grp);
    $result_grp1 = mysqli_fetch_assoc($data_grp1);

    $_SESSION['grpname']=$result_grp1['grpname'];
    $_SESSION['$selected_grp']=$selected_grp;

    $query_grpname = "SELECT *FROM groups WHERE grpname='$selected_grp'";
    $data_grpname = mysqli_query($conn,$query_grpname);
    $total_grpname = mysqli_num_rows($data_grpname);
    // $result_grpname = mysqli_fetch_assoc($data_grpname);

    // $query_user = "SELECT *FROM users WHERE uid='$result_grpname[userid]'";
    // $data_user = mysqli_query($conn,$query_user);
    // $total_user = mysqli_num_rows($data_user);

    $query_msg = "SELECT * FROM messages WHERE to_grpname = '$selected_grp'";
    $data_msg = mysqli_query($conn,$query_msg);
    $total_msg = mysqli_num_rows($data_msg);
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $result['fname']." ".$result['lname'];?></title>
    <link type="text/css" rel="stylesheet" href="libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="libs/emojionearea.min.css">
    <link rel="stylesheet" type="text/css" href="group.css">
    <script src="libs/jquery-3.4.1.min.js"></script>
    <script src="script_dynamic.js"></script>
    <script src="libs/popper.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/emojionearea.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10" id="scrolldiv">
                <br><br><br>
                <div class="border" id="bdr">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="dropdown myclass">
                                <button class="btn dropdown-toggle myclass1" data-toggle="dropdown">
                                    <?php echo "<img src='$logo' height='50' width='50'  style='border-radius: 50%;'></img>"?>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?php echo $logo;?>">View Logo</a>
                                    <button class="dropdown-item btn dropdown-toggle" data-toggle="dropdown">
                                        About
                                    </button>
                                    <div class="dropdown-menu">
                                        <span class="dropdown-item-text">Handicrafted By:-<br>Asmit Sirohi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h1><?php echo "Welcome, ".$result['fname']." ".$result['lname']?></h1>
                        </div>
                        <div class="col-sm-2">
                            <div class="dropdown myclass">
                                <button class="btn dropdown-toggle myclass1" data-toggle="dropdown">
                                    <?php echo "<img src='".$result['profile_pic']."' height='50' width='50'  style='border-radius: 50%;'></img>"?>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?php echo $result['profile_pic'];?>">View Pic</a>
                                    <a href="logout.php" class="dropdown-item">Logout</a>
                                    <button class="dropdown-item" id="clear_chat">Clear Chat</button>
                                    <button class="dropdown-item btn dropdown-toggle" data-toggle="dropdown">
                                        Upload Pic
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="" method="POST" class="dropdown-item myclass3" enctype="multipart/form-data">
                                            <div class="form-group">
                                            <input type="file" name="image" id="">
                                            </div>
                                            <div class="form-group">
                                            <input type="submit" value="Submit" name="submit"  class="btn btn-primary btn btn-outline-light">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <nav class="navbar navbar-expand-md bg-dark navbar-dark flex-column">
                                <span class="navbar-brands" >
                                    <a href="create_group.php" class="nav-link" style=" color:white; font-size:20px; "><b>+Create Group</b></a>
                                </span>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                                    <span class="navbar-toggler-icon"></span>
                                </button>    
                                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                                    <ul class="navbar-nav flex-column">
                                        <?php
                                            if($total_grp!=0){
                                                while($result_grp = mysqli_fetch_assoc($data_grp)){
                                                    echo "<li><a href='group.php?gn=$result_grp[grpname]' class='nav-item' style='color:white; font-size:20px;'>".$result_grp['grpname']."</a></li>";
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="col-sm-9" data-spy="scroll">
                            <div class="dropdown" style="text-align:center;">
                                <button class="btn  btn-info dropdown-toggle myclass4" data-toggle="dropdown" id="1grp_member_btn">
                                    <?php echo $selected_grp; ?>
                                </button>    
                                <div class="dropdown-menu" style="text-align:center;" id="grp_member1">          
                                    <?php
                                        echo "<a href='alter_group.php' class='list-group-item list-group-item-action'><b>Alter_Group</b></a>";
                                        if($total_grpname>0){
                                            while($result_grpname = mysqli_fetch_assoc($data_grpname)){
                                                $query_user = "SELECT *FROM users WHERE uid='$result_grpname[userid]'";
                                                $data_user = mysqli_query($conn,$query_user);
                                                $total_user = mysqli_num_rows($data_user);
                                            
                                            while($result_user = mysqli_fetch_assoc($data_user)){
                                                echo "<a class='list-group-item list-group-item-action'>".$result_user['fname']." ".$result_user['lname']."</a>";
                                            }
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="row">
                                        <div class="col-sm-9" data-spy="scroll" id="txtmsg" style="text-align:left; padding-left:35px"></div>
                                        <br><br>
                                        <div>
                                            <!-- <span>------------------------------------</span> -->
                                            <input type="text" name="msg" id="msg" required>
                                            <!-- <button class="btn dropdown-toggle icon_btn" id="attach" data-toggle="dropdown"><i title="Attach" class="fas fa-link" id="icon"></i></button>
                                            <div class="dropdown-menu">
                                                <form action="file.php" method="POST" class="dropdown-item myclass3" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <input type="file" id="attachment" name="attach">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" id="submit" name="send" class="btn btn-success">Send</button>
                                                    </div>  
                                                    </form>
                                                    </div> -->
                                            
                                            <button class="btn icon_btn" id="send"><i title="Send" class="fas fa-caret-square-right" id="icon"></i></button>
                                </div>                       
                                </div>             
                                        </div>
                            </div>
                                        </div>
                                        <div class="col-sm-3"></div>
                                </div>
                                <!-- input field div for class="fixed-bottom" -->
                                <!-- <div class="fixed-bottom">
                                    <form action="" method="post"> -->
                                        <!-- <div class="form-group"> -->
                                            <!-- <input type="text" name="msg" id="msg" required> -->
                                            <!-- <button class="btn dropdown-toggle icon_btn" id="attach" data-toggle="dropdown"><i title="Attach" class="fas fa-link" id="icon"></i> -->
                                            <!-- <div class="dropdown-menu"> -->
                                                <!-- <form action="" method="POST" class="dropdown-item myclass3" enctype="multipart/form-data"> -->
                                                    <!-- <div class="form-group">
                                                        <input type="file" name="image" id="">
                                                    </div> -->
                                                    <!-- <div class="form-group"> -->
                                                        <!-- <input type="submit" value="Submit" name="submit"  class="btn btn-primary btn btn-outline-light"> -->
                                                    <!-- </div> -->
                                                <!-- </form> -->
                                                    <!-- </div> -->
                                            <!-- </button> -->
                                            <!-- <button class="btn icon_btn" id="send"><i title="Send" class="fas fa-caret-square-right" id="icon"></i></button> -->
                                        <!-- </div> -->
                                    <!-- </form> -->
                                <!-- </div> -->
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</body>
</html>

<?php
     if($_POST["submit"]){
               
    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = "image/".$filename;
    move_uploaded_file($tempname,$folder);
            
    $query = "UPDATE users SET profile_pic='$folder' WHERE uname='$userprofile'";
    
    $data = mysqli_query($conn,$query);
    }   
?>