<?php
session_start();
include "data-cekin.php";
include "layout/cookie.php";

$cekin = $_POST['cekin'];
$cekout = $_POST['cekout'];

var_dump($cekin);
var_dump($cekout);

$cekValidasi = $cekout > $cekin;
if (!$cekValidasi) {
    echo "<script>
            document.location.href = './?page=dashboard&pesan=tgltdkvalid';
        </script>";
}

$tipeKamar = $_POST["tipe-kamar"];
$gambar = query("SELECT gambar FROM fasilitas WHERE tipe_kamar = '$tipeKamar'")[0]['gambar'];
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

        <h2 class="mt-5 text-center">Pesan Kamar</h2>
        <div class="container my-5">
            <div class="m-auto rounded-3">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-5">
                        <div class="card p-4">
                            <img src="img/fasilitas/<?= $gambar ?>" class="card-img-top" alt="<?= $gambar ?>">
                            <div class="row justify-content-center mt-3">
                                <div class="col-6 text-end">Tipe Kamar</div>
                                <div class="col-6"><?= $_POST['tipe-kamar'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">Nomor Kamar</div>
                                <div class="col-6">
                                    <?php for ($i = 1; $i <= $_POST['jumlah-kamar']; $i++) : ?>
                                        (<?= $_POST["nomor-kamar-$i"] ?>)
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">Harga / Malam</div>
                                <div class="col-6">Rp.<?= $_POST['harga'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">Jumlah Kamar</div>
                                <div class="col-6"><?= $_POST['jumlah-kamar'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">Nama Pemesan</div>
                                <div class="col-6"><?= $_POST['nama'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">Alamat</div>
                                <div class="col-6"><?= $_POST['alamat'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">No Telepon</div>
                                <div class="col-6"><?= $_POST['telp'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">Check In</div>
                                <div class="col-6"><?= tanggal_indonesia($_POST['cekin']) ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">Check Out</div>
                                <div class="col-6"><?= tanggal_indonesia($_POST['cekout']) ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">Durasi Menginap</div>
                                <div class="col-6"><?= $durasi; ?> Malam</div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end">Total Biaya</div>
                                <div class="col-6">Rp. <?= $totalBiaya; ?></div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post" autocomplete="off">
                        <?php for ($j = 1; $j <= $_POST['jumlah-kamar']; $j++) : ?>
                            <input name="id" type="hidden" value="<?= $dataPelanggan['id'] ?>">
                            <input name="tipe-kamar" type="hidden" value="<?= $_POST['tipe-kamar']; ?>">
                            <input name="tipe-kamar" type="hidden" value="<?= $_POST['tipe-kamar']; ?>">
                            <input name="nomor-kamar-<?= $j; ?>" type="hidden" value="<?= $_POST["nomor-kamar-$j"]; ?>">
                            <input name="harga" type="hidden" value="<?= $_POST['harga']; ?>">
                            <input name="jumlah-kamar" type="hidden" value="<?= $_POST['jumlah-kamar'] ?>">
                            <input name="nama" type="hidden" value="<?= $_POST['nama'] ?>">
                            <input name="alamat" type="hidden" value="<?= $_POST['alamat'] ?>">
                            <input name="telp" type="hidden" value="<?= $_POST['telp'] ?>">
                            <input name="cekin" type="hidden" value="<?= $_POST['cekin'] ?>">
                            <input name="cekout" type="hidden" value="<?= $_POST['cekout'] ?>">
                            <input name="durasi" type="hidden" value="<?= $durasi; ?>">
                            <input name="total-biaya" type="hidden" value="<?= $totalBiaya; ?>">
                        <?php endfor; ?>
                        <div class="row justify-content-center mt-3">
                            <button class="w-25 btn text-white btn-lg mb-5" style="background-color: #6998AB" name="pesan" type="submit">Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['pesan'])) {
        if (tambahPesanan($_POST) > 0) {
            echo "<script>
                    function pindahHalaman() {
                        document.location.href = './pesanan.php?page=pesanan';
                    }
                    
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Kamar telah dipesan!',
                    showConfirmButton: false,
                    timer: 1500
                    });
                    setTimeout(pindahHalaman, 1500);
                </script>";
        } else {
            echo "<script>
                alert('Pesanan Gagal');
            </script>";
        }
    }
    ?>

    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>