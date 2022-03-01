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
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #174578">
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
                                    <label for="tipe-kamar" class="form-label mt-2 text-lg-end d-block">Tipe Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required readonly name="tipe-kamar" type="text" class="form-control" placeholder="Tipe Kamar" value="<?= $tipeKamar; ?>">
                                </div>
                            </div>
                            <?php for ($i = 1; $i <= intval($jumlahKamar); $i++) : ?>
                                <div class="row my-3 justify-content-center">
                                    <div class="col-lg-3">
                                        <label for="nomor-kamar" class="form-label mt-2 text-lg-end d-block">Kamar Nomor</label>
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
                                    <label for="harga" class="form-label mt-2 text-lg-end d-block">Harga / Malam</label>
                                </div>
                                <div class="col-lg-6">
                                    <span>Rp. </span><input required readonly name="malam" type="text" class="form-control w-75 d-inline" id="harga" onfocus="sum();" placeholder="Harga Kamar perhari" value="<?= rupiah($hargaAwal) ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="jumlah-kamar" class="form-label mt-2 text-lg-end d-block">Jumlah Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required readonly name="jumlah-kamar" type="number" class="form-control" id="jumlah-kamar" min="1" max="<?= $stokKamar; ?>" placeholder="Tersedia <?= $stokKamar; ?>" value="<?= $_POST['jumlah-kamar'] ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="nama" class="form-label mt-2 text-lg-end d-block">Nama Lengkap</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="nama" type="text" class="form-control" id="nama" placeholder="Nama Lengkap" value="<?= $dataPelanggan['nama']; ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="alamat" class="form-label mt-2 text-lg-end d-block">Alamat</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="alamat" type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $dataPelanggan['alamat']; ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="telp" class="form-label mt-2 text-lg-end d-block">No. Telepon</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="telp" type="telp" class="form-control" id="telp" placeholder="No Telepon" value="<?= $dataPelanggan['telp']; ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="cekin" class="form-label mt-2 text-lg-end d-block">Check-In</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="cekin" type="text" placeholder="Pilih tanggal check in" readonly class="form-control" id="cekin">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="cekout" class="form-label mt-2 text-lg-end d-block">Check-Out</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="cekout" type="text" placeholder="Pilih tanggal check out" readonly class="form-control" id="cekout" onchange="sum()">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="row my-3 justify-content-center">
                                    <div class="col-lg-3">
                                        <label for="harga" class="form-label mt-2 text-lg-end d-block">Total Harga</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>Rp. </span><input required readonly name="harga" type="text" class="form-control w-75 d-inline" id="hasil" placeholder="Total Harga">
                                    </div>
                                </div>
                                <input type="hidden" class="form-control w-75 d-inline" id="total" placeholder="Harga Kamar perhari">
                                <button class="w-50 btn text-white btn-lg mb-5" style="background-color: #174578" name="submit" type="submit">Pesan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include "layout/footer.php" ?>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function rubah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        }

        $(function() {
            $("#cekin").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });

        $(function() {
            $("#cekout").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });

        window.onload = function() {
            $('#cekout').on('change', function() {

                $(function() {
                    $("#cekin").datepicker({
                        dateFormat: 'dd-mm-yy'
                    });
                    $("#cekout").datepicker({
                        dateFormat: 'dd-mm-yy'
                    });

                    var start = $('#cekin').datepicker('getDate');
                    var end = $('#cekout').datepicker('getDate');
                    var days = (end - start) / 1000 / 60 / 60 / 24;
                    $('#total').val(days);

                    var malam = $('#total').val();

                    var hargaPermalam = $('#harga').val();
                    var harga1 = hargaPermalam.substring(0, 3);
                    var harga2 = hargaPermalam.substring(4, 7);

                    var akhirHarga = harga1 + harga2;

                    var jumlahKamar = $('#jumlah-kamar').val();

                    var total = jumlahKamar * akhirHarga * malam;
                    $('#hasil').val(rubah(total));
                });
            });
        }
        // alert(akhirHarga * jumlahKamar);
    </script>
</body>

</html>