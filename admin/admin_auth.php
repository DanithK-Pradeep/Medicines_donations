<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_category'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}