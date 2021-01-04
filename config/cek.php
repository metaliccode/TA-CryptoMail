<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
    header('location: login.php');
}
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
