<?php
    include "db_connect.php";
    $user_id = $_REQUEST['user_id'];
    $sql = "DELETE FROM user WHERE id=$user_id";
    mysqli_query($link,$sql);
?>