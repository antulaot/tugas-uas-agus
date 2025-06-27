<?php
session_start();
require_once __DIR__ . '/../models/Barang.php';

function handleBarangRequest() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];
        
        if ($action === 'create') {
            insertBarang($_POST['nama_barang'], $_POST['harga_barang'], $_POST['stok_barang']);
            $_SESSION['success'] = 'Barang berhasil ditambahkan.';
        } elseif ($action === 'update') {
            updateBarang($_POST['id'], $_POST['nama_barang'], $_POST['harga_barang'], $_POST['stok_barang']);
            $_SESSION['success'] = 'Barang berhasil diperbarui.';
        } elseif ($action === 'delete') {
            deleteBarang($_POST['id']);
            $_SESSION['success'] = 'Barang berhasil dihapus.';
        }

        header("Location: /barang.php");
        exit;
    }
}
