<?php
    include "db_connect.php";
    session_start();
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $usertype = $_REQUEST['type'];
    $store = $_SESSION['store_id'];
    $sql="INSERT INTO user(username, password, type, store) VALUES ('$username','$password','$usertype',$store)";
    mysqli_query($link,$sql);
?>