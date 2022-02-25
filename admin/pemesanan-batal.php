<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=pemesanan-batal");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$dataBatal = query("SELECT * FROM pemesanan WHERE status = 'batal'");
$i = 1;
$hotel = query("SELECT * FROM identitas")[0];
?>

<?php include 'layout/atas.php' ?>

<body class="hold-transition sidebar-mini layout-fixed" style="background-color: #f4f6f9;">
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
                            <h1 class="m-0">Transaksi Batal</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Transaksi Batal </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="container">
                        <div class="row mt-5"></div>
                        <div class="col-lg-6 m-auto">
                            <?php foreach ($dataBatal as $batal) : ?>
                                <div class="card border border-danger p-5 pb-3 mb-3">
                                    <div class="row justify-content-center">
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-lg-12">
                                                <h5 class="text-center mb-3">Pemesanan <?= $i++ ?></h5>
                                            </div>
                                            <div class="col-6 text-end">
                                                Tanggal Pemesanan:
                                            </div>
                                            <div class="col-6">
                                                <?= tanggal_indonesia($batal['tgl_pemesanan']); ?>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center  mb-3">
                                            <div class="col-6 text-end">
                                                Tanggal Check In:
                                            </div>
                                            <div class="col-6">
                                                <?= tanggal_indonesia($batal['tgl_cek_in']); ?>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                Tanggal Check Out:
                                            </div>
                                            <div class="col-6">
                                                <?= tanggal_indonesia($batal['tgl_cek_out']); ?>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                Tipe Kamar:
                                            </div>
                                            <div class="col-6">
                                                <?= $batal['tipe_kamar']; ?>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                Harga Permalam:
                                            </div>
                                            <div class="col-6">
                                                Rp.<?= $batal['harga_permalam']; ?>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                Jumlah Kamar:
                                            </div>
                                            <div class="col-6">
                                                <?= $batal['jumlah_kamar']; ?> Kamar
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                Nama Pemesan:
                                            </div>
                                            <div class="col-6">
                                                <?= $batal['nama_pemesan']; ?>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                Alamat:
                                            </div>
                                            <div class="col-6">
                                                <?= $batal['alamat']; ?>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                No. Telepon:
                                            </div>
                                            <div class="col-6">
                                                <?= $batal['telp']; ?>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                Durasi Menginap:
                                            </div>
                                            <div class="col-6">
                                                <?= $batal['durasi_menginap']; ?> Malam
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                Total Biaya:
                                            </div>
                                            <div class="col-6">
                                                Rp.<?= $batal['total_biaya']; ?>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-6 text-end">
                                                Status:
                                            </div>
                                            <div class="col-6">
                                                <?= ucfirst($batal['status']); ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>

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

    <!-- jQuery -->
    <script src="../src/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../src/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="../src/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../src/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../src/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../src/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../src/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../src/plugins/moment/moment.min.js"></script>
    <script src="../src/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../src/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../src/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../src/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../src/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../src/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../src/dist/js/pages/dashboard.js"></script>

</body>

</html>