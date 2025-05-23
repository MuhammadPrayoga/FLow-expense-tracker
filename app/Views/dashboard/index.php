<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-4">
        <div class="card bg-dark text-white">
            <div class="card-header">Tambah Transaksi</div>
            <div class="card-body">
                <form action="<?= base_url('transactions/store'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Rp" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= esc($category['category_id']); ?>"><?= esc($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card bg-dark text-white">
            <div class="card-header">Ringkasan Pengeluaran</div>
            <div class="card-body">
                <canvas id="expenseChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('expenseChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [<?php foreach ($chart_data as $data)
                echo "'" . esc($data['name']) . "',"; ?>],
            datasets: [{
                data: [<?php foreach ($chart_data as $data)
                    echo $data['total_expense'] . ","; ?>],
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
                    text: 'Pengeluaran per Kategori',
                    color: '#f8f9fa',
                    font: { size: 16 }
                }
            }
        }
    });
</script>
<?= $this->endSection(); ?>