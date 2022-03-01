<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=data-pembayaran");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$idPembayaran = $_GET['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$hotel = query("SELECT * FROM identitas")[0];

$pembayaran = query("SELECT * FROM pembayaran WHERE id = $idPembayaran ORDER BY id DESC")[0];
$i = 1;
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
                            <h1 class="m-0">Data Pembayaran</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Pembayaran </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="col-12 my-3">
                        <a href="./data-pembayaran.php?page=data-pembayaran">Kembali ke halaman sebelumnya</a>
                    </div>
                    <div class="col-12">
                        <div class="card p-5" style="font-weight: 500;">
                            <p class="fs-4">Detail Pembayaran</p>
                            <hr style="width: 15rem; margin-top: -1rem;">
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <span class="d-block mb-3">Nama Pembayar:</span>
                                    <span class="d-block mb-3">Tanggal Pembayaran:</span>
                                    <span class="d-block mb-3">Bank:</span>
                                    <span class="d-block mb-3">Nomor Rekening:</span>
                                    <span class="d-block mb-3">Nama Pemilik Kartu:</span>
                                    <span class="d-block mb-3">Total Yang Harus Dibayar:</span>
                                    <span class="d-block">Bukti Transfer:</span>
                                </div>
                                <div class="col-md-5 mt-3">
                                    <span class="d-block mb-3"><?= $pembayaran['nama_pembayar'] ?></span>
                                    <span class="d-block mb-3"><?= $pembayaran['tgl_pembayaran'] ?></span>
                                    <span class="d-block mb-3"><?= $pembayaran['bank'] ?></span>
                                    <span class="d-block mb-3"><?= $pembayaran['no_rekening'] ?></span>
                                    <span class="d-block mb-3"><?= $pembayaran['nama_pemilik_kartu'] ?></span>
                                    <span class="d-block mb-3">Rp.<?= $pembayaran['total_akhir'] ?></span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <a href="../img/bukti/<?= $pembayaran['bukti'] ?>" data-toggle="lightbox" data-title="<?= $superior['fasilitas'] ?>" data-gallery="gallery" data-footer="<?= $superior['deskripsi'] ?>">
                                        <img src="../img/bukti/<?= $pembayaran['bukti'] ?>" alt="<?= $pembayaran['bukti'] ?>" class="img-fluid img-thumbnail">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
    <script>
        $(document).ready(function() {
            $('.datatab').DataTable();
        });

        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
</body>

</html>