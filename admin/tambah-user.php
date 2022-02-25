<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=tambah-user");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "" || $_SESSION['level'] == "resepsionis") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$hotel = query("SELECT * FROM identitas")[0];

if ($data['role'] == "resepsionis") {
    header("location: ../admin/");
}

if ($data['role'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

if (isset($_POST['tambah'])) {
    if (tambahPetugas($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href= './';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan!');
        </script>";
    }
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
                            <h1 class="m-0">Tambah Petugas</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Tambah Petugas </li>
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
                        <h3 class="text-center">Tambah Petugas</h3>
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="email" class="form-label">Email</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required type="email" class="form-control" name="email" id="email" placeholder="cth: dimasbomz13@gmail.com">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="username" class="form-label">Username</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required type="text" class="form-control" name="username" id="username" placeholder="Username">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="password" class="form-label">Password</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required type="password" class="form-control" name="password" id="password" placeholder="Password">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="confirm-password" class="form-label">Konfirmasi Password</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Konfirmasi Password">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="telp" class="form-label">No. Telepon</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required type="telp" class="form-control" name="telp" id="telp" placeholder="cth: +6283809192165">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                                </div>
                                <div class="col-lg-6">
                                    <select name="jenis-kelamin" id="jenis-kelamin" required class="form-select">
                                        <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="role" class="form-label">Role</label>
                                </div>
                                <div class="col-lg-6">
                                    <select name="role" id="role" required class="form-select">
                                        <option value="" selected disabled>-- Pilih Role --</option>
                                        <option value="admin">Admin</option>
                                        <option value="resepsionis">Resepsionis</option>
                                    </select>
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