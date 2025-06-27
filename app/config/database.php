<?php
function getDBConnection() {
    $host = 'localhost';
    $dbname = 'marketplace_agus';
    $user = 'marketplace';
    $pass = '123456';

    try {
        return new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        die("Koneksi database gagal: " . $e->getMessage());
    }
}
