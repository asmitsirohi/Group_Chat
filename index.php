<?php
    session_start();
    include("connection.php");
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="libs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="libs/jquery-3.4.1.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/popper.min.js"></script>
    <title>Group_chat</title>
</head>
<body>
    <div class="container ">
        
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <br><br><br><br>
                <div class="border">
                    <h1 class="pb-3 pt-3">GROUP CHAT</h1>

                    <p class="sigin pb-3">Sign in</p>

                    <p class="continue pb-3">to continue to Group Chat</p>
                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div class="form-group">
                        <input type="email" name="uname"  placeholder="Username"><br><br>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback">Enter Username</div>
                        </div>     
                        <div class="form-group">
                        <input type="password" name="pass"  placeholder="Password"><br><br>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback">Enter Username</div>
                        &nbsp;&nbsp;&nbsp;
                        <font id="demo"></font>
                        </div>
                        <!-- <div style="text-align: right; padding-right:105px;" class="pb-3">
                            <a href="create_account.php" >Create account</a>
                        <input type="submit" class="btn btn-primary btn btn-outline-light" value="Signin">
                        </div> -->
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-5 pb-2"><a href="create_account.php" >Create account</a></div>
                            <div class="col-sm-1 pb-2"><input type="submit" class="btn btn-primary btn btn-outline-light" value="Signin" name="signin">&nbsp;&nbsp;&nbsp;</div>
                            <div class="col-sm-4"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['signin'])){
        $username = $_POST['uname'];
        $password = $_POST['pass'];
        $enpassword = md5($password);

        $query_check = "SELECT * FROM users WHERE uname='$username' && pass='$enpassword'";
        $data = mysqli_query($conn,$query_check);
        
        if(mysqli_num_rows($data)){
            $_SESSION['username']=$username;
            header("location:loggedin.php");
        }
        else{
            ?>
                <script>
                    document.getElementById('demo').innerHTML="<font color='red'>Invalid Username and Password!!";
                </script>
                <?php

        }
    }    
?>
