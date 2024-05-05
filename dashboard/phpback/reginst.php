<?php
include 'dbconn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $createdBy = isset($_POST['creator']) ? $_POST['creator'] : '';
    $stmt = $pdo->prepare("INSERT INTO institution (name, physical_codes, email, phone, created_by) VALUES (:name, :address, :email, :phone, :createdBy)");
    $stmt->execute(['name' => $name, 'address' => $address, 'email' => $email, 'phone' => $phone, 'createdBy' => $createdBy]);

    echo "<script>alert('Institution registered successfully!');</script>";
}
?>