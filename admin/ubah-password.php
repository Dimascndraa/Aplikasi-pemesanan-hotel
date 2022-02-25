<?php
session_start();
include "../logic/functions.php";

if (!$_GET['page']) {
    header("Location: ?page=profile");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

if (isset($_POST['ubah'])) {
    if (ubahPasswordPegawai($_POST) > 0) {
        echo "<script>
        alert('Password Berhasil Diubah');
        document.location.href = './';
        </script>";
    } else {
        echo "<script>
        alert('Password Gagal Diubah');
        </script>";
    }
}

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$hotel = query("SELECT * FROM identitas")[0];
$level = $data['role'];
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
                            <h1 class="m-0">Edit Profile</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Profile </li>
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
                        <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="container">
                                <div class="row g-3">
                                    <div class="col-lg-3">
                                        <div class="card p-2">
                                            <div class="card-body text-center">
                                                <img src="../img/profil/<?= $data['foto'] ?>" class="img-fluid rounded-circle img-preview" alt="">
                                            </div>
                                            <div class="card-header">
                                                <h5 class="text-center"><?= $data['nama'] ?></h5>
                                            </div>
                                            <div class="card-header">
                                                <span class="d-block text-center fw-bold">Username</span>
                                                <span class="d-block text-center"><?= $data['username'] ?></span>
                                            </div>
                                            <div class="card-header">
                                                <span class="d-block text-center fw-bold">Email</span>
                                                <span class="d-block text-center"><?= $data['email'] ?></span>
                                            </div>
                                            <div class="card-header">
                                                <span class="d-block text-center fw-bold">No Handphone</span>
                                                <span class="d-block text-center"><?= $data['telp'] ?></span>
                                            </div>
                                            <div class="card-header mb-3">
                                                <span class="d-block text-center fw-bold">Role</span>
                                                <span class="d-block text-center"><?= $data['role'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 mb-3">
                                        <div class="card p-5">
                                            <h5 class="text-start">Ubah Password</h5>
                                            <hr class="w-25">
                                            <div class="col-12 mt-4">
                                                <form autocomplete="off" action="" method="post" class="text-start">
                                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                    <div class="mb-3">
                                                        <label for="password-lama" class="form-label fw-bold">Password Lama</label>
                                                        <input style="background-color: #e8f0fe;" type="password" class="form-control" name="password-lama" id="password-lama" placeholder="Password Lama">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="password" class="form-label fw-bold">Password Baru</label>
                                                        <input style="background-color: #e8f0fe;" type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="konfirmasi-password" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                                        <input style="background-color: #e8f0fe;" type="password" class="form-control" name="konfirmasi-password" id="konfirmasi-password" placeholder="Konfirmasi Password Baru">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <button type="submit" name="ubah" class="btn btn-primary d-block mt-4">Ubah Password</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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