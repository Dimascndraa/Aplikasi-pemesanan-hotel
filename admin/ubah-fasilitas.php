<?php
session_start();
$idFasilitas = $_GET['id'];

if (!$_GET['page']) {
    header("Location: ?page=data-fasilitas&id=$idFasilitas");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];

$fasilitas = query("SELECT * FROM fasilitas WHERE id = '$idFasilitas' ")[0];
$hotel = query("SELECT * FROM identitas")[0];


if (isset($_POST['ubah'])) {
    if (ubahFasilitas($_POST) > 0) {
        echo "<script>
                document.location.href = './data-fasilitas.php?page=data-fasilitas&pesan=berhasil-ubah-fasilitas';
                </script>";
    } else {
        echo "<script>
                document.location.href = '?page=data-fasilitas&pesan=gagal-ubah-fasilitas&id=$idFasilitas';
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
                            <h1 class="m-0">Data Fasilitas</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Fasilitas </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid p-5">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Fasilitas</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id-fasilitas" value="<?= intval($fasilitas['id']) ?>">
                                        <input type="hidden" name="gambar-lama" value="<?= $fasilitas['gambar'] ?>">
                                        <input type="hidden" name="tipe-kamar" value="<?= $fasilitas['tipe_kamar'] ?>">
                                        <div class="form-group mb-4">
                                            <label for="fasilitas">Nama Fasilitas</label>
                                            <input type="text" class="form-control" id="fasilitas" name="fasilitas" value="<?= $fasilitas['fasilitas'] ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="deskripsi">Deskripsi</label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $fasilitas['deskripsi'] ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" class="form-control gambar" id="gambar" name="gambar" onchange="previewImage()">
                                            <img src="../img/fasilitas/<?= $fasilitas['gambar'] ?>" class="img-thumbnail mt-2 img-preview" alt="">
                                        </div>

                                        <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                                    </form>
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
        <?php if ($_GET['pesan'] == "gagal-ubah-fasilitas") : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fasilitas gagal diubah!',
                        text: 'Coba cek kembali data yang diinputkan!',
                        footer: 'Atau mungkin anda tidak mengubah apapun'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <?php include "layout/bawah.php" ?>
    <script>
        function previewImage() {
            const gambar = document.querySelector('.gambar');
            const imgPreview = document.querySelector('.img-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(gambar.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };

        }
    </script>
</body>

</html>