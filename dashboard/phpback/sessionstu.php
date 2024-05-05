<?php

include 'dbconn.php';

session_start();

$host = 'localhost';
$dbname = 'student_attendance';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function isUserLoggedIn() {
    return isset($_SESSION['username']) && $_SESSION['loggedin'] === true;
}

function checkUserRole() {
    global $pdo;
    
    $username = $_SESSION['username'];
    $stmt = $pdo->prepare("SELECT role_id FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $role_id = $stmt->fetchColumn();

    if ($role_id == '3') {
        header("Location: pages-error-403.php");
        exit;
    } elseif ($role_id == '2') {
        header("Location: pages-error-403.php");
        exit;
    }  elseif ($role_id == '1') {}
  }

function checkSessionTimeout() {
    $timeout = 600;

    if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $timeout) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['last_activity'] = time();
    }
}

if (!in_array(basename($_SERVER['PHP_SELF']), ['login.php', 'logout.php'])) {
    checkSessionTimeout();
    if (isUserLoggedIn()) {
        checkUserRole();
    } else {
        header("Location: login.php");
        exit;
    }
}
?>