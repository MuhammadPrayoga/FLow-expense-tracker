<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-4">
    <h2>Laporan Transaksi</h2>

    <!-- Form Filter Periode -->
    <div class="card bg-dark text-white mb-4">
        <div class="card-header">Filter Periode</div>
        <div class="card-body">
            <form action="<?= base_url('reports'); ?>" method="get">
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?= esc($start_date); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?= esc($end_date); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-3">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="card bg-dark text-white mb-4">
        <div class="card-header">Daftar Transaksi</div>
        <div class="card-body">
            <a href="<?= base_url('reports/export-pdf?start_date=' . $start_date . '&end_date=' . $end_date); ?>" class="btn btn-success mb-3">Ekspor ke PDF</a>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transactions)): ?>
                        <tr><td colspan="5" class="text-center">Tidak ada transaksi</td></tr>
                    <?php else: ?>
                        <?php foreach ($transactions as $t): ?>
                            <tr>
                                <td><?= esc($t['date']); ?></td>
                                <td><?= esc($t['category_name']); ?></td>
                                <td><?= esc($t['type'] == 'expense' ? 'Pengeluaran' : 'Pemasukan'); ?></td>
                                <td>Rp <?= number_format($t['amount'], 2, ',', '.'); ?></td>
                                <td><?= esc($t['description'] ?: '-'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="card bg-dark text-white">
        <div class="card-header">Ringkasan Transaksi</div>
        <div class="card-body">
            <canvas id="transactionChart" height="100"></canvas>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('transactionChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [<?php foreach ($chart_data as $data) echo "'" . esc($data['name']) . " (" . ($data['type'] == 'expense' ? 'Pengeluaran' : 'Pemasukan') . ")',"; ?>],
            datasets: [{
                data: [<?php foreach ($chart_data as $data) echo $data['total_amount'] . ","; ?>],
                backgroundColor: ['#0d6efd', '#198754', '#6c757d', '#dc3545', '#ffc107'],
                borderColor: '#343a40',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#f8f9fa',
                        font: { size: 14 }
                    }
                },
                title: {
                    display: true,
                    text: 'Ringkasan Transaksi (<?= esc($start_date); ?> - <?= esc($end_date); ?>)',
                    color: '#f8f9fa',
                    font: { size: 16 }
                }
            }
        }
    });
</script>
<?= $this->endSection(); ?>