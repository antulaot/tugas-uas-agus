<?php include __DIR__ . '/../partials/header.php'; ?>
<?php
$barangs = getAllBarang(); // Ambil dari model
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Barang</h2>
    <div>
      <a href="barang.php?action=add" class="btn btn-primary me-2">+ Tambah Barang</a>
      <a href="transaksi.php" class="btn btn-success">Transaksi</a>
    </div>
  </div>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($barangs as $barang): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($barang['nama_barang']) ?></td>
          <td>Rp <?= number_format($barang['harga_barang'], 2, ',', '.') ?></td>
          <td><?= $barang['stok_barang'] ?></td>
          <td>
            <a href="barang.php?action=edit&id=<?= $barang['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <form method="POST" action="/barang.php" class="d-inline delete-barang-form">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $barang['id'] ?>">
              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- SweetAlert untuk feedback sukses -->
<?php if (isset($_SESSION['success'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: '<?= $_SESSION['success'] ?>',
        showConfirmButton: false,
        timer: 2000
    });
</script>
<?php unset($_SESSION['success']); endif; ?>

<!-- Konfirmasi sebelum hapus -->
<script>
document.querySelectorAll('.delete-barang-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin menghapus barang ini?',
            text: "Barang akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>
