<?php

$admin = false;
$user = false;
if(isset($_SESSION['login'])){
    if($_SESSION['role'] == 'admin'){
      $admin = true;
    }
    else {
      $user = true;
    }
}
