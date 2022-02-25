<?php
session_start();
include "../logic/functions.php";

if (!$_GET['page']) {
    header("Location: ?page=dashboard");
}

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $idCookie = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id = $idCookie");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['level'] = "admin";
        $_SESSION['login'] = 2;
    }
}

if (!isset($_COOKIE['login'])) {
    $_COOKIE['login'] = "0";
    if ($_SESSION['login'] !== 2 && $_SESSION['login'] !== 3) {
        header("location: ../");
    }
} else if ($_COOKIE['login'] == "1") {
    header("location: ../");
}

// var_dump($result);
// if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
//     header("location: ../logic/login.php?pesan=login");
// }



$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$hotel = query("SELECT * FROM identitas")[0];
$jmlPelanggan = query("SELECT COUNT(*) FROM pelanggan")[0]["COUNT(*)"];
$jmlPegawai = query("SELECT COUNT(*) FROM pegawai")[0]["COUNT(*)"];
$jmlKamar = query("SELECT COUNT(*) FROM kamar")[0]["COUNT(*)"];
$jmlKamarTersedia = query("SELECT COUNT(*) FROM kamar WHERE status = 'tersedia'")[0]["COUNT(*)"];
$jmlKamarDipesan = query("SELECT COUNT(*) FROM kamar WHERE status = 'dipesan' OR status = 'terisi'")[0]["COUNT(*)"];
$jmlPemesanan = query("SELECT COUNT(*) FROM pemesanan")[0]["COUNT(*)"];
$jmlDibatalkan = query("SELECT COUNT(*) FROM pemesanan WHERE status = 'batal'")[0]["COUNT(*)"];
$jmlTransaksiSukses = query("SELECT COUNT(*) FROM pemesanan WHERE status = 'berhasil'")[0]["COUNT(*)"];
$jmlPembayaran = query("SELECT COUNT(*) FROM pembayaran")[0]["COUNT(*)"];
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
                            <h1 class="m-0">Dashboard</h1>
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
                    <!-- Small boxes (Stat box) -->
                    <div class="row justify-content-center">
                        <?php if ($data['role'] == "admin") : ?>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box text-white" style="background-color: #7cd1b8;">
                                    <div class="inner">
                                        <h3 class="fw-light h5">Hotel</h3>

                                        <p>Identitas Hotel</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-hotel"></i>
                                    </div>
                                    <a href="identitas.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        <?php endif; ?>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-white" style="background-color: #DE834D;">
                                <div class="inner">
                                    <h3 class="fw-light h5">Profil</h3>

                                    <p>Profil Saya</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-address-card"></i>
                                </div>
                                <a href="profile.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-white" style="background-color: #BF8B67;">
                                <div class="inner">
                                    <h3 class="fw-light h5">Fasilitas</h3>

                                    <p>Data Fasilitas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <a href="data-fasilitas.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <?php if ($data['role'] == "admin") : ?>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box text-white" style="background-color: #BAABDA;">
                                    <div class="inner">
                                        <h3 class="fw-light h5">Fasilitas</h3>

                                        <p>Tambah Fasilitas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <a href="tambah-fasilitas.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        <?php endif; ?>
                        <?php if ($data['role'] == "admin") : ?>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box text-white" style="background-color: #8267BE;">
                                    <div class="inner">
                                        <h3 class="fw-light h5">Kamar</h3>

                                        <p>Input Kamar</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <a href="tambah-kamar.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        <?php endif; ?>
                        <?php if ($data['role'] == "admin") : ?>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box text-white" style="background-color: #655d8a;">
                                    <div class="inner">
                                        <h3><?= $jmlPelanggan; ?></h3>

                                        <p>Pelanggan</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <a href="data-user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        <?php endif; ?>
                        <?php if ($data['role'] == "admin") : ?>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box text-white" style="background-color: #7897ab;">
                                    <div class="inner">
                                        <h3><?= $jmlPegawai; ?></h3>

                                        <p>Pegawai</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-cog"></i>
                                    </div>
                                    <a href="data-user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        <?php endif; ?>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-white" style="background-color: #D885A3;">
                                <div class="inner">
                                    <h3><?= $jmlKamar; ?></h3>

                                    <p>Data Kamar</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-door-closed"></i>
                                </div>
                                <a href="data-kamar.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-white" style="background-color: #EEC373;">
                                <div class="inner">
                                    <h3><?= $jmlPemesanan; ?></h3>

                                    <p>Data Pemesanan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dolly"></i>
                                </div>
                                <a href="data-pesanan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-white" style="background-color: #fdceb9;">
                                <div class="inner">
                                    <h3><?= $jmlKamarTersedia; ?></h3>

                                    <p>Kamar Kosong</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <a href="stok-kamar.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-white" style="background-color: #C0D8C0;">
                                <div class="inner">
                                    <h3><?= $jmlKamarDipesan; ?></h3>

                                    <p>Kamar Dipesan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <a href="kamar-terisi.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-dark" style="background-color: #F2FFE9;">
                                <div class="inner">
                                    <h3><?= $jmlPembayaran; ?></h3>

                                    <p>Data Pembayaran</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <a href="data-pembayaran.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-white" style="background-color: #6ECB63;">
                                <div class="inner">
                                    <h3><?= $jmlTransaksiSukses; ?></h3>

                                    <p>Transaksi Sukses</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-white" style="background-color: #b91646;">
                                <div class="inner">
                                    <h3><?= $jmlDibatalkan; ?></h3>

                                    <p>Pemesanan Dibatalkan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->

                    <!-- /.row (main row) -->
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

    <?php if (isset($_GET['popup'])) : ?>
        <!-- Identitas Hotel -->
        <?php if ($_GET['popup'] == "ib") : ?>
            <div class="container">
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
                            title: 'Identitas berhasil diubah!'
                        })
                    }, delayInMilliseconds);
                </script>
            </div>
        <?php endif; ?>

        <?php if ($_GET['popup'] == "ig") : ?>
            <div class="container">
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
                            icon: 'error',
                            title: 'Identitas gagal diubah!'
                        })
                    }, delayInMilliseconds);
                </script>
            </div>
        <?php endif; ?>
        <!-- Akhir Identitas Hotel -->

        <!-- Sosial Media -->
        <?php if ($_GET['popup'] == "sb") : ?>
            <div class="container">
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
                            title: 'Sosial media berhasil diubah!'
                        })
                    }, delayInMilliseconds);
                </script>
            </div>
        <?php endif; ?>

        <!-- Akhir Sosial Media -->
    <?php endif; ?>

    <?php include "layout/bawah.php" ?>
</body>

</html>