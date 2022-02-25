<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=konfirmasi-pesanan");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

if (isset($_POST['terima'])) {
    $id = $_POST['id'];
    $jumlah = $_POST['jumlah'];
    $query = "UPDATE pemesanan SET status = 'berhasil' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    if ($result > 0) {
        echo "<script>
        alert('Pesanan Berhasil Diterima');
        </script>";
    }
}


if (isset($_POST['batal'])) {
    $id = $_POST['id'];
    $tipe = $_POST['tipe'];
    $jumlah = $_POST['jumlah'];
    $query = "UPDATE pemesanan SET status = 'batal' WHERE id = '$id'";

    $result = mysqli_query($koneksi, $query);
    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok + '$jumlah' WHERE tipe = '$tipe'");
    if ($result > 0) {
        echo "<script>
                alert('Pesanan Berhasil Dibatalkan');
                document.location.href= './';
            </script>";
    }
}

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$dataPesanan = query("SELECT * FROM pemesanan WHERE status = 'pending' ORDER BY id DESC");
$i = 1;
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
                            <h1 class="m-0">Konfirmasi Pesanan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Konfirmasi Pesanan </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content pb-5">
                <div class="container-fluid">
                    <div class="container">
                        <?php if ($dataPesanan) : ?>
                            <div class="col-lg-6 m-auto">
                                <?php foreach ($dataPesanan as $pesanan) : ?>
                                    <div class="card p-5 pb-3 border <?= $pesanan['status'] == "berhasil" ? 'border-success' : (($pesanan['status'] == 'batal') ? 'border-danger' : '') ?>">
                                        <div class="row justify-content-center">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-12">
                                                    <h5 class="text-center mb-3">Pesanan <?= $i++; ?></h5>
                                                </div>
                                                <div class="col-6 text-end">
                                                    Tanggal Pemesanan:
                                                </div>
                                                <div class="col-6">
                                                    <?= tanggal_indonesia($pesanan['tgl_pemesanan']); ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Tanggal Check In:
                                                </div>
                                                <div class="col-6">
                                                    <?= tanggal_indonesia($pesanan['tgl_cek_in']); ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Tanggal Check Out:
                                                </div>
                                                <div class="col-6">
                                                    <?= tanggal_indonesia($pesanan['tgl_cek_out']); ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Tipe Kamar:
                                                </div>
                                                <div class="col-6">
                                                    <?= $pesanan['tipe_kamar']; ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Harga / Malam:
                                                </div>
                                                <div class="col-6">
                                                    Rp. <?= $pesanan['harga_permalam']; ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Jumlah Kamar:
                                                </div>
                                                <div class="col-6">
                                                    <?= $pesanan['jumlah_kamar']; ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Nama Pemesan:
                                                </div>
                                                <div class="col-6">
                                                    <?= $pesanan['nama_pemesan']; ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Alamat:
                                                </div>
                                                <div class="col-6">
                                                    <?= $pesanan['alamat']; ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    No Handpone:
                                                </div>
                                                <div class="col-6">
                                                    <?= $pesanan['telp']; ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Durasi Menginap:
                                                </div>
                                                <div class="col-6">
                                                    <?= $pesanan['durasi_menginap']; ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Total Biaya:
                                                </div>
                                                <div class="col-6">
                                                    Rp. <?= $pesanan['total_biaya']; ?>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-6 text-end">
                                                    Status:
                                                </div>
                                                <div class="col-6">
                                                    <?= $pesanan['status'] == 'pending' ? 'Menunggu Konfirmasi..' : ''  ?>
                                                </div>
                                            </div>
                                            <?php if ($pesanan['status'] == "pending") : ?>
                                                <form action="" method="post">
                                                    <input type="hidden" name="jumlah" value="<?= $pesanan['jumlah_kamar'] ?>">
                                                    <input type="hidden" name="tipe" value="<?= $pesanan['tipe_kamar'] ?>">
                                                    <input type="hidden" name="id" value="<?= $pesanan['id'] ?>">
                                                    <div class="row justify-content-center">
                                                        <div class="col-6">
                                                            <button class="btn w-100 mt-3 btn-success" name="terima">Terima</button>
                                                        </div>
                                                        <div class="col-6">
                                                            <button class="btn w-100 mt-3 btn-danger" name="batal">Batal</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div class="row row-cols-1 mt-5">
                                <div class="col">
                                    <h5 class="text-center p-3 text-muted">Tidak ada pesanan</h5>
                                </div>
                            </div>
                        <?php endif; ?>
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