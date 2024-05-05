<?php
include 'dbconn.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT COUNT(*) AS total_users FROM users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $total_users = $result['total_users'];
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_admins FROM users WHERE role_id = 3");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $total_admins = $result['total_admins'];
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT COUNT(*) AS total_lecturers FROM lecturers");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $total_lecturers = $result['total_lecturers'];
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT COUNT(*) AS total_students FROM students");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $total_students = $result['total_students'];
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT COUNT(*) AS total_courses FROM courses");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $total_courses = $result['total_courses'];
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>