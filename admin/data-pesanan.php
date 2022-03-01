<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=data-pesanan");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

if (isset($_POST['batal'])) {
    if (batalkanPesanan($_POST) > 0) {
        echo "<script>
              alert('data berhasil dibatalkan');
              document.location.href = '?page=detail-pemesanan';
           </script>";
    } else {
        echo "<script>
              alert('data berhasil dibatalkan');
              document.location.href = '?page=detail-pemesanan';
           </script>";
    }
}

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];

$dataPemesanan = query("SELECT * FROM pemesanan");
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
                            <h1 class="m-0">Data Pesanan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Pesanan </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php if (count($dataPemesanan) > 0) : ?>
                        <table id="table" class="table table-striped hover" style="width:100%">
                            <thead class="text-center bg-primary">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pemesan</th>
                                    <th scope="col">Tipe Kamar</th>
                                    <th scope="col">Jumlah Kamar</th>
                                    <th scope="col">Lama Inap</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataPemesanan as $pemesanan) : ?>
                                    <tr class="text-center">
                                        <td><?= $i++; ?></td>
                                        <td><?= $pemesanan['nama_pemesan'] ?></td>
                                        <td><?= $pemesanan['tipe_kamar'] ?></td>
                                        <td><?= $pemesanan['jumlah_kamar'] ?> Kamar</td>
                                        <td><?= $pemesanan['durasi_menginap'] ?> Malam</td>
                                        <td><?= ucfirst($pemesanan['status']) ?></td>
                                        <td>
                                            <a href="detail-pemesanan.php?id=<?= $pemesanan['id']; ?>" class="btn btn-primary mx-2">Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <h5 class="text-muted text-center"> *Belum ada pesanan </h5>
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
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
</body>

</html>