<?php
include 'dbconn.php';
if (isset($_POST['institution_id'])) {
    $institution_id = $_POST['institution_id'];

    $stmt_fetch_institution = $pdo->prepare("SELECT * FROM institution WHERE id = :institution_id");
    $stmt_fetch_institution->execute(['institution_id' => $institution_id]);
    $institution = $stmt_fetch_institution->fetch(PDO::FETCH_ASSOC);
} else {
    echo "institution not found";
}
?>