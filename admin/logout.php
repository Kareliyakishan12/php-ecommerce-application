<?php
require('db_connect_inc.php');
require('function_inc.php');
if (isset($_SESSION['login']) && isset($_SESSION['admin_id'])) {
    unset($_SESSION['login']);
    unset($_SESSION['admin_id']);
    redirect("login_page.php");
}
