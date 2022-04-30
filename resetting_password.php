<?php
    include('connect.php');
    $_SESSION['messages']='';

    if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"])) {
        $_SESSION['key'] = $_GET["key"];
        $_SESSION['email'] = $_GET["email"];
        $_SESSION['curDate'] = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "SELECT * FROM `password_reset_temp` WHERE `key`='" . $_SESSION['key'] . "' and `email`='" . $_SESSION['email'] . "';");
        $row = mysqli_num_rows($query);
        if ($row == "") {
            $conn->close();
            header('location:invalid.php');
        } else {
            $row = mysqli_fetch_assoc($query);
            $expDate = $row['expDate'];
            if ($expDate >= $_SESSION['curDate']) {
                // here it will be reset
                $conn->close();
                header('location:new_password.php');
            } else {
                $conn->close();
                header('location:invalid.php');
            }
        }
    }
?>