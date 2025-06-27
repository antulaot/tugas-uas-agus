
<?php
require_once __DIR__ . '/../app/controllers/BarangController.php';
require_once __DIR__ . '/../app/models/Barang.php';

$pageTitle = 'Daftar Barang';


session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit;
}


handleBarangRequest();

$action = $_GET['action'] ?? 'list';
if ($action === 'add') {
    require_once __DIR__ . '/../app/views/barang/form.php';
} elseif ($action === 'edit') {
    $edit = getBarangById($_GET['id']);
    require_once __DIR__ . '/../app/views/barang/form.php';
} else {
    require_once __DIR__ . '/../app/views/barang/index.php';
}
