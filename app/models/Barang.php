<?php
require_once __DIR__ . '/../config/database.php';

function getAllBarang() {
    $db = getDBConnection();
    return $db->query("SELECT * FROM barang")->fetchAll(PDO::FETCH_ASSOC);
}

function getBarangById($id) {
    $db = getDBConnection();
    $stmt = $db->prepare("SELECT * FROM barang WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertBarang($nama, $harga, $stok) {
    $db = getDBConnection();
    $stmt = $db->prepare("INSERT INTO barang (nama_barang, harga_barang, stok_barang) VALUES (?, ?, ?)");
    return $stmt->execute([$nama, $harga, $stok]);
}

function updateBarang($id, $nama, $harga, $stok) {
    $db = getDBConnection();
    $stmt = $db->prepare("UPDATE barang SET nama_barang = ?, harga_barang = ?, stok_barang = ? WHERE id = ?");
    return $stmt->execute([$nama, $harga, $stok, $id]);
}

function deleteBarang($id) {
    $db = getDBConnection();
    $stmt = $db->prepare("DELETE FROM barang WHERE id = ?");
    return $stmt->execute([$id]);
}

function updateBarangStok($id, $stok) {
    global $conn;
    $stmt = $conn->prepare("UPDATE barang SET stok_barang = ? WHERE id = ?");
    $stmt->execute([$stok, $id]);
}