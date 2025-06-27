<?php
require_once __DIR__ . '/../config/database.php';

function findUserByUsername($username) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch();
}
