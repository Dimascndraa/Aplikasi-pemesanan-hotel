<?php
session_start();
include "logic/functions.php";

$dataSuperior = query("SELECT * FROM fasilitas WHERE tipe_kamar = 'superior' ");
$dataDeluxe = query("SELECT * FROM fasilitas WHERE tipe_kamar = 'deluxe' ");

if (!$_GET['page']) {
    header("Location: ./fasilitas.php?page=fasilitas");
}

include "layout/cookie.php";

$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #eaeaea;">
    <?php include "./layout/navbar.php" ?>
    <div class="container mt-5">
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

        <h1 class="my-5 ">Fasilitas</h1>
        <h5 class="text-center mb-3">Superior</h5>
        <hr>
        <div class="row mb-5 g-3 justify-content-center">
            <?php foreach ($dataSuperior as $superior) : ?>
                <div class="col-10 col-lg-4">
                    <div class="card" style="height: 26rem;">
                        <img src="./img/fasilitas/<?= $superior["gambar"] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $superior["fasilitas"] ?></h5>
                            <p class="card-text mt-3" style="text-align: justify;"><?= $superior["deskripsi"] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <h5 class="text-center mb-3">Deluxe</h5>
        <hr>
        <div class="row mb-5 g-3 justify-content-center">
            <?php foreach ($dataDeluxe as $deluxe) : ?>
                <div class="col-10 col-lg-4">
                    <div class="card" style="height: 26rem;">
                        <img src="./img/fasilitas/<?= $deluxe["gambar"] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $deluxe["fasilitas"] ?></h5>
                            <p class="card-text mt-3" style="text-align: justify;"><?= $deluxe["deskripsi"] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>