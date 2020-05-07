<?php

session_start();
$sessionCurrentTime = time();

if (isset($_SESSION['isAdmin'])) {
    if ($_SESSION['isAdmin'] === true) {
        $sessionCurrentTime = time();
        if ($sessionCurrentTime > $_SESSION['expire']) {
            session_destroy();
            header("location: http://localhost/coupon site");
        }
        include_once '../inc/adminView.php';
    } else {
        header("location: http://localhost/coupon site/404.html");
    }
} else {
    header("location: http://localhost/coupon site/404.html");
}

?>
<h2 id="redirectText"></h2>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    idleTime = 0
    var counterX = 0
    $(document).ready(function() {
         idleInterval = setInterval(timerIncrement, 1000);

        $(this).mousemove(function(e) {

            idleTime = 0;
        });
        $(this).keypress(function(e) {
            idleTime = 0;
        });
    });

    function timerIncrement() {
        idleTime = idleTime + 1;

        if ((1200) === idleTime) {
            $.ajax({
                url: "secure.php",
                type: "post"
            }).done(function() {
                var timeleft = 10;
                 redirectionTimer = setInterval(function() {
                   document.querySelector("#redirectText").innerHTML = "you have been logged out from the dashboard! please <a href='../index.php'><b>login</b> Again!</a> OR our system will redirect you in " + timeleft + " seconds"
                    timeleft -= 1;
                    if (timeleft <= 0) {
                        clearInterval(redirectionTimer);
                        window.location = "http://localhost/coupon site/admin"
                    }
                }, 1000);
                clearInterval(idleInterval);
            }).fail(function() {
                console.log("failed")
            })
        }
    }
</script>