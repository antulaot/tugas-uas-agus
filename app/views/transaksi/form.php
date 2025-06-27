<?php include __DIR__ . '/../partials/header.php'; ?>

<?php
$isEdit = isset($transaksi);
$tanggal = $isEdit ? $transaksi['tanggal_transaksi'] : date('Y-m-d');
$idBarang = $isEdit ? $transaksi['id_barang'] : '';
$jumlah = $isEdit ? $transaksi['jumlah_barang'] : '';
$harga = $isEdit ? $transaksi['harga_barang'] : '';
?>

<div class="container mt-4">
    <h2><?= $isEdit ? 'Edit Transaksi' : 'Tambah Transaksi' ?></h2>

    <form action="/transaksi.php" method="POST" class="mt-3">
        <?php if ($isEdit): ?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $transaksi['id'] ?>">
        <?php else: ?>
            <input type="hidden" name="action" value="create">
        <?php endif; ?>

        <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="<?= $tanggal ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_barang" class="form-label">Barang</label>
            <select class="form-select" id="id_barang" name="id_barang" required onchange="setHargaBarang(this)">
                <option value="">-- Pilih Barang --</option>
                <?php foreach ($barangs as $barang): ?>
                    <option value="<?= $barang['id'] ?>"
                        data-harga="<?= $barang['harga_barang'] ?>"
                        <?= $barang['id'] == $idBarang ? 'selected' : '' ?>>
                        <?= $barang['nama_barang'] ?> (Stok: <?= $barang['stok_barang'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="harga_barang" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga_barang" name="harga_barang" value="<?= $harga ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="jumlah_barang" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="<?= $jumlah ?>" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/transaksi.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
function setHargaBarang(select) {
    const harga = select.options[select.selectedIndex].getAttribute('data-harga');
    document.getElementById('harga_barang').value = harga || '';
}

// Set harga saat halaman pertama kali dibuka jika barang sudah dipilih
window.onload = function () {
    const select = document.getElementById('id_barang');
    if (select.value) {
        setHargaBarang(select);
    }
}
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>
