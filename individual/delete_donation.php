<?php

include '../meddb/meddb.php';
include '../auth_check.php';


$user_id = $_SESSION['user_id'];


if (!isset($_GET['id'])) {
    header("Location: mydonation.php");
    exit();
}

$donation_id = (int) $_GET['id'];
/* Delete ONLY if donation belongs to this user AND status is Pending */
$sql = "DELETE FROM donations 
        WHERE id = ? AND user_id = ? AND status = 'Pending'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $donation_id, $user_id);

if ($stmt->execute()) {
    header("Location: mydonation.php?msg=deleted");
} else {
    header("Location: mydonation.php?msg=error");
}

$stmt->close();

?>
