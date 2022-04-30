<?php
    session_start();
    $_SESSION['user_type']='user';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
       body{
            color: #564f71;
            background-image: url(images/FairyBoothPatternBright.png);
            height: 100%;
            z-index: -1;
            top: 0;
            left: 0;
        }

        input{
            width: 100%;
            padding: 8px 10px;
            margin: 8px 0px;
            border-radius: 5px;
            border-color: #f9dee8;
        }

        a{
            color: #564f71;
        }

        p,h4 {
            margin-top: 20px;
        }

        .logo,.name{
            margin: 20px 20px 30px;
            text-align: center;
        }

        .pattern{
            margin-bottom: 30px;
        }

        .box{
            background-color: #f9dee8;
            border-radius: 10px;
            box-shadow: 0 0 4px #313B45;
        }
        
        .row{
            margin-top: 10px;
        }

        .btn{
            width: 100%;
            margin-top: 15px;
            background-color: #f4b3cb;
            border: none;
            cursor: pointer; 
        }
        .btn:hover{
            background-color: #ef9ab9;
        }

        @media screen and (min-width: 768px) {
            .overall{
                margin-top: 100px;
            }
            
            .pattern{
                margin-top: 100px;
                margin-bottom: 100px;
            }
        } 

        @media screen and (max-width:768px){
            .pattern{
                margin-bottom: 30px;
                position: relative;
            }

            .box{
                width: 70%;
                margin: 10px auto;
                vertical-align: middle;
            }
        }

    </style>
    <title>Fairy Booth</title>
    <link rel = "icon" href = "images/FBlogo.svg" type = "image/x-icon">
</head>
<body onload="unset($_SESSION['messages'])">
    <div class="container overall">
        <!-- big container -->
        <div class="row">
            <div class="pattern col-md-7">
                <!-- container of the image and title and brief line -->
                <div class="name">
                    <!-- name -->
                    <img src="images/name.png" />
                </div>
                <div>
                    <!-- title -->
                    <h1>Welcome dear wisher..</h1>
                </div>
                <div>
                    <!-- brief line -->
                    <h4>Share your wishes with others using <b>Fairy Booth</b> and allow others grant it for you..</h4>
                </div>
            </div>
            
            <div class="box col-md-5">
                <!-- login form container -->
                <div class="logo">
                    <img src="images/logo.png" width="80px">
                    <h4>Login to share your wishes</h4>
                </div>
                <div class="container">
                    <!-- form container -->
                    <form action="/fairy_booth/validation.php" method="post">
                        <div class="row">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div class="row">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <div class="row">
                            <?php
                                if(isset($_SESSION['login_failed'])){
                                    echo($_SESSION['login_failed']);
                                    unset($_SESSION['login_failed']); 
                                }
                                if(isset($_SESSION['messages'])){
                                    echo($_SESSION['messages']);
                                    unset($_SESSION['messages']); 
                                }
                            ?>
                            <a href="/fairy_booth/password_reset.php" name="reset_user_password" class="link">Forgot your password?</a>
                        </div>
                        <div class="row">
                            <input class="btn btn-primary" name="login_as_user" type="submit" value="login">
                        </div>
                        <div class="row">
                            <p class="sign-up">Don't have an account yet? <b><a href="/fairy_booth/user_registration.php">Sign up now</a></b></p>
                            <p>Do you have a store and sell products or services? <b><a href="/fairy_booth/vendor_login.php">Login as vendor</a></b></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>
</html>