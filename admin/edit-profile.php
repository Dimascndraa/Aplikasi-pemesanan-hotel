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
    if (ubahProfilePetugas($_POST) > 0) {
        echo "<script>
        document.location.href = './profile.php?page=profile&pesan=berhasil-ubah-profile';
        </script>";
    } else {
        echo "<script>
            document.location.href = '?page=profile&pesan=gagal-ubah-profile';
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
                                        <div class="card card-primary card-outline p-2">
                                            <div class="card-body box-profile text-center">
                                                <img src="../img/profil/<?= $data['foto'] ?>" class="img-fluid rounded-circle img-preview" alt="">
                                            </div>
                                            <div class="card-header">
                                                <h5 class="text-center profile-username"><?= $data['nama'] ?></h5>
                                                <p class="text-muted text-center"><?= ucfirst($data['role']) ?></p>
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
                                        </div>
                                    </div>
                                    <div class="col-lg-9 mb-3">
                                        <div class="card card-primary card-outline px-5 pt-3">
                                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                            <input type="hidden" name="foto-lama" value="<?= $data['foto'] ?>">
                                            <input type="hidden" name="jenis-kelamin" value="<?= $data['jenis_kelamin'] ?>">

                                            <div class="col-lg-12 mb-3">
                                                <label for="foto" class="form-label">Foto</label>
                                                <input style="background-color: #e8f0fe;" type="file" name="foto" onchange="previewImage()" class="form-control foto" id="foto">
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input value="<?= $data['nama'] ?>" style="background-color: #e8f0fe;" type="text" name="nama" class="form-control" id="nama" required placeholder="Masukkan Nama">
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input value="<?= $data['email'] ?>" style="background-color: #e8f0fe;" type="text" name="email" class="form-control" id="email" required placeholder="Masukkan Nama">
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input value="<?= $data['username'] ?>" style="background-color: #e8f0fe;" type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" required>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label for="telp" class="form-label">No HP</label>
                                                <input value="<?= $data['telp'] ?>" style="background-color: #e8f0fe;" type="text" name="telp" class="form-control" id="telp" placeholder="Masukkan No HP" required>
                                            </div>

                                            <div class="col-lg-12 mb-3 <?= $data['role'] == "resepsionis" ? 'd-none' : '' ?>">
                                                <label for="level" class="form-label" name="level">Level</label>
                                                <select class="form-select" style="background-color: #e8f0fe;" name="level" id="level">
                                                    <option>Pilih Level</option>
                                                    <option <?= $level == "admin" ? 'selected' : '' ?> value="admin">Admin</option>
                                                    <option <?= $level == "resepsionis" ? 'selected' : '' ?> value="Resepsionis">Resepsionis</option>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 mt-2">
                                                    <button class="btn btn-primary w-100 d-block m-auto" name="ubah" type="submit">Ubah</button>
                                                </div>
                                                <div class="col-6 mt-2">
                                                    <a href="ubah-password.php" class="btn btn-primary w-100 d-block m-auto">Ubah Password</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mt-3 mb-4 text-center">
                                                    <a href="profile.php">Kembali ke halaman sebelumnya</a>
                                                </div>
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
        <?php if ($_GET['pesan'] == 'gagal-ubah-profile') : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Profile gagal diubah!',
                        text: 'Coba cek kembali data yang diinputkan!',
                        footer: 'Atau mungkin anda tidak mengubah apapun'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == 'berhasil-ubah-password') : ?>
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
                        title: 'Password berhasil diubah!'
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
        });

        function previewImage() {
            const foto = document.querySelector('.foto');
            const imgPreview = document.querySelector('.img-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };

        }
    </script>
</body>

</html>