<?php
require_once __DIR__ . '/../config/database.php';

function insertTransaksi($tanggal, $idBarang, $jumlah) {
    $conn = getDBConnection();

    try {
        $conn->beginTransaction();

        // Ambil harga dan stok dari barang
        $stmtHarga = $conn->prepare("SELECT harga_barang, stok_barang FROM barang WHERE id = ?");
        $stmtHarga->execute([$idBarang]);
        $barang = $stmtHarga->fetch();

        if (!$barang) {
            $_SESSION['error'] = "Barang tidak ditemukan.";
            $conn->rollBack();
            return false;
        }

        $harga = $barang['harga_barang'];
        $stok = $barang['stok_barang'];

        if ($stok < $jumlah) {
            $_SESSION['error'] = "Stok tidak mencukupi. Stok tersedia: $stok.";
            $conn->rollBack();
            return false;
        }

        $total = $jumlah * $harga;

        // Simpan transaksi utama
        $stmt1 = $conn->prepare("INSERT INTO transaksi (tanggal_transaksi, total_transaksi) VALUES (?, ?)");
        $stmt1->execute([$tanggal, $total]);
        $idTransaksi = $conn->lastInsertId();

        // Simpan detail transaksi
        $stmt2 = $conn->prepare("INSERT INTO detail_transaksi (id_transaksi, id_barang, jumlah_barang, harga_barang) VALUES (?, ?, ?, ?)");
        $stmt2->execute([$idTransaksi, $idBarang, $jumlah, $harga]);

        // Kurangi stok barang
        $stmt3 = $conn->prepare("UPDATE barang SET stok_barang = stok_barang - ? WHERE id = ?");
        $stmt3->execute([$jumlah, $idBarang]);

        $conn->commit();
        return true;

    } catch (Exception $e) {
        $conn->rollBack();
        $_SESSION['error'] = "Gagal menyimpan transaksi: " . $e->getMessage();
        return false;
    }
}

function getAllTransaksi() {
    $conn = getDBConnection();
    $stmt = $conn->query("
        SELECT t.id, t.tanggal_transaksi, b.nama_barang, dt.jumlah_barang, dt.harga_barang
        FROM transaksi t
        JOIN detail_transaksi dt ON dt.id_transaksi = t.id
        JOIN barang b ON b.id = dt.id_barang
        ORDER BY t.tanggal_transaksi DESC
    ");
    return $stmt->fetchAll();
}

function getTransaksiById($id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("
        SELECT t.id, t.tanggal_transaksi, b.id AS id_barang, b.nama_barang, dt.jumlah_barang, dt.harga_barang
        FROM transaksi t
        JOIN detail_transaksi dt ON dt.id_transaksi = t.id
        JOIN barang b ON b.id = dt.id_barang
        WHERE t.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function deleteTransaksi($id) {
    $conn = getDBConnection();

    try {
        $conn->beginTransaction();

        // Ambil jumlah barang dan id barang untuk mengembalikan stok
        $stmt1 = $conn->prepare("SELECT id_barang, jumlah_barang FROM detail_transaksi WHERE id_transaksi = ?");
        $stmt1->execute([$id]);
        $detail = $stmt1->fetch();

        if ($detail) {
            $idBarang = $detail['id_barang'];
            $jumlah = $detail['jumlah_barang'];

            // Kembalikan stok
            $stmt2 = $conn->prepare("UPDATE barang SET stok_barang = stok_barang + ? WHERE id = ?");
            $stmt2->execute([$jumlah, $idBarang]);
        }

        // Hapus detail transaksi
        $stmt3 = $conn->prepare("DELETE FROM detail_transaksi WHERE id_transaksi = ?");
        $stmt3->execute([$id]);

        // Hapus transaksi utama
        $stmt4 = $conn->prepare("DELETE FROM transaksi WHERE id = ?");
        $stmt4->execute([$id]);

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollBack();
        die("Gagal menghapus transaksi: " . $e->getMessage());
    }
}

