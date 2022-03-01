<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=input-kamar");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$dataKamar = query("SELECT * FROM kamar");
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

                    <div class="container card card-primary card-outline p-5 col-lg-8">
                        <h3 class="text-center">Tambah Data Kamar</h3>
                        <form action="proses-tambah-kamar.php?page=input-kamar" method="post" autocomplete="off">

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="tipe-kamar" class="form-label">
                                        <h5>Tipe Kamar</h5>
                                    </label>
                                </div>
                                <div class="col-lg-6">
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