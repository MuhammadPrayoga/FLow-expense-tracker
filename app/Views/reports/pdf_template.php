<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi FLow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Laporan Transaksi FLow</h1>
    <p>Periode: <?= esc($start_date); ?> s/d <?= esc($end_date); ?></p>
    <table>
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
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada transaksi</td>
                </tr>
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
</body>

</html>