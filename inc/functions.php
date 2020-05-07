<?php

function generateRandomString($length = 0) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABC-DEFGHIJKLMNOPQRSTUVWXYZ';
    $length = rand(70,150);
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>