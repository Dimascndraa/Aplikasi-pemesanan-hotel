<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=stok-kamar");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];

$dataKamarSuperior = query("SELECT * FROM kamar WHERE jenis_kamar = 'superior' && status = 'tersedia'");
$dataKamarDeluxe = query("SELECT * FROM kamar WHERE jenis_kamar = 'deluxe' && status = 'tersedia'");
$hotel = query("SELECT * FROM identitas")[0];
?>

<?php include 'layout/atas.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <?php include "layout/preloader.php" ?>

        <?php include "layout/navbar.php" ?>

        <?php include "layout/sidebar.php" ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Stok Kamar</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Stok Kamar </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid p-5">

                    <button class="btn fs-4 text-center d-block m-auto position-relative">
                        Superior
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                            <?= count($dataKamarSuperior) ?>
                        </span>
                    </button>
                    <hr class="w-25 m-auto">
                    <?php if (count($dataKamarSuperior) > 0) : ?>
                        <a href="print/print-stok-kamar-superior.php" target="_blank" class="btn btn-primary d-block" style="width: 10rem;"><i class="fas fa-print"></i> Cetak</a>
                        <div class="row g-2 mt-1 mb-5">
                            <?php foreach ($dataKamarSuperior as $kamarSuperior) : ?>
                                <div class="col-lg-3">
                                    <div class="card">
                                        <img src="../img/fasilitas/<?= $kamarSuperior['gambar'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="text-center"><strong><?= ucfirst($kamarSuperior['jenis_kamar']) ?></strong></h5>

                                            <p class="card-text text-center">Status: <?= ucfirst($kamarSuperior['status']) ?></p>
                                            <p style="margin-top: -1rem;" class="card-text text-center">Harga: Rp.<?= rupiah($kamarSuperior['tarif']) ?></p>
                                            <p style="margin-top: -1rem;" class="card-text text-center">Nomor Kamar: <?= $kamarSuperior['no_kamar'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <h5 class="text-muted text-center mb-5 mt-3">*Kamar terisi penuh!</h5>
                    <?php endif; ?>
                    <button class="btn fs-4 text-center d-block m-auto position-relative">
                        Deluxe
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                            <?= count($dataKamarDeluxe) ?>
                        </span>
                    </button>
                    <hr class="w-25 m-auto">
                    <?php if (count($dataKamarDeluxe) > 0) : ?>
                        <a href="print/print-stok-kamar-deluxe.php" target="_blank" class="btn btn-primary d-block" style="width: 10rem;"><i class="fas fa-print"></i> Cetak</a>
                        <div class="row g-2 mt-1">
                            <?php foreach ($dataKamarDeluxe as $kamarDeluxe) : ?>
                                <div class="col-lg-3">
                                    <div class="card">
                                        <img src="../img/fasilitas/<?= $kamarDeluxe['gambar'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="text-center"><strong><?= ucfirst($kamarDeluxe['jenis_kamar']) ?></strong></h5>

                                            <p class="card-text text-center">Status: <?= ucfirst($kamarDeluxe['status']) ?></p>
                                            <p style="margin-top: -1rem;" class="card-text text-center">Harga: Rp.<?= rupiah($kamarDeluxe['tarif']) ?></p>
                                            <p style="margin-top: -1rem;" class="card-text text-center">Nomor Kamar: <?= $kamarDeluxe['no_kamar'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <h5 class="text-muted text-center mb-5 mt-3">*Kamar terisi penuh!</h5>
                    <?php endif; ?>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="#">Dimas Candra</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php include "layout/bawah.php" ?>
</body>

</html>