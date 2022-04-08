<?php
    include "function/db_connect.php";
    echo "
    <div id='navbar'>
        <div style='font-weight:bold; margin-right:10px;'>
            Tindahan Store
        </div>
        <span></span>
        <a href='staff_index.php'>
            Home
        </a>
        <span></span>
        <a href='cashier.php'>
            Cashier
        </a>
        <span></span>
        <a href='sales.php'>
            Sales
        </a>
        <span></span>
        <a href='inventory.php'>
            Inventory
        </a>
        ";
        if($_SESSION['type'] == 'admin'){
        echo "
            <a href='user_mgmt.php'>
                User Management
            </a>";
        }
    echo "
        <a href='reg_prod/index.php'>
            Register Product
        </a>
        <a href='function/logout.php'>
            Logout
        </a>
    </div>";

?>