<?php

include_once '../functions.php';
session_start();


if (isset($_SESSION['isAdmin'])) {
    if ($_SESSION['isAdmin'] = true) {
        header("location: ../dashboardX");
    }
}


$tokenInvalidCounter = generateRandomString();
$clientAdminLoginIpAddress = get_client_ip();
if ($_SESSION['statusRES'] === true) {
    include_once 'index.html';
    $email = "projectcodershub@gmail.com";
    $password = "#codershub132002@ani&maxfornoone";

    if (isset($_SESSION['invalidCounter'])) {
        $invalidCounter =  $_SESSION['invalidCounter'];
    } else {
        $invalidCounter =  0;
    }


    if ($invalidCounter < 3) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $submittedAdminEmail = $_POST['email'];
            $submittedAdminPassword = $_POST['password'];

            if ($submittedAdminEmail == $email) {
                if ($submittedAdminPassword == $password) {
                    $_SESSION['invalidCounter'] = 0;
                    $_SESSION['isAdmin'] = true;

                    $_SESSION['start'] = time(); // Taking now logged in time.
                    // Ending a session in 30 minutes from the starting time.
                    $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                    
                    header("location: ../dashboardX");
                } else {
                    echo "<script>alert('email or password is invalid')</script>";
                    $invalidCounter++;
                    $_SESSION['invalidCounter'] = $invalidCounter;
                }
            } else {
                echo "<script>alert('email or password is invalid')</script>";
                $invalidCounter++;
                $_SESSION['invalidCounter'] = $invalidCounter;
            }
        }
    } else {
        $_SESSION['statusRES'] = false;
        $_SESSION['tokenInvalidCounter'] = $tokenInvalidCounter;
        header("location: http://localhost/coupon%20site/admin?invalid=true&token=" . $_SESSION['tokenInvalidCounter']);
    }
} else  if ($_SESSION['statusRES'] === false || $_SESSION['statusRES'] === null) {
    session_destroy();
    header("location: http://localhost/coupon%20site/404.html");
}
