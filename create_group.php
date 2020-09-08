<?php
    session_start();
    include("connection.php");
    // error_reporting(0);
    $userprofile = $_SESSION['username'];
    if($userprofile == false){
        header("location:index.php");
    }
    
    $query = "SELECT * FROM users WHERE uname='$userprofile'";

    $data = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($data);
    $logo = "assests/"."logo.png";

    $query_grp = "SELECT *FROM groups WHERE userid='$result[uid]'";
    $data_grp = mysqli_query($conn,$query_grp);
    $total_grp = mysqli_num_rows($data_grp);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $result['fname']." ".$result['lname'];?></title>
    <link type="text/css" rel="stylesheet" href="libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/emojionearea.min.css">
    <link rel="stylesheet" type="text/css" href="loggedin.css">
    <script src="libs/jquery-3.4.1.min.js"></script>
    <script src="script.js"></script>
    <script src="libs/popper.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/emojionearea.min.js"></script>
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <br><br><br>
                <div class="border">
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
                                <span class="navbar-brands" style=" color:white; font-size:20px; ">
                                    <b>Recent Groups:</b>
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
                        <div class="col-sm-9 pb-3">
                            <h3 class="pb-5">Create New Group</h3>
                            <!-- <form action="" method="post"> -->
                                <div class="from-group pb-3">
                                    <label id="grp">Group Name:</label>&nbsp;
                                    <input type="text" name="grpname" required id="grpname" >
                                </div>
                                <div class="from-group pb-5">
                                    <label id="grp">Add Member:</label>&nbsp;
                                    <input type="text" name="participant" autocomplete="off" placeholder="Name" required id="member" class="dropdown toggle" data-toggle="dropdown">
                                    <div class="dropdown-menu" id="show-member">
                                            
                                    </div>
                                    <!-- <span id="msg" ></span> -->
                                </div>
                                
                                    <div class="row">
                                    <!-- <div class="col-sm-2"></div> -->
                                    <div class="col-sm-6 pb-2"><input type="submit" class="btn btn-primary btn btn-outline-light" value="Add more Members" name="participants" id="participants">&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-sm-6 pb-2"><input type="submit" class="btn btn-primary btn btn-outline-light" value="Create Group" name="create_group" id="create_grp">&nbsp;&nbsp;&nbsp;</div>
                                    <!-- <div class="col-sm-4"></div> -->
                                 </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</body>
</html>


