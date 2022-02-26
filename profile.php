<?php
session_start();
include "logic/functions.php";
if (!$_GET['page']) {
    header("Location: ./profile.php?page=profile");
}

include "layout/cookie.php";

if (isset($_POST['ubah'])) {
    if (ubahAkun($_POST) > 0) {
        echo "<script>
                document.location.href = '?page=profile&pesan=berhasil';
                </script>";
    } else {
        echo "<script>
                document.location.href = '?page=profile&pesan=gagal';
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
                                    <div class="row mb-5">
                                        <div class="col-12 text-center">
                                            <a href="logic/proses-hapus-akun.php?id=<?= $dataPelanggan['id'] ?>" style="background-color: #174578;" class="btn text-white">Hapus Akun</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="card">
                            <div class="container p-5">
                                <h5 class="text-start">Ubah Identitas</h5>
                                <hr class="w-25">
                                <div class="col-12 mt-4">
                                    <form autocomplete="off" action="" method="post" class="text-start" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id" value="<?= $dataPelanggan['id'] ?>">
                                        <input type="hidden" name="gambar-lama" id="gambar-lama" value="<?= $dataPelanggan['foto'] ?>">
                                        <div class="mb-3">
                                            <label for="foto" class="form-label fw-bold">Foto Profil</label>
                                            <input style="background-color: #e8f0fe;" type="file" class="form-control foto" name="foto" onchange="previewImage()" id="foto" value="<?= $dataPelanggan['foto']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label fw-bold">Nama</label>
                                            <input required style="background-color: #e8f0fe;" type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= $dataPelanggan['nama']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="username" class="form-label fw-bold">Username</label>
                                            <input required style="background-color: #e8f0fe;" type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= $dataPelanggan['username']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="jenis-kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                                            <select required name="jenis-kelamin" id="jenis-kelamin" style="background-color: #e8f0fe;" class="form-select">
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="laki-laki" <?= $dataPelanggan['jenis_kelamin'] == 'laki-laki' ? 'selected' : ''; ?>>Laki Laki</option>
                                                <option value="perempuan" <?= $dataPelanggan['jenis_kelamin'] == 'perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="telp" class="form-label fw-bold">No Handphone</label>
                                            <input required style="background-color: #e8f0fe;" type="text" class="form-control" name="telp" id="telp" placeholder="No Handphone" value="<?= $dataPelanggan['telp']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="alamat" class="form-label fw-bold">Alamat</label>
                                            <input required style="background-color: #e8f0fe;" type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= $dataPelanggan['alamat']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label fw-bold">Alamat Email</label>
                                            <input required style="background-color: #e8f0fe;" type="text" class="form-control" name="email" id="email" placeholder="Alamat Email" value="<?= $dataPelanggan['email']; ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <button style="background-color: #174578;" class="btn text-white w-100 d-block mt-4" type="submit" name="ubah">Ubah</button>
                                            </div>
                                            <div class="col-6">
                                                <a href="ubah-password.php" style="background-color: #174578;" class="btn text-white d-block mt-4">Ubah Password</a>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <a href="./" class="nav-link">Kembali ke halaman awal</a>
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
        <?php if ($_GET['pesan'] == 'ubah-password-berhasil') : ?>
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Password berhasil diubah!'
                })
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == 'berhasil') : ?>
            <script>
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success m-3',
                        cancelButton: 'btn btn-danger m-3'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Profil berhasil diubah!',
                    text: "kembali ke halaman awal?",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, kembali!',
                    cancelButtonText: 'Tidak, tetap disini!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = "./";
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        document.location.href = "profile.php";
                    }
                });
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == "gagal") : ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Profile gagal diubah!',
                    text: 'Coba cek kembali data yang diinputkan!',
                    footer: 'Atau mungkin anda tidak mengubah apapun'
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