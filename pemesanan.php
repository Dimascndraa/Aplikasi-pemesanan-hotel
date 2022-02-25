<?php
session_start();
include "pesan.php";

if (isset($_POST)) {
    if (!$_POST['tipe-kamar']) {
        header("location:./");
    }
}

include "layout/cookie.php";

$id = $_SESSION['id'];
$stokKamar = query("SELECT * FROM stok_kamar WHERE tipe = '$tipeKamar'")[0]['stok'];
$idKamar = query("SELECT * FROM kamar WHERE jenis_kamar = '$tipeKamar'");
$nomorKamar = query("SELECT no_kamar FROM kamar WHERE jenis_kamar = '$tipeKamar' AND status = 'tersedia'");
$dataPelanggan = query("SELECT * FROM pelanggan WHERE id = '$id'")[0];
$jumlahKamar = $_POST['jumlah-kamar'];
$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #eaeaea;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6998AB">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/logo/<?= $hotel['logo_secondary'] ?>" width="30" alt="<?= $hotel['nama_hotel'] ?>"> <span class="bold"><?= $hotel['nama_hotel'] ?></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="./index.php?page=index">Beranda</a>
                    <a class="nav-link" href="./kamar.php?page=kamar">Kamar</a>
                    <a class="nav-link" href="./fasilitas.php?page=fasilitas">Fasilitas</a>
                    <a class="nav-link" href="./pesanan.php?page=pesanan">Pesanan</a>
                    <a class="nav-link" href="./logic/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide mt-5 h-25" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-block w-100 slide-foto gambar-slider-1"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= $hotel['nama_hotel'] ?></h5>
                        <p>Cari hotel dengan keamanan paling baik? silakan kunjungi <?= $hotel['nama_hotel'] ?> dan dapatkan fasilitas lengkap lainnya.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-block w-100 slide-foto gambar-slider-2"></div>
                </div>
                <div class="carousel-item">
                    <div class="d-block w-100 slide-foto gambar-slider-3"></div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <h2 class="mt-5 text-center">Pesan Kamar</h2>
    <div class="container my-5">
        <div class="m-auto rounded-3">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 card">
                    <img src="img/fasilitas/<?= $gambar ? "$gambar" : "hotel.jpg" ?>" class="gambar-kamar d-block m-auto mt-3 img-thumbnail">
                    <form action="detail-pemesanan.php" method="post" autocomplete="off">
                        <div class="container">
                            <div class="row mt-5 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="tipe-kamar" class="form-label text-lg-end d-block">Tipe Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required readonly name="tipe-kamar" type="text" class="form-control" placeholder="Tipe Kamar" value="<?= $tipeKamar; ?>">
                                </div>
                            </div>
                            <?php for ($i = 1; $i <= intval($jumlahKamar); $i++) : ?>
                                <div class="row my-3 justify-content-center">
                                    <div class="col-lg-3">
                                        <label for="nomor-kamar" class="form-label text-lg-end d-block">Kamar Nomor</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="nomor-kamar-<?= $i; ?>" id="nomor-kamar" class="form-select" required>
                                            <option value="" selected disabled>Pilih Nomor Kamar</option>
                                            <?php foreach ($nomorKamar as $noKamar) : ?>
                                                <option value="<?= $noKamar['no_kamar'] ?>"><?= $noKamar['no_kamar'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endfor; ?>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="harga" class="form-label text-lg-end d-block">Harga / Malam</label>
                                </div>
                                <div class="col-lg-6">
                                    <span>Rp. </span><input required readonly name="harga" type="text" class="form-control w-75 d-inline" id="harga" placeholder="Harga Kamar perhari" value="<?= rupiah($hargaAwal) ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="jumlah-kamar" class="form-label text-lg-end d-block">Jumlah Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required readonly name="jumlah-kamar" type="number" class="form-control" id="jumlah-kamar" min="1" max="<?= $stokKamar; ?>" placeholder="Tersedia <?= $stokKamar; ?>" value="<?= $_POST['jumlah-kamar'] ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="nama" class="form-label text-lg-end d-block">Nama Lengkap</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="nama" type="text" class="form-control" id="nama" placeholder="Nama Lengkap" value="<?= $dataPelanggan['nama']; ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="alamat" class="form-label text-lg-end d-block">Alamat</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="alamat" type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $dataPelanggan['alamat']; ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="telp" class="form-label text-lg-end d-block">No. Telepon</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="telp" type="telp" class="form-control" id="telp" placeholder="No Telepon" value="<?= $dataPelanggan['telp']; ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="cekin" class="form-label text-lg-end d-block">Check-In</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="cekin" type="date" class="form-control" id="cekin">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="cekout" class="form-label text-lg-end d-block">Check-Out</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="cekout" type="date" class="form-control" id="cekout">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button class="w-50 btn text-white btn-lg mb-5" style="background-color: #6998AB" name="submit" type="submit">Pesan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>