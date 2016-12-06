<?php

$admin = false;
if(!isset($_SESSION['login'])){
    header('location: ./login.php');
}

if($_SESSION['role'] == 'admin'){
    $admin = true;
}
