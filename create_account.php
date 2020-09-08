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
    <link rel="stylesheet" type="text/css" href="create_ac.css">
    <script src="libs/jquery-3.4.1.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/popper.min.js"></script>
    <title>Create Account</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <br><br><br>
                <div class="border">
                    <div class="row">
                        <div class="cols-lg-9">
                            <h1 class="pb-3 pt-3">GROUP CHAT</h1>

                            <p class="p1st pb-3">Create Your Group Chat Account</p>
                            <p class="continue pb-3">to continue to Group Chat</p>

                            <form action="" method="post" >
                                <div class="row">
                                    <div class="col-sm-4">
                                    <input type="text" name="fname" placeholder="First name" required>
                                    </div>
                                    <div class="col-sm-4">
                                    <input type="text" name="lname" placeholder="Last name" required><br><br>
                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="uname"  placeholder="Username   eg:abc@email.com" required>
                                    <div class="valid-feedback">Valid</div>
                                    <div class="invalid-feedback">Enter Username</div>
                                </div>  

                                <p class="p2nd pb-2" id="p3rd">You can use letters, numbers & periods </p>
                                <div class="form-group">
                                    <input type="password" name="pass"  placeholder="Password" required>
                                    <div class="valid-feedback">Valid</div>
                                    <div class="invalid-feedback">Enter Username</div>
                                </div>
                                    <p class="p2nd pb-2">Use 8 or more characters with a mix of letters, numbers & symbols</p>
                                    <div class="row">
                    
                                        <div class="col-sm-5"><a href="index.php" >Sign in instead</a></div>
                                        <div class="col-sm-4"><input type="submit" class="btn btn-primary btn btn-outline-light" value="Next" name="create_account">&nbsp;&nbsp;&nbsp;</div>
                                        <div class="col-sm-2"></div>
                                    </div>
                            </form>


                        </div>
                        <div class="col lg-3 ">
                            <a href="assests/logo.png"><img src="assests/logo.png" alt="image" class="img-fluid rounded "></img></a>
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
    if($_POST['create_account']){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['uname'];
        $password = $_POST['pass'];
        $folder = "assests/"."1.jpg";
        $enpassword = md5($password);

        $check_query = "SELECT * FROM users WHERE uname='$username'";
        $check_data = mysqli_query($conn,$check_query);
        $result =  mysqli_fetch_assoc($check_data);
        if($result){
            if($result['uname']==$username){
                ?>
                <script>
                    document.getElementById('p3rd').innerHTML="<font color='red'>Username already exists!! Try another......";
                </script>
                <?php
                
           
            }
        }
        else{
            $insert_query = "INSERT INTO users (uname,pass,fname,lname,profile_pic) VALUES('$username','$enpassword','$fname','$lname','$folder')";
            $insert_data = mysqli_query($conn,$insert_query);
            if($insert_data){
                ?>
                <script>
                    alert('Account Created Successfully');
                </script>
                <?php
                $_SESSION['username']=$username;
                header("location:loggedin.php");
            }
        }

    }
    ?>    
    