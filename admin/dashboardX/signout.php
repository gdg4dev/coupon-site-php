<?php
session_start();
function adminSignout(){
    if(isset($_SESSION['isAdmin'])){
        session_destroy();
        echo "logged out";
    }     
}
?>