<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=profile");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
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
                            <h1 class="m-0">Profil Saya</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Profil Saya </li>
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
                        <div class="col-lg-8 m-auto">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <img src="../img/profil/<?= $data['foto'] ?>" class="img-circle p-4 w-100 d-block ml-auto" alt="<?= $data['foto']; ?>">
                                    </div>
                                    <div class="col-lg-7 p-4">
                                        <span class="lead d-block tengah mt-2">Nama: <?= $data['nama'] ?></span>
                                        <span class="lead d-block tengah mt-2">Username: <?= $data['username'] ?></span>
                                        <span class="lead d-block tengah mt-2">Role: <?= $data['role'] ?></span>
                                        <span class="lead d-block tengah mt-2">No HP: <?= $data['telp'] ?></span>
                                        <a href="edit-profile.php" class="btn btn-outline-primary mt-4 tengah d-block me-lg-5"><i class="fas fa-edit"></i> Edit Profile</a>
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

    <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] == 'berhasil-ubah-profile') : ?>
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
                        title: 'Profile berhasil diubah!'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <?php include "layout/bawah.php" ?>
</body>

</html>