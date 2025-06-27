<?php
session_start();
require_once __DIR__ . '/../../models/Transaksi.php';
$transaksiList = getAllTransaksi();
?>

<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Daftar Transaksi</h2>
        <div>
            <a href="/barang.php" class="btn btn-outline-secondary me-2">Daftar Barang</a>
            <a href="/transaksi.php?action=add" class="btn btn-success">Tambah Transaksi</a>
        </div>
    </div>

    <table class="table table-bordered mt-3 table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transaksiList)): ?>
                <tr>
                    <td colspan="7" class="text-center">Belum ada transaksi</td>
                </tr>
            <?php else: ?>
                <?php foreach ($transaksiList as $i => $t): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($t['tanggal_transaksi']) ?></td>
                        <td><?= htmlspecialchars($t['nama_barang']) ?></td>
                        <td><?= (int) $t['jumlah_barang'] ?></td>
                        <td>Rp<?= number_format($t['harga_barang'], 2, ',', '.') ?></td>
                        <td>Rp<?= number_format($t['jumlah_barang'] * $t['harga_barang'], 2, ',', '.') ?></td>
                        <td>
                            <a href="/transaksi.php?action=detail&id=<?= $t['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                            <form method="POST" action="/transaksi.php" class="d-inline delete-form">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- SweetAlert: Success -->
<?php if (isset($_SESSION['success'])): ?>
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

<!-- SweetAlert: Error -->
<?php if (isset($_SESSION['error'])): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '<?= $_SESSION['error'] ?>',
    showConfirmButton: true
});
</script>
<?php unset($_SESSION['error']); endif; ?>

<!-- SweetAlert: Konfirmasi Hapus -->
<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin menghapus transaksi?',
            text: "Stok akan dikembalikan, dan data tidak bisa dipulihkan!",
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
