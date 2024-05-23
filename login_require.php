<?php
require_once("db_connect.php");
require_once("function_inc.php");

if (!isset($_SESSION['login']) || !isset($_SESSION['Customer_Id']) || $_SESSION['login'] !== true || empty($_SESSION['Customer_Id'])) {

    $_SESSION['login_msg'] = "You must be logged in to access this page.";

    redirect("login_page.php");
    exit();
}
