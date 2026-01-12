<?php


session_start();
include '../meddb/meddb.php';
include '../auth_check.php';

session_destroy();
header("Location: ../index.php");
exit();

?>