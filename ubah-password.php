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
                document.location.href = './profile.php?page=profile&pesan=ubah-password-berhasil';
                </script>";
    } else {
        echo "<script>
                document.location.href = '?page=profile&pesan=ubah-password-gagal';
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
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" style="background-color: #e8f0fe;" name='password-lama' id="password-lama" class="form-control" value="<?= @$_SESSION['password-lama'] ?>" required placeholder="Password Lama">
                                                <div class="input-group-append">
                                                    <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password-baru" class="form-label fw-bold">Password Baru</label>
                                            <div class="input-group" id="show_hide_password_2">
                                                <input type="password" style="background-color: #e8f0fe;" name='password-baru' id="password-baru" class="form-control" value="<?= @$_SESSION['password-baru'] ?>" required placeholder="Password Baru">
                                                <div class="input-group-append">
                                                    <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="konfirmasi-password" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                            <div class="input-group" id="show_hide_password_3">
                                                <input type="password" style="background-color: #e8f0fe;" name='konfirmasi-password' id="konfirmasi-password" class="form-control" value="<?= @$_SESSION['konfirmasi-password'] ?>" required placeholder="Konfirmasi Password Baru">
                                                <div class="input-group-append">
                                                    <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit" name="ubah" style="background-color: #174578" class="btn text-white d-block mt-4">Ubah Password</button>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <a href="./profile.php?page=profile" class="ps-0 nav-link">Kembali ke halaman sebelumnya</a>
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

    <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] == 'password-lama-salah') : ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops..!',
                    text: 'Password gagal diubah!',
                    footer: 'Password lama tidak sesuai!'
                })
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == 'konfirmasi-password-salah') : ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops..!',
                    text: 'Password gagal diubah!',
                    footer: 'Konfirmasi password tidak sesuai!'
                })
            </script>
        <?php endif; ?>
    <?php endif; ?>

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
            $("#show_hide_password_2 a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password_2 input').attr("type") == "text") {
                    $('#show_hide_password_2 input').attr('type', 'password');
                    $('#show_hide_password_2 i').addClass("bi bi-eye-slash");
                    $('#show_hide_password_2 i').removeClass("bi bi-eye");
                } else if ($('#show_hide_password_2 input').attr("type") == "password") {
                    $('#show_hide_password_2 input').attr('type', 'text');
                    $('#show_hide_password_2 i').removeClass("bi bi-eye-slash");
                    $('#show_hide_password_2 i').addClass("bi bi-eye");
                }
            });
            $("#show_hide_password_3 a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password_3 input').attr("type") == "text") {
                    $('#show_hide_password_3 input').attr('type', 'password');
                    $('#show_hide_password_3 i').addClass("bi bi-eye-slash");
                    $('#show_hide_password_3 i').removeClass("bi bi-eye");
                } else if ($('#show_hide_password_3 input').attr("type") == "password") {
                    $('#show_hide_password_3 input').attr('type', 'text');
                    $('#show_hide_password_3 i').removeClass("bi bi-eye-slash");
                    $('#show_hide_password_3 i').addClass("bi bi-eye");
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