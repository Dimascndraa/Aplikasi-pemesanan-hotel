<?php
session_start();
$idPemesanan = $_GET['id'];

if (!$_GET['page']) {
    header("Location: ?page=data-pesanan&id=$idPemesanan");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];

$pemesanan = query("SELECT * FROM pemesanan WHERE id = '$idPemesanan'")[0];
$bukti = query("SELECT bukti FROM pembayaran WHERE id_pemesanan = '$idPemesanan'");
$i = 1;
$hotel = query("SELECT * FROM identitas")[0];

if (isset($_POST['batal'])) {
    if (batalkanPesanan($_POST) > 0) {
        echo "<script>
              alert('data berhasil dibatalkan');
              document.location.href = 'index.php';
           </script>";
    } else {
        echo "<script>
              alert('data berhasil dibatalkan');
              document.location.href = '?page=detail-pemesanan';
           </script>";
    }
}

if (isset($_POST['konfir'])) {
    $idLagi = $_POST['id'];
    $query = "UPDATE pemesanan SET status = 'berhasil' WHERE id = '$idLagi'";
    $result = mysqli_query($koneksi, $query);
    if ($result > 0) {
        echo "<script>
        alert('Pesanan Berhasil Diterima');
        document.location.href = './';
        </script>";
    }
}

if (isset($_POST['cekout'])) {
    if (checkoutPesanan($_POST) > 0) {
        echo "<script>
            alert('Checkout Berhasil');
            document.location.href = './';
        </script>";
    } else {
        echo "<script>
        alert('Checkout Gagal');
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
                            <h1 class="m-0">Detail Pemesanan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Detail Pemesanan </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="card p-5 border <?= $pemesanan['status'] == 'berhasil' ? 'border-success' : ($pemesanan['status'] == 'batal' ? 'border-danger' : '') ?>" style="font-weight: 500;">
                                <p class="fs-4">Detail Pemesanan</p>
                                <hr style="width: 15rem; margin-top: -1rem;">
                                <div class="row justify-content-center">
                                    <div class="col-md-7 mt-3">
                                        <span class="d-block mb-3">Nama Pemesan:</span>
                                        <span class="d-block mb-3">Alamat Rumah:</span>
                                        <span class="d-block mb-3">Tanggal Pemesanan:</span>
                                        <span class="d-block mb-3">Tanggal Check In:</span>
                                        <span class="d-block mb-3">Tanggal Check Out:</span>
                                        <span class="d-block mb-3">Tipe Kamar:</span>
                                        <span class="d-block mb-3">Jumlah Kamar:</span>
                                        <span class="d-block mb-3">Durasi Menginap:</span>
                                        <span class="d-block mb-3">Harga Permalam:</span>
                                        <span class="d-block mb-3">Total Biaya:</span>
                                        <span class="d-block mb-3">Status:</span>
                                        <?php if ($pemesanan['status'] == "belum bayar") : ?>
                                            <span class="d-block mb-3">Batas Pemesanan:</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-5 mt-3">
                                        <span class="d-block mb-3"><?= $pemesanan['nama_pemesan'] ?></span>
                                        <span class="d-block mb-3"><?= $pemesanan['alamat'] ?></span>
                                        <span class="d-block mb-3"><?= tanggal_indonesia(substr($pemesanan['tgl_pemesanan'], 0, 10)) ?></span>
                                        <span class="d-block mb-3"><?= tanggal_indonesia($pemesanan['tgl_cek_in']) ?></span>
                                        <span class="d-block mb-3"><?= tanggal_indonesia($pemesanan['tgl_cek_out']) ?></span>
                                        <span class="d-block mb-3"><?= $pemesanan['tipe_kamar'] ?></span>
                                        <span class="d-block mb-3"><?= $pemesanan['jumlah_kamar'] ?></span>
                                        <span class="d-block mb-3"><?= $pemesanan['durasi_menginap'] ?> Malam</span>
                                        <span class="d-block mb-3">Rp.<?= $pemesanan['harga_permalam'] ?></span>
                                        <span class="d-block mb-3">Rp.<?= $pemesanan['total_biaya'] ?></span>
                                        <span class="d-block mb-3"><?= ucfirst($pemesanan['status']) ?></span>
                                        <?php if ($pemesanan['status'] == "belum bayar") : ?>
                                            <span class="d-block mb-3"><?= $pemesanan['batas_pembayaran'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $pemesanan['id'] ?>">
                                        <input type="hidden" name="tipe-kamar" value="<?= $pemesanan['tipe_kamar'] ?>">
                                        <input type="hidden" name="jumlah-kamar" value="<?= $pemesanan['jumlah_kamar'] ?>">
                                        <input type="hidden" name="tgl-pemesanan" value="<?= $pemesanan['tgl_pemesanan'] ?>">

                                        <?php if ($pemesanan['status'] == "belum dibayar" || $pemesanan['status'] == 'pending') : ?>
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <button type="submit" name="batal" class="btn btn-danger btn-block">Batalkan</button>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <button type="submit" name="konfir" class="btn btn-success btn-block">Konfirmasi</button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($pemesanan['status'] == "berhasil") : ?>
                                            <div class="row">
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" name="cekout" class="btn btn-warning btn-block">Check Out</button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="px-3 pt-3">
                                        <p class="fs-4">Bukti Transfer</p>
                                        <hr style="width: 15rem; margin-top: -1rem;">
                                    </div>
                                    <?php if (count($bukti) > 0) :  ?>
                                        <img src="../img/bukti/<?= $bukti[0]['bukti'] ?>" class="img-fluid" alt="<?= $bukti[0]['bukti'] ?>">
                                    <?php else : ?>
                                        <h5 class="text-muted text center mt-3">*Belum ditransfer!</h5>
                                    <?php endif; ?>
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

    <?php include "layout/bawah.php" ?>
</body>

</html>