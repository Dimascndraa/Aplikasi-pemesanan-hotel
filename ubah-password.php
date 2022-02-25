<?php
session_start();
include "logic/functions.php";
if (!$_GET['page']) {
    header("Location: ?page=profile");
}

include "layout/cookie.php";

if (isset($_POST['ubah'])) {
    if (ubahPassword($_POST) > 0) {
        echo "<script>
                alert('Password berhasil diubah!');
                document.location.href = './index.php?page=index';
              </script>";
    } else {
        echo "<script>
                alert('Password gagal diubah!');
              </script>";
    }
}

$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #eaeaea;">
    <?php include "./layout/navbar.php" ?>

    <div class="container-fluid my-5">
        <div class="row justify-content-center mt-5">
            <div class="col-12 text-center">
                <h3>Profil</h3>

                <div class="row ms-3">
                    <div class="col-lg-3">
                        <div class="card">
                            <img src="img/profil/<?= $dataPelanggan['foto']; ?>" class="card-img-top p-5 m-auto img-preview rounded-circle" alt="...">
                            <div class="rows justify-content-center">
                                <div class="container-fluid">

                                    <div class="row mb-1 mt-3">
                                        <div class="col-12 text-center">
                                            <h5>
                                                <?= $dataPelanggan['nama']; ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h5 style="font-size: 11pt;" class="fw-bold">
                                                Username
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <span><?= $dataPelanggan['username']; ?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h5 style="font-size: 11pt;" class="fw-bold">
                                                Jenis Kelamin
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <span><?= $dataPelanggan['jenis_kelamin']; ?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h5 style="font-size: 11pt;" class="fw-bold">
                                                No. Handphone
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <span><?= $dataPelanggan['telp']; ?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h5 style="font-size: 11pt;" class="fw-bold">
                                                Alamat
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <span><?= $dataPelanggan['alamat']; ?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-12 text-center">
                                            <h5 style="font-size: 11pt;" class="fw-bold">
                                                Alamat Email
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <span><?= $dataPelanggan['email']; ?></span>
                                        </div>
                                    </div>
                                    <hr class="mb-5">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="card">
                            <div class="container p-5">
                                <h5 class="text-start">Ubah Password</h5>
                                <hr class="w-25">
                                <div class="col-12 mt-4">
                                    <form autocomplete="off" action="" method="post" class="text-start">
                                        <input type="hidden" name="id" id="id" value="<?= $dataPelanggan['id'] ?>">
                                        <div class="mb-3">
                                            <label for="password-lama" class="form-label fw-bold">Password Lama</label>
                                            <input style="background-color: #e8f0fe;" type="password" class="form-control" name="password-lama" id="password-lama" placeholder="Password Lama">
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label fw-bold">Password Baru</label>
                                            <input style="background-color: #e8f0fe;" type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
                                        </div>

                                        <div class="mb-3">
                                            <label for="konfirmasi-password" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                            <input style="background-color: #e8f0fe;" type="password" class="form-control" name="konfirmasi-password" id="konfirmasi-password" placeholder="Konfirmasi Password Baru">
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit" name="ubah" style="background-color: #6998AB" class="btn text-white d-block mt-4">Ubah Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "./layout/footer.php" ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi bi-eye-slash");
                    $('#show_hide_password i').removeClass("bi bi-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi bi-eye-slash");
                    $('#show_hide_password i').addClass("bi bi-eye");
                }
            });
        });

        function previewImage() {
            const foto = document.querySelector('.foto');
            const imgPreview = document.querySelector('.img-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };

        }
    </script>
</body>

</html>