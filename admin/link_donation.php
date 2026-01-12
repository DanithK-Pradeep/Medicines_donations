<?php
include '../meddb/meddb.php';
include '../admin_auth.php';

$request_id  = (int)$_POST['request_id'];
$donation_id = (int)$_POST['donation_id'];

$conn->begin_transaction();

try {

    /* Update request */
    $stmt1 = $conn->prepare(
        "UPDATE requests 
         SET donation_id=?, status='completed' 
         WHERE id=? AND status='pending'"
    );
    $stmt1->bind_param("ii", $donation_id, $request_id);
    $stmt1->execute();

    /* Update donation */
    $stmt2 = $conn->prepare(
        "UPDATE donations 
         SET status='assigned' 
         WHERE id=? AND status='pending'"
    );
    $stmt2->bind_param("i", $donation_id);
    $stmt2->execute();

    $conn->commit();

    header("Location: match_donations.php?success=1");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    die("Linking failed");
}
