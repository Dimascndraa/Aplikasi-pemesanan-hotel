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
        document.location.href = './edit-profile.php?page=edit-profile&pesan=berhasil-ubah-password';
        </script>";
    } else {
        echo "<script>
        document.location.href = '?page=ubah-password&pesan=gagal-ubah-password';
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
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" style="background-color: #e8f0fe;" name='password-lama' class="form-control" value="<?= @$_SESSION['password-lama'] ?>" required placeholder="Password Lama">
                                                            <div class="input-group-append">
                                                                <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="password" class="form-label fw-bold">Password Baru</label>
                                                        <div class="input-group" id="show_hide_password_2">
                                                            <input type="password" style="background-color: #e8f0fe;" name='password' class="form-control" value="<?= @$_SESSION['password'] ?>" required placeholder="Password Baru">
                                                            <div class="input-group-append">
                                                                <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="konfirmasi-password" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                                        <div class="input-group" id="show_hide_password_3">
                                                            <input type="password" style="background-color: #e8f0fe;" name='konfirmasi-password' class="form-control" value="<?= @$_SESSION['konfirmasi-password'] ?>" required placeholder="Password Lama">
                                                            <div class="input-group-append">
                                                                <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <button type="submit" name="ubah" class="btn btn-primary d-block mt-4">Ubah Password</button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mt-3 mb-4">
                                                            <a href="edit-profile.php">Kembali ke halaman sebelumnya</a>
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

    <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] == 'gagal-ubah-password') : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops..!',
                        text: 'Password gagal diubah!',
                        footer: 'Coba cek kembali data yang diinputkan!'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == 'password-lama-salah') : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops..!',
                        text: 'Password gagal diubah!',
                        footer: 'Password lama tidak sesuai!'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == 'konfirmasi-password-salah') : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops..!',
                        text: 'Password gagal diubah!',
                        footer: 'Konfirmasi password tidak sesuai!'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <?php include "layout/bawah.php" ?>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi bi-eye-slash");
                    $('#show_hide_password i').removeClass("bi bi-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi bi-eye-slash");
                    $('#show_hide_password i').addClass("bi bi-eye");
                }
            });
            $("#show_hide_password_2 a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password_2 input').attr("type") == "text") {
                    $('#show_hide_password_2 input').attr('type', 'password');
                    $('#show_hide_password_2 i').addClass("bi bi-eye-slash");
                    $('#show_hide_password_2 i').removeClass("bi bi-eye");
                } else if ($('#show_hide_password_2 input').attr("type") == "password") {
                    $('#show_hide_password_2 input').attr('type', 'text');
                    $('#show_hide_password_2 i').removeClass("bi bi-eye-slash");
                    $('#show_hide_password_2 i').addClass("bi bi-eye");
                }
            });
            $("#show_hide_password_3 a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password_3 input').attr("type") == "text") {
                    $('#show_hide_password_3 input').attr('type', 'password');
                    $('#show_hide_password_3 i').addClass("bi bi-eye-slash");
                    $('#show_hide_password_3 i').removeClass("bi bi-eye");
                } else if ($('#show_hide_password_3 input').attr("type") == "password") {
                    $('#show_hide_password_3 input').attr('type', 'text');
                    $('#show_hide_password_3 i').removeClass("bi bi-eye-slash");
                    $('#show_hide_password_3 i').addClass("bi bi-eye");
                }
            });
        });
    </script>
</body>

</html>