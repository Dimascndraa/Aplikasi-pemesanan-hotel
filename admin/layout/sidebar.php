<?php
// include '../logic/functions.php';
$hotel = query("SELECT * FROM identitas")[0];
// var_dump($hotel);
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
        <img src="../img/logo/<?= $hotel['logo_secondary'] ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-size: 13pt;"><?= $hotel['nama_hotel'] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../img/profil/<?= $data['foto'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="./profile.php" class="d-block"><?= $data['nama'] ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= $_GET['page'] == "dashboard" ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if ($data['role'] == "admin") : ?>
                    <li class="nav-item">
                        <a href="identitas.php" class="nav-link <?= $_GET['page'] == "identitas" ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-hotel"></i>
                            <p>Identitas Hotel</p>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="profile.php" class="nav-link <?= $_GET['page'] == "profile" ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="data-fasilitas.php" class="nav-link <?= $_GET['page'] == "data-fasilitas" ? 'active' : ''; ?>">
                        <i class="fas fa-box-open nav-icon"></i>
                        <p>Data Fasilitas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="data-kamar.php" class="nav-link <?= $_GET['page'] == "data-kamar" ? 'active' : ''; ?>">
                        <i class="fas fa-door-closed nav-icon"></i>
                        <p>Data Kamar</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="data-pesanan.php" class="nav-link <?= $_GET['page'] == "data-pesanan" ? 'active' : ''; ?>">
                        <i class="fas fa-dolly nav-icon"></i>
                        <p>Data Pesanan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="data-pembayaran.php" class="nav-link <?= $_GET['page'] == "data-pembayaran" ? 'active' : ''; ?>">
                        <i class="fas fa-wallet nav-icon"></i>
                        <p>Data Pembayaran</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="stok-kamar.php" class="nav-link <?= $_GET['page'] == "stok-kamar" ? 'active' : ''; ?>">
                        <i class="fas fa-door-open nav-icon"></i>
                        <p>Stok Kamar</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="kamar-terisi.php" class="nav-link <?= $_GET['page'] == "kamar-terisi" ? 'active' : ''; ?>">
                        <i class="fas fa-bed nav-icon"></i>
                        <p>Kamar Terisi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <?php if ($data['role'] == "admin") : ?>
                        <a href="data-user.php" class="nav-link <?= $_GET['page'] == "data-user" ? 'active' : ''; ?>">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Data User</p>
                        </a>
                </li>
            <?php endif; ?>

            <?php if ($data['role'] == "admin") : ?>
                <li class="nav-item">
                    <a href="tambah-user.php" class="nav-link <?= $_GET['page'] == "tambah-user" ? 'active' : ''; ?>">
                        <i class="fas fa-user-cog nav-icon"></i>
                        <p>Tambah Petugas</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($data['role'] == "admin") : ?>
                <li class="nav-item">
                    <a href="tambah-kamar.php" class="nav-link <?= $_GET['page'] == "input-kamar" ? 'active' : ''; ?>">
                        <i class="fas fa-plus-circle nav-icon"></i>
                        <p>Input Data Kamar</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($data['role'] == "admin") : ?>
                <li class="nav-item">
                    <a href="tambah-fasilitas.php" class="nav-link <?= $_GET['page'] == "tambah-fasilitas" ? 'active' : ''; ?>">
                        <i class="fas fa-plus nav-icon"></i>
                        <p>Tambah Fasilitas</p>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a href="../logic/proses-logout.php" name="logout" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Keluar</p>
                </a>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>