<?php
    include "db_connect.php";
    $user_id = $_REQUEST['user_id'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    if($password == ''){
        $sql = "UPDATE user SET username='$username' WHERE id=$user_id";
    }
    else{
        $sql = "UPDATE user SET username='$username',password='$password' WHERE id=$user_id";
    }
    mysqli_query($link,$sql);
?>