<?php

include '../meddb/meddb.php';
include '../auth_check.php';

/* TEMP user id */
$user_id = $_SESSION['user_id'];
// later: $user_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    header("Location: my_requests.php");
    exit();
}

$request_id = (int) $_GET['id'];

/* Delete only if it belongs to this user AND still Pending */
$sql = "DELETE FROM requests WHERE id = ? AND user_id = ? AND status = 'Pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $request_id, $user_id);

$stmt->execute();
$stmt->close();

header("Location: my_requests.php");
exit();
