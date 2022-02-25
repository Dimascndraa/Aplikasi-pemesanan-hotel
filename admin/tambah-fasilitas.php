<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=tambah-fasilitas");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
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
                            <h1 class="m-0">Tambah Fasilitas</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Tambah Fasilitas </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <form action="proses-tambah-fasilitas.php?page=tambah-fasilitas" method="post" autocomplete="off">
                        <div class="container card p-5 col-lg-8">

                            <div class="row justify-content-center mb-3">
                                <div class="col-lg-12 text-center">
                                    <label for="tipe-kamar" class="form-label">
                                        <h5>Tipe Kamar</h5>
                                    </label>
                                </div>
                                <div class="col-lg-7 m-auto">
                                    <select name="tipe" id="tipe-kamar" class="form-select" required>
                                        <option value="" disabled selected>Pilih Jenis Kamar</option>
                                        <option value="Superior">Superior</option>
                                        <option value="Deluxe">Deluxe</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <button class="btn btn-primary w-50 m-auto mt-5" name="submit" type="submit">Tambah</button>
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