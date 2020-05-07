<?php

session_start();

function status (){
    if($_POST['numb'] == '+919427218654') {
        $statusRES = true;
        $_SESSION['statusRES'] = true;
    } else {
        $statusRES = false;
    }
    
    echo $statusRES;
}

status();
  
?>