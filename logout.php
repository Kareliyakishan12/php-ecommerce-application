<?php
require_once("db_connect.php");
require_once("function_inc.php");

if (isset($_SESSION['login']) && isset($_SESSION['Customer_Id'])) {
    if ($_SESSION['login'] == true && $_SESSION['Customer_Id'] != '') {
        unset($_SESSION['login']);
        unset($_SESSION['Customer_Id']);
        redirect("index.php");
    }
}
