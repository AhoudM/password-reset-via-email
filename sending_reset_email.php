<?php
    require('connect.php');
    $_SESSION["mail_messages"]="";

//     if($_SESSION["user_type"]=="user"){
        if(isset($_POST["reset"])) {
            // key code goes here..
            if (isset($_POST["email"]) && (!empty($_POST["email"]))) {

                $email= $_POST["email"];
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                $valid = filter_var($email, FILTER_VALIDATE_EMAIL);

                $q="SELECT * FROM users WHERE email = '$email'";
                $result= $conn->query($q);
                if(gettype($valid) == "string"){
                    if($result->num_rows==0){
                        $_SESSION["mail_messages"].= "User Not Found";
                        $conn->close();
                        header('location:password_reset.php');
                    }else {
                        $output = '';
            
                        $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                        $expDate = date("Y-m-d H:i:s", $expFormat);
                        $key = md5(time());
                        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                        $key = $key . $addKey;

                        $q="INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');";
                        $conn->query($q);

                        $output.='<a href="http://localhost/fairy_booth/resetting_password.php?key=' . $key . '&email=' . $email . '&action=reset" 
                        target="_blank">Reset Password</a>';

                        // email code goes here..
                        $fromEmail = "wishlist.senior18@gmail.com";
                        $toEmail = $_POST['email'];
                        $message = "You are receiving this email because you asked for a password reset."."\r\n"." If you did then follow the link to reset your password.\n"
                        .$output."\nHowever, if you did not ask for password reset then please ignore this email.";
                        $message = wordwrap($message);
                    
                        $to = $toEmail;
                        $subject = "password reset";
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();
                        $message = '<!doctype html>
                                <html lang="en">
                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport"
                                        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                    <title>Document</title>
                                </head>
                                <body>
                                <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
                                    <div class="container">
                                    '.$message.'<br/><br/>
                                        Regards<br/>
                                    '.$fromEmail.'
                                    </div>
                                </body>
                                </html>';
                        غيري اسم المتعير الي في السطر التالي
                        $result2 = @mail($to, $subject, $message, $headers);
                    
                        // echo '<script>alert("Email sent successfully !")</script>';
                        // echo '<script>window.location.href="index.php";</script>';
                        الجملة في السطر التالي المفروض تتاكد من المتغير الي فوق فغيريها من ترو الى قيمة المتغير الي فوق
                        if($result2){
                            $_SESSION["mail_messages"]="A reset message was sent to your registered email..\nPlease check your email";
                            $conn->close();
                            header('location:password_reset.php');
                        }else{
                            $_SESSION["mail_messages"]="Invalid email address";
                            $conn->close();
                            header('location:password_reset.php');
                        }
                    }
                }else{
                    $_SESSION["mail_messages"].= "Invalid email address";
                    $conn->close();
                    header('location:password_reset.php');
                }
            }
        }
//     }elseif($_SESSION["user_type"]=="vendor"){
//         if(isset($_POST["reset"])) {
//             // key code goes here..
//             if (isset($_POST["email"]) && (!empty($_POST["email"]))) {

//                 $email= $_POST["email"];
//                 $email = filter_var($email, FILTER_SANITIZE_EMAIL);
//                 $valid = filter_var($email, FILTER_VALIDATE_EMAIL);

//                 $q="SELECT * FROM vendors WHERE email = '$email'";
//                 $result= $conn->query($q);
//                 if(gettype($valid) == "string"){
//                     if($result->num_rows==0){
//                         $_SESSION["mail_messages"].= "User Not Found";
//                         $conn->close();
//                         header('location:password_reset.php');
//                     }else {
//                         $output = '';
            
//                         $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
//                         $expDate = date("Y-m-d H:i:s", $expFormat);
//                         $key = md5(time());
//                         $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
//                         $key = $key . $addKey;

//                         $q="INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');";
//                         $conn->query($q);

//                         $output.='<a href="http://localhost/fairy_booth/resetting_password.php?key=' . $key . '&email=' . $email . '&action=reset" 
//                         target="_blank">Reset Password</a>';

//                         // email code goes here..
//                         $fromEmail = "wishlist.senior18@gmail.com";
//                         $toEmail = $_POST['email'];
//                         $message = "You are receiving this email because you asked for a password reset."."\r\n"." If you did then follow the link to reset your password.\n"
//                         .$output."\nHowever, if you did not ask for password reset then please ignore this email.";
//                         $message = wordwrap($message);
                    
//                         $to = $toEmail;
//                         $subject = "password reset";
//                         $headers = "MIME-Version: 1.0" . "\r\n";
//                         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//                         $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();
//                         $message = '<!doctype html>
//                                 <html lang="en">
//                                 <head>
//                                     <meta charset="UTF-8">
//                                     <meta name="viewport"
//                                         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
//                                     <meta http-equiv="X-UA-Compatible" content="ie=edge">
//                                     <title>Document</title>
//                                 </head>
//                                 <body>
//                                 <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
//                                     <div class="container">
//                                     '.$message.'<br/><br/>
//                                         Regards<br/>
//                                     '.$fromEmail.'
//                                     </div>
//                                 </body>
//                                 </html>';
//                         $result = @mail($to, $subject, $message, $headers);
                    
//                         // echo '<script>alert("Email sent successfully !")</script>';
//                         // echo '<script>window.location.href="index.php";</script>';
//                         if(true){
//                             $_SESSION["mail_messages"]="A reset message was sent to your registered email..\nPlease check your email";
//                             $conn->close();
//                             header('location:password_reset.php');
//                         }else{
//                             $_SESSION["mail_messages"]="Invalid email address";
//                             $conn->close();
//                             header('location:password_reset.php');
//                         }
//                     }
//                 }else{
//                     $_SESSION["mail_messages"].= "Invalid email address";
//                     $conn->close();
//                     header('location:password_reset.php');
//                 }
//             }
//         }
//     }    

?>
