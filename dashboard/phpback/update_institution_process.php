<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['institution_id'])) {
    $institution_id = $_POST['institution_id'];

    $institution_name = $_POST['name'];
    $physical_codes = $_POST['physical_codes'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt_update_institutions = $pdo->prepare("UPDATE institution SET name = :institution_name, physical_codes = :physical_codes, email = :email, phone = :phone WHERE id = :institution_id");
    $stmt_update_institutions->execute(['institution_name' => $institution_name, 'physical_codes' => $physical_codes, 'email' => $email, 'phone' => $phone, 'institution_id' => $institution_id]);

    header("Location: ../view1.php?update_success=1");
    exit;
} else {
    header("Location: ../view1.php?error=1");
    exit;
}
?>
