<?php
    include('connect.php');
    include ('sanitize_input.php');

    if (isset($_SESSION["email"]) && isset($_POST["change"])) {
        $_SESSION["messages"] = "";
        $pass1 = sanitize($_POST["pass1"]);
        $pass2 = sanitize($_POST["pass2"]);
        // here...
        $email = $_SESSION["email"];

        if ($pass1 != $pass2 || $pass1==null || strlen($pass1)<8 || $pass2==null || strlen($pass2)<8) {
            $_SESSION["messages"] .= "<p>Please enter a matched password of 8 charachters or more.<br /><br /></p>";
            $conn->close();
            header('location:new_password.php');
        } else {
            $pass1 = md5($pass1);
            mysqli_query($conn, "UPDATE `users` SET `password` = '$pass1' WHERE `email` = '" . $email . "'");

            mysqli_query($conn, "DELETE FROM `password_reset_temp` WHERE `email` = '$email'");

            $_SESSION["messages"]="Congratulations! Your password has been updated successfully. You may log in now..";
            $conn->close();
            header('location:index.php');
        }
    }
?>