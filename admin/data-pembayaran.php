<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=data-pembayaran");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$hotel = query("SELECT * FROM identitas")[0];

$dataPembayaran = query("SELECT * FROM pembayaran ORDER BY id DESC");
$i = 1;
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
                            <h1 class="m-0">Data Pembayaran</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Pembayaran </li>
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

                        <?php if (count($dataPembayaran) > 0) : ?>
                            <table class="table datatab">
                                <thead class="text-center bg-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Pembayar</th>
                                        <th scope="col">Nama Pemilik Kartu</th>
                                        <th scope="col">Bank</th>
                                        <th scope="col">No Rekening</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataPembayaran as $pembayaran) : ?>
                                        <tr class="text-center">
                                            <td><?= $i++; ?></td>
                                            <td><?= $pembayaran['tgl_pembayaran'] ?></td>
                                            <td><?= $pembayaran['nama_pembayar'] ?></td>
                                            <td><?= $pembayaran['nama_pemilik_kartu'] ?></td>
                                            <td><?= $pembayaran['bank'] ?></td>
                                            <td><?= $pembayaran['no_rekening'] ?></td>
                                            <td>
                                                <a href="detail-pembayaran.php?id=<?= $pembayaran['id']; ?>" class="btn btn-primary mx-2">Detail</a>
                                                <a href="../logic/hapus-pembayaran.php?id=<?= $pembayaran['id']; ?>" class="btn btn-danger mx-2">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <h5 class="text-muted text-center"> *Belum ada pesanan </h5>
                        <?php endif; ?>
                    </div>
                    <div class="ms-2 mb-5 mt-3">
                        <h5>Cetak</h5>
                        <form action="print/print-data-pembayaran.php" method="POST">
                            <div class="row">
                                <div class="col-2">
                                    <select required name="bulan" id="bulan" class="form-select w-100">
                                        <option value="">-- Bulan --</option>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                </div>

                                <div class="col-2">
                                    <select required name="tahun" id="tahun" class="form-select w-100">
                                        <option value="">-- Tahun --</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                </div>

                                <div class="col-2">
                                    <button name="submit" type="submit" class="btn btn-primary d-block w-100" style="width: 10rem;"><i class="fas fa-print"></i> Cetak</button>
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
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php include "layout/bawah.php" ?>
    <script>
        $(document).ready(function() {
            $('.datatab').DataTable();
        });
    </script>

</body>

</html>