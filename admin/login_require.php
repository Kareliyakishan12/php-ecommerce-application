<?php

require_once("db_connect_inc.php");
require_once("function_inc.php");

if (!isset($_SESSION['login']) || !isset($_SESSION['admin_id']) || $_SESSION['login'] !== true || empty($_SESSION['admin_id'])) {

    $_SESSION['login_msg'] = "<div class='text-danger mb-4'>You must be logged in to access this page.</div>";

    redirect("login_page.php");
    exit();
}
