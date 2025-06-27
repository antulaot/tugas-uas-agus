<?php
session_start();

require_once __DIR__ . '/../models/Transaksi.php';
require_once __DIR__ . '/../models/Barang.php'; // Untuk dropdown barang

function handleTransaksiRequest() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'create') {
            $tanggal = $_POST['tanggal_transaksi'];
            $idBarang = $_POST['id_barang'];
            $jumlah = $_POST['jumlah_barang'];

            $result = insertTransaksi($tanggal, $idBarang, $jumlah);

            if ($result) {
                $_SESSION['success'] = 'Transaksi berhasil ditambahkan.';
            }
            // Jika gagal, insertTransaksi sudah menyetel $_SESSION['error']

            header("Location: /transaksi.php");
            exit;
        }

        elseif ($action === 'delete') {
            $id = $_POST['id'] ?? null;

            if ($id) {
                deleteTransaksi($id);
                $_SESSION['success'] = 'Transaksi berhasil dihapus.';
            }

            header("Location: /transaksi.php");
            exit;
        }
    }
}
