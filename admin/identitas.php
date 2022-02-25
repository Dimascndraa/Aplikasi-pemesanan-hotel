<?php
session_start();
include "../logic/functions.php";

if (!$_GET['page']) {
    header("Location: ?page=identitas");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "" || $_SESSION['level'] == "resepsionis") {
    header("location: ../logic/login.php?pesan=login");
}

if (isset($_POST['ubah'])) {
    if (ubahIdentitasHotel($_POST) > 0) {
        echo "<script>
        document.location.href = './?page=dashboard&popup=ib';
        </script>";
    } else {
        echo "<script>
        document.location.href = './?page=dashboard&popup=ig';
        </script>";
    }
}

if (isset($_POST['sosial'])) {
    if (ubahSosialMedia($_POST) > 0) {
        echo "<script>
        document.location.href = './?page=dashboard&popup=sb';
        </script>";
    } else {
        echo "<script>
        document.location.href = './?page=dashboard&popup=sg';
        </script>";
    }
}


$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$hotel = query("SELECT * FROM identitas")[0];
$sosialMedia = query("SELECT * FROM sosial_media")[0];

$noHp = $sosialMedia['whatsapp'];
$hasil = str_replace("+62", "0", $noHp);
$whatsapp = "+62" . "-" . substr($hasil, 2, 3) . "-" . substr($hasil, 5, 4) . "-" . substr($hasil, 9, 4);

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
                            <h1 class="m-0">Identitas Hotel</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <?php
                    ?>

                    <div class="card pb-5" style="background-color: #eeeeea;">
                        <h1 class="text-center pt-4"><?= $hotel['nama_hotel'] ?></h1>
                        <div class="row justify-content-center p-lg-5 m-auto">
                            <div class="col-12 col-lg-6 mt-lg-0 mt-5">
                                <h5 class="text-center">Logo Primary</h5>
                                <hr style="width: 10rem; margin: auto;">
                                <img src="../img/logo/<?= $hotel['logo_primary'] ?>" class="w-50 p-3 d-block m-auto" alt="<?= $hotel['logo_primary'] ?>">
                            </div>
                            <div class="col-12 col-lg-6 mt-lg-0 mt-5">
                                <h5 class="text-center">Logo Secondary</h5>
                                <hr style="width: 10rem; margin: auto;">
                                <img src="../img/logo/<?= $hotel['logo_secondary'] ?>" class="w-50 p-3 d-block m-auto" alt="<?= $hotel['logo_secondary'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card p-3">
                                <div class="card-header">
                                    <h5 class="text-start">Identitas Hotel</h5>
                                </div>
                                <div class="card-header text-center mt-3">
                                    <label class="form-label text-center">Nama Hotel</label>
                                    <p class="text-muted"><?= $hotel['nama_hotel'] ?></p>
                                </div>
                                <div class="card-header text-center mt-3">
                                    <label class="form-label text-center">Alamat Hotel</label>
                                    <p class="text-muted"><?= $hotel['alamat'] ?></p>
                                </div>
                                <div class="card-header text-center mt-3">
                                    <label class="form-label text-center">Email Hotel</label>
                                    <p class="text-muted"><?= $hotel['email'] ?></p>
                                </div>
                                <div class="card-header text-center mt-3">
                                    <label class="form-label text-center">Nomor Telepon</label>
                                    <p class="text-muted"><?= $hotel['telp'] ?></p>
                                </div>
                                <div class="card-header text-center my-3">
                                    <label class="form-label text-center">Nomor Rekening</label>
                                    <p class="text-muted"><?= $hotel['no_rekening'] ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card p-3">
                                <div class="card-header">
                                    <h5 class="text-start">Ubah Identitas</h5>
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="logo-primary-lama" value="<?= $hotel['logo_primary'] ?>">
                                    <input type="hidden" name="logo-secondary-lama" value="<?= $hotel['logo_secondary'] ?>">
                                    <div class="card-header mt-3">
                                        <label for="logo-primary" class="form-label">Logo Primary</label>
                                        <input type="file" name="logo-primary" id="logo-primary" class="form-control">
                                    </div>
                                    <div class="card-header mt-3">
                                        <label for="logo-secondary" class="form-label">Logo Secondary</label>
                                        <input type="file" name="logo-secondary" id="logo-secondary" class="form-control">
                                    </div>
                                    <div class="card-header mt-3">
                                        <label for="nama-hotel" class="form-label">Nama Hotel</label>
                                        <input required type="text" name="nama-hotel" id="nama-hotel" placeholder="Nama Hotel" class="form-control" value="<?= $hotel['nama_hotel'] ?>">
                                    </div>
                                    <div class="card-header mt-3">
                                        <label for="alamat-hotel" class="form-label">Alamat Hotel</label>
                                        <input required type="text" name="alamat-hotel" id="alamat-hotel" placeholder="Alamat Hotel" class="form-control" value="<?= $hotel['alamat'] ?>">
                                    </div>
                                    <div class="card-header mt-3">
                                        <label for="email-hotel" class="form-label">Email Hotel</label>
                                        <input required type="text" name="email-hotel" id="email-hotel" placeholder="Email Hotel" class="form-control" value="<?= $hotel['email'] ?>">
                                    </div>
                                    <div class="card-header mt-3">
                                        <label for="telp-hotel" class="form-label">Nomor Telepon</label>
                                        <input required type="text" name="telp-hotel" id="telp-hotel" placeholder="Nomor Telepon" class="form-control" value="<?= $hotel['telp'] ?>">
                                    </div>
                                    <div class="card-header my-3">
                                        <label for="rekening-hotel" class="form-label">Nomor Rekening</label>
                                        <input required type="text" name="rekening-hotel" id="rekening-hotel" placeholder="Nomor Rekening" class="form-control" value="<?= $hotel['no_rekening'] ?>">
                                    </div>
                                    <div class="card-header my-3">
                                        <button class="btn btn-primary w-50" name="ubah" style="margin-top: -1rem;">Ubah Identitas</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card p-3">
                                    <div class="card-header">
                                        <h5 class="text-start">Sosial Media</h5>
                                    </div>
                                    <div class="card-header text-center mt-3">
                                        <label class="form-label text-center">Facebook</label>
                                        <p class="text-muted"><?= $sosialMedia['facebook'] ?></p>
                                    </div>
                                    <div class="card-header text-center mt-3">
                                        <label class="form-label text-center">Instagram</label>
                                        <p class="text-muted">@<?= $sosialMedia['instagram'] ?></p>
                                    </div>
                                    <div class="card-header text-center mt-3">
                                        <label class="form-label text-center">Whatsapp</label>
                                        <p class="text-muted"><?= $whatsapp ?></p>
                                    </div>
                                    <div class="card-header text-center mt-3">
                                        <label class="form-label text-center">Twitter</label>
                                        <p class="text-muted"><?= $sosialMedia['twitter'] ?></p>
                                    </div>
                                    <div class="card-header text-center mt-3">
                                        <label class="form-label text-center">Email</label>
                                        <p class="text-muted"><?= $hotel['email'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card p-3">
                                    <div class="card-header">
                                        <h5 class="text-start">Sosial Media</h5>
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        <div class="card-header mt-3">
                                            <label for="facebook" class="form-label">Facebook</label>
                                            <input required type="text" name="facebook" id="facebook" placeholder="Facebook" class="form-control" value="<?= $sosialMedia['facebook'] ?>">
                                        </div>
                                        <div class="card-header mt-3">
                                            <label for="whatsapp" class="form-label">Whatsapp</label>
                                            <input required type="text" name="whatsapp" id="whatsapp" placeholder="Whatsapp" class="form-control" value="<?= $sosialMedia['whatsapp'] ?>">
                                        </div>
                                        <div class="card-header mt-3">
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input required type="text" name="instagram" id="instagram" placeholder="Instagram" class="form-control" value="<?= $sosialMedia['instagram'] ?>">
                                        </div>
                                        <div class="card-header mt-3">
                                            <label for="twitter" class="form-label">Twitter</label>
                                            <input required type="text" name="twitter" id="twitter" placeholder="Twitter" class="form-control" value="<?= $sosialMedia['twitter'] ?>">
                                        </div>
                                        <div class="card-header my-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input required type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?= $hotel['email'] ?>">
                                        </div>
                                        <div class="card-header my-3">
                                            <button class="btn btn-primary w-50" name="sosial" style="margin-top: -1rem;">Ubah Sosial Media</button>
                                        </div>
                                    </form>
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

    <?php include "layout/bawah.php" ?>
</body>

</html>