<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="container mt-4">
  <h2><?= isset($edit) ? 'Edit Barang' : 'Tambah Barang' ?></h2>

  <form method="POST" class="mt-3">
    <input type="hidden" name="action" value="<?= isset($edit) ? 'update' : 'create' ?>">
    <?php if (isset($edit)): ?>
      <input type="hidden" name="id" value="<?= $edit['id'] ?>">
    <?php endif; ?>

    <div class="mb-3">
      <label for="nama_barang" class="form-label">Nama Barang</label>
      <input type="text" name="nama_barang" id="nama_barang" class="form-control" required
             value="<?= htmlspecialchars($edit['nama_barang'] ?? '') ?>">
    </div>

    <div class="mb-3">
      <label for="harga_barang" class="form-label">Harga Barang</label>
      <input type="number" name="harga_barang" id="harga_barang" class="form-control" step="0.01" required
             value="<?= $edit['harga_barang'] ?? '' ?>">
    </div>

    <div class="mb-3">
      <label for="stok_barang" class="form-label">Stok Barang</label>
      <input type="number" name="stok_barang" id="stok_barang" class="form-control" required
             value="<?= $edit['stok_barang'] ?? '' ?>">
    </div>

    <button type="submit" class="btn btn-success"><?= isset($edit) ? 'Perbarui' : 'Simpan' ?></button>
    <a href="/barang.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
