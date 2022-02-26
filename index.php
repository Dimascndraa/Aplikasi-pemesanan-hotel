<?php
session_start();
include "logic/functions.php";

if (!$_GET['page']) {
    header("Location: ./index.php?page=index");
}

include "layout/cookie.php";

$hotel = query("SELECT * FROM identitas")[0];
$sosialMedia = query("SELECT * FROM sosial_media")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #eaeaea;">
    <?php include "./layout/navbar.php" ?>

    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
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

        <div class="row">
            <div class="col-lg-8">
                <h1 class="mt-5 text-center">Tentang Kami</h1>
                <p class="mt-3" style="text-align: justify;"><?= $hotel['nama_hotel'] ?> <?= $hotel['tentang'] ?></p>
            </div>
            <div class="col-lg-3 mt-lg-3 ms-lg-5">
                <h2 class="mt-lg-5">Hubungi Kami</h2>
                <p style="font-size: 13pt;"><strong>Hote Hebat</strong></p>
                <p style="margin-top: -1rem;"><?= $hotel['alamat'] ?></p>
                <div class="mt-3">
                    <a href="https://api.whatsapp.com/send/?phone=<?= $sosialMedia['whatsapp'] ?>&text&app_absent=0" target="_blank"><i class="fab fa-whatsapp nav-icon fs-3 mx-2 text-secondary"></i></a>
                    <a href="https://www.facebook.com/<?= $sosialMedia['facebook'] ?>" target="_blank"><i class="fab fa-facebook nav-icon fs-3 mx-2 text-secondary"></i></a>
                    <a href="https://twitter.com/<?= $sosialMedia['twitter'] ?>" target="_blank"><i class="fab fa-twitter nav-icon fs-3 mx-2 text-secondary"></i></a>
                    <a href="https://www.instagram.com/<?= $sosialMedia['instagram'] ?>/" target="_blank"><i class="fab fa-instagram nav-icon fs-3 mx-2 text-secondary"></i></a>
                    <a href="mailto:<?= $hotel['email'] ?>" target="_blank"><i class="fas fa-envelope nav-icon fs-3 mx-2 text-secondary"></i></a>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-11 col-lg-9 bg-white mt-5 pt-4 text-center">
                    <h4 class="">Informasi</h4>
                    <h5 class="mt-3">Check-In</h5>
                    <p>Jam Check-In Standar : 12.00 WIB</p>
                    <p style="margin-top: -1.3rem;">*Waktu Check-In dari plan mempunyai prioritas lebih besar</p>
                    <h5 class="mt-3">Check-Out</h5>
                    <p>Jam Check-Out Standar : 12.00 WIB</p>
                    <p style="margin-top: -1.3rem;">*Waktu Check-In dari plan mempunyai prioritas lebih besar</p>
                </div>
            </div>
            <div class="col-lg-12">
                <h3 class="mt-5 text-center">Peta Lokasi</h1>
                    <div class="col-lg-12">
                        <iframe class="map my-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.7406362657113!2d108.21500022917684!3d-6.651564767621524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ed141d4340b25%3A0xb7368343e84db477!2sDimas%20Candra!5e0!3m2!1sid!2sid!4v1641944659791!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <p class="text-center"><?= $hotel['alamat'] ?></p>
            </div>
        </div>
    </div>

    <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] == "berhasil") : ?>
            <div class="container">
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Anda berhasil Masuk!'
                    })
                </script>
            </div>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == "berhasil-logout") : ?>
            <div class="container">
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Anda berhasil Keluar!'
                    })
                </script>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>