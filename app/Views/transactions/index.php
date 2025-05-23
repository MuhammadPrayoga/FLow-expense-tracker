<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-4">
    <h2>Daftar Transaksi</h2>
    <a href="<?= base_url('transactions/create'); ?>" class="btn btn-primary mb-3">Tambah Transaksi</a>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $t): ?>
                <tr>
                    <td><?= $t['date']; ?></td>
                    <td>Rp <?= number_format($t['amount']); ?></td>
                    <td><?= $t['category_id']; ?></td>
                    <td><?= $t['description']; ?></td>
                    <td>
                        <a href="/transactions/edit/<?= $t['transaction_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="/transactions/delete/<?= $t['transaction_id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>