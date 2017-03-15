<?php

function eh($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

function hasFlash()
{
    if (Session::keyExist("flash-message") && Session::keyExist("flash-level")) {
        return true;
    }
    return false;
}

function encrypt_password($password)
{
    return crypt($password, APP_SALT_STRING);
}

function convert_status_to_string($status)
{
    switch($status) {
        case 1:
            return "New";
        case 2:
            return "Ongoing";
        case 3:
            return "Done";
        case 4:
            return "Pending";
        default:
            return false;
    }
}