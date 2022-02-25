<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=data-user");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "" || $_SESSION['level'] == 'resepsionis') {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$dataPegawai = query("SELECT * FROM pegawai");
$dataPelanggan = query("SELECT * FROM pelanggan");
$hotel = query("SELECT * FROM identitas")[0];
$i = 1;
$j = 1;

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
                            <h1 class="m-0">Data User</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data User </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <h5 class="text-center">Petugas</h5>



                    <div class="row mt-3 justify-content-around">
                        <?php foreach ($dataPegawai as $pegawai) : ?>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <img src="../img/profil/default-laki-laki.png" class="img-fluid p-3" alt="">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body">
                                                <div class="mb-3" style="margin-top: -.5rem;">
                                                    <h5 class="text-center pb-2" style="border-bottom: 1px solid #ccc;"><?= $pegawai['nama'] ?></h5>
                                                </div>
                                                <div class="row row-cols-2 mb-2">
                                                    <span class="card-text fw-bold">Username</span>
                                                    <span class="card-text"><?= $pegawai['username'] ?></span>
                                                </div>
                                                <div class="row row-cols-2 mb-2">
                                                    <span class="card-text fw-bold">No Handphone</span>
                                                    <span class="card-text"><?= $pegawai['telp'] ?></span>
                                                </div>
                                                <div class="row row-cols-2 mb-2">
                                                    <span class="card-text fw-bold">Role</span>
                                                    <span class="card-text"><?= $pegawai['role'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <h5 class="text-center mt-5">Pelanggan</h5>
                    <div class="row mt-3">
                        <?php foreach ($dataPelanggan as $pelanggan) : ?>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <img src="../img/profil/<?= $pelanggan['foto'] ?>" class="img-fluid p-4" alt="">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body">
                                                <div class="mb-3" style="margin-top: -.5rem;">
                                                    <h5 class="text-center pb-2" style="border-bottom: 1px solid #ccc;"><?= $pelanggan['nama'] ?></h5>
                                                </div>
                                                <div class="row row-cols-2 mb-1">
                                                    <span class="card-text fw-bold">Username</span>
                                                    <span class="card-text"><?= $pelanggan['username'] ?></span>
                                                </div>
                                                <div class="row row-cols-2 mb-1">
                                                    <span class="card-text fw-bold">Jenis Kelamin</span>
                                                    <span class="card-text"><?= ucfirst($pelanggan['jenis_kelamin']) ?></span>
                                                </div>
                                                <div class="row row-cols-2 mb-1">
                                                    <span class="card-text fw-bold">No Handphone</span>
                                                    <span class="card-text"><?= $pelanggan['telp'] ?></span>
                                                </div>
                                                <div class="row row-cols-1 mb-1 mt-3">
                                                    <span class="card-text fw-bold">Alamat</span>
                                                    <span class="card-text"><?= $pelanggan['alamat'] ?></span>
                                                </div>
                                                <div class="row row-cols-1 mb-1">
                                                    <span class="card-text fw-bold">Email:</span>
                                                    <span class="card-text"><?= $pelanggan['email'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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

    <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] == 'berhasil-tambah-user') : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Petugas berhasil ditambahkan!'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <?php include "layout/bawah.php" ?>
</body>

</html>