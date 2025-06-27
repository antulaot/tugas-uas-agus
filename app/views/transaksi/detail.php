<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">
    <h2>Detail Transaksi</h2>
    <ul class="list-group">
        <li class="list-group-item">Tanggal: <?= $transaksi['tanggal_transaksi'] ?></li>
        <li class="list-group-item">Barang: <?= $transaksi['nama_barang'] ?></li>
        <li class="list-group-item">Jumlah: <?= $transaksi['jumlah_barang'] ?></li>
        <li class="list-group-item">Harga: <?= number_format($transaksi['harga_barang'], 2) ?></li>
        <li class="list-group-item">Total: <?= number_format($transaksi['jumlah_barang'] * $transaksi['harga_barang'], 2) ?></li>
    </ul>
    <a href="/transaksi.php" class="btn btn-primary mt-3">Kembali</a>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>