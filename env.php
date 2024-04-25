<?php

const DBNAME = "yody";
const DBUSER = "root";
const DBPASS = "";
const DBCHARSET = "utf8";
const DBHOST = "localhost:3300";
//
const BASE_URL = "http://localhost:90/myproject/";

function route($url) {
    return BASE_URL.$url;
}
// key co the truyen success hoac errors
function flash($key,$msg,$route)  {
    $_SESSION[$key] = $msg;
    switch ($key) {
        case 'success':
            unset($_SESSION['errors']);
            break;
        case 'errors':
            unset($_SESSION['success']);
            break;
    }
    header('location:'.BASE_URL.$route.'?msg='.$key);die;
}


