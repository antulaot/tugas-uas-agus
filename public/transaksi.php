<?php
require_once __DIR__ . '/../app/controllers/TransaksiController.php';
require_once __DIR__ . '/../app/models/Transaksi.php';
require_once __DIR__ . '/../app/models/Barang.php';

$pageTitle = 'Transaksi';


session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit;
}

handleTransaksiRequest();

$action = $_GET['action'] ?? 'list';

if ($action === 'add') {
    $barangs = getAllBarang(); // untuk dropdown
    require_once __DIR__ . '/../app/views/transaksi/form.php';
} elseif ($action === 'detail') {
    $transaksi = getTransaksiById($_GET['id']);
    require_once __DIR__ . '/../app/views/transaksi/detail.php';
} else {
    $transaksiList = getAllTransaksi();
    require_once __DIR__ . '/../app/views/transaksi/index.php';
}
