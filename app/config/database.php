<?php
function getDBConnection() {
    $host = 'mysql.railway.internal';
    $dbname = 'railway';
    $user = 'root';
    $pass = 'kdCwqjtCZLWBLWZMWpphoCBpIXNiZhdx';

    try {
        return new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        die("Koneksi database gagal: " . $e->getMessage());
    }
}
