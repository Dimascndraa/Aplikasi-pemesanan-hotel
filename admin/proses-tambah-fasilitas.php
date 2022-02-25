<?php
session_start();

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";
if (isset($_POST['tambah'])) {
    if (tambahFasilitas($_POST) > 0) {
        echo "<script>
                document.location.href= './data-fasilitas.php?page=data-fasilitas&pesan=berhasil-tambah-fasilitas';
              </script>";
    } else {
        echo "<script>
                document.location.href= './tambah-fasilitas.php?page=tambah-fasilitas&pesan=gagal-tambah-fasilitas';
              </script>";
    }
}

$jenisKamar = $_POST['tipe'];
$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$dataKamar = query("SELECT * FROM kamar WHERE jenis_kamar = '$jenisKamar'")[0];
$nomorKamar = query("SELECT no_kamar FROM kamar ORDER BY id DESC LIMIT 1")[0]['no_kamar'];
$nomorKamar = intval($nomorKamar) + 1;
$tarif = $dataKamar['tarif'];
$hotel = query("SELECT * FROM identitas")[0];
if ($data['role'] == "resepsionis") {
    header("location: ../admin/");
}
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
                            <h1 class="m-0">Input Data Kamar</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Input Data Kamar </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="container card p-5 col-lg-8">
                        <h3 class="text-center">Tambah Fasilitas</h3>
                        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="tipe-kamar" class="form-label">Tipe Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input readonly value="<?= $dataKamar['jenis_kamar']; ?>" type="text" class="form-control" name="tipe-kamar" id="tipe-kamar" placeholder="Id Stok Kamar">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="gambar" class="form-label">Gambar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="file" class="form-control" name="gambar" id="gambar">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="fasilitas" class="form-label">Fasilitas</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="fasilitas" id="fasilitas">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                </div>
                                <div class="col-lg-6">
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <button class="btn btn-primary w-50 m-auto mt-5" type="submit" name="tambah">Tambah</button>
                            </div>

                        </form>
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
</body>

</html>