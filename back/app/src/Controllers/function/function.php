<?php

function checkData($value) {

    $value = trim($value);
    $value = stripslashes($value);
    $value = strlen($value) <= 20;
    $value = htmlspecialchars($value);
    $value = preg_match("^[A-Za '-]+$", $value);

    return $value;
}


function checkEmail($value) {

    $regexMail = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

        $value = trim($value);
        $value = stripslashes($value);
        $value = filter_var($value, FILTER_VALIDATE_EMAIL);
        $value = preg_match($regexMail, $value);
}