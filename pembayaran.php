<?php
session_start();
include "logic/functions.php";
$id = $_GET['id'];
$idUser = $_SESSION['id'];

if (!$_GET['page']) {
    header("Location: ./pembayaran.php?page=pemesanan&id=$id");
}

include "layout/cookie.php";

$id = $_GET['id'];
$pesanan = query("SELECT * FROM pemesanan WHERE status = 'belum dibayar' && id = '$id'")[0];
$tipeKamar = $pesanan['tipe_kamar'];
$tanggalPesanan = $pesanan['tgl_pemesanan'];

$jumlahKamar = query("SELECT jumlah_kamar FROM pemesanan WHERE tgl_pemesanan = '$tanggalPesanan'");
$pemesan = query("SELECT * FROM pelanggan WHERE id = '$idUser'")[0];
$nomorKamar = query("SELECT no_kamar,jenis_kamar FROM kamar WHERE jenis_kamar = '$tipeKamar' AND status = 'dipesan' AND kamar.tgl_pemesanan = '$tanggalPesanan' ");
$i = 1;
$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #eaeaea;">
    <?php include "./layout/navbar.php" ?>

    <h2 class="mt-5 text-center">Pembayaran</h2>
    <div class="container my-5">
        <div class="m-auto rounded-3">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 card">
                    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                        <div class="container">
                            <input type="hidden" name="id" value="<?= $pesanan['id']; ?>">
                            <div class="row mt-5 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="tipe-kamar" class="form-label text-lg-end d-block">Tipe Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required readonly name="nama-pembayar" type="text" class="form-control" placeholder="Nama Lengkap" value="<?= $pesanan['tipe_kamar'] ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center d-none">
                                <div class="col-lg-3">
                                    <label for="nomor-kamar" class="form-label text-lg-end d-block">Kamar Nomor</label>
                                </div>
                                <div class="col-lg-6">
                                    <?php foreach ($nomorKamar as $noKamar) : ?>
                                        <select name="nomor-kamar-<?= $i++; ?>" id="nomor-kamar" class="form-select" required>
                                            <option value="" disabled>Pilih Nomor Kamar</option>
                                            <option value="<?= $noKamar['no_kamar'] ?>" <?= $noKamar ? 'selected' : ''; ?>><?= $noKamar['no_kamar'] ?></option>
                                        </select>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="tipe-kamar" class="form-label text-lg-end d-block">Nama lengkap</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="nama-pembayar" type="text" class="form-control" placeholder="Nama Lengkap" value="<?= $pemesan['nama'] ?>">
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="tipe-kamar" class="form-label text-lg-end d-block">Jumlah Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required readonly name="jumlah-kamar" type="text" class="form-control" placeholder="Nama Lengkap" value="<?= $pesanan['jumlah_kamar'] ?>">
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="bank" class="form-label text-lg-end d-block">Bank</label>
                                </div>
                                <div class="col-lg-6">
                                    <select name="bank" id="bank" class="form-select" required>
                                        <option value="" disabled selected>-- Pilih Bank --</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="BNI">BNI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-lg-3">
                                    <label for="telp" class="form-label text-lg-end d-block">No. Rekening</label>
                                </div>
                                <div class="col-lg-6">
                                    <input required name="nomor-rekening" type="text" class="form-control" id="telp" placeholder="No Rekening"">
                                </div>
                            </div>
                            <div class=" row my-3 justify-content-center">
                                    <div class="col-lg-3">
                                        <label for="cekin" class="form-label text-lg-end d-block">Nama Pemilik Kartu</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input required name="nama-pemilik-kartu" type="text" class="form-control" id="telp" placeholder="Nama Pemilik Kartu"">
                                </div>
                            </div>
                            <div class=" row my-3 justify-content-center">
                                        <div class="col-lg-3">
                                            <label for="harga" class="form-label text-lg-end d-block">Bukti Transfer</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input required name="bukti" type="file" class="form-control w-100 d-inline" id="harga">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3 justify-content-center">
                                    <div class="col-lg-3">
                                        <label for="harga" class="form-label text-lg-end d-block">Jumlah Bayar</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>Rp. </span><input readonly required name="total-bayar" type="text" class="form-control w-75 d-inline" id="harga" placeholder="Harga Kamar perhari" value="<?= $pesanan['total_biaya']; ?>">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <button class="w-50 btn text-white btn-lg mb-5" style="background-color: #174578" name="bayar" type="submit">Bayar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php
    if (isset($_POST['bayar'])) {
        if (tambahPembayaran($_POST) > 0) {
            echo "<script>
                    function pindahHalaman() {
                        document.location.href = './pesanan.php?page=pesanan';
                    }
                    
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Pesanan telah dibayar!',
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