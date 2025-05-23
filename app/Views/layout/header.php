<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/'); ?>">FLow</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (session()->has('user_id')): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/'); ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('transactions'); ?>">Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('categories'); ?>">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('budgets'); ?>">Anggaran</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('reports'); ?>">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('logout'); ?>">Logout
                            (<?= esc(session()->get('name')); ?>)</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('login'); ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('register'); ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>